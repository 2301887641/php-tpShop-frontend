<?php
namespace Home\Controller;
use Layout\Controller\LayoutController;
class FlowController extends LayoutController {
  //商品页点击加入购物车时,添加购物车功能
	public function addToCart(){
  	//接收商品id
		$goods_id=I('goods_id');
  	//商品属性id,数组格式
		$goods_attr=I('goods_attr');
  	//拆分数组用','拼接
		$goods_attr=implode(',',$goods_attr);
  	//
		$goods_num=I('amount');
  	//生成模型
		$cart=D('cart');
  	//将购物车写入cookie中
		$cart->addCart($goods_id,$goods_attr,$goods_num);
		redirect(U('flow1'));
	}

//购物车展示页面
	public function flow1(){
		$cart=D('cart');	
		$goods_info=$cart->getCartInfo();
		$this->assign(array(
			'goods_info'=>$goods_info
			));
		$this->display();
	}

//ajax修改商品数量或删除商品
	public function ajaxUpdateGN($gid,$gattr,$gnum=0){
		//默认商品数量修改为0,表示删除商品,其他则是修改
		$cart=D("cart");
		$result='';
		$gnum==0?$result=$cart->delCart($gid,$gattr):$result=$cart->saveCart($gid,$gattr,$gnum);
		echo $result;
	}

//核对订单信息页面与地址选择页面
	public function flow2(){
	//如果用户没有登录的话,将当前url地址记录下来	
		if(is_null(session("id"))){
//把当前url存到session中
			session("returnUrl",__ACTION__);
			$this->error("必须登录",U("Index/login"));
			die;
		}

	//通过需要将商品的信息取出来当道页面中	
		$cart=D('cart');	
		$goods_info=$cart->getCartInfo();
	//将收货人的地址取出来	
		$address=M("memberAddress");

		$this->assign(array(
			'goods_info'=>$goods_info,
			'address'=>$address->where('member_id='.session('id'))->select()
			));
		$this->display();
	}

//提交订单函数,点击提交订单执行该函数
	public function flow3(){
	//先判断用户登录了没有	
		if(is_null(session('id'))){
			$this->error("请先登录",U("index/login"));
			die;
		}
	//还要判断下购物车中有没有商品
		$cart=D("cart");	
		$carts=$cart->getCartInfo();
	//判断如果返回的数组的长度是0,就说明没有商品
		if(count($carts)==0)
		{
			$this->error("购物车中没有商品",U("/"));
			die;
		}	
	//在对购物车中商品的库存和数据库中的商品库存进行比较时,先加锁
	//因为入口文件都是index.php,所以是当前目录下的order.lock	
		$handler=fopen("./order.lock",'r');
    //先打开文件,然后上锁吧
		flock($handler,LOCK_EX);
	//计算总的价格,要传递给memberAddress模型	
		$tp=0;
	// 总价（不含运费)
		$goods_tp = 0;	
	//检查购物车中每一件商品的库存量是否够	
		foreach($carts as $k=>$v){
	//执行我们写好的获取数据库中的商品库存量		
			$goods_number=$this->getGn($carts[$k]['goods_id'],$carts[$k]['goods_attr']);
	//将购物车中的库存量与数据库中的库比对		
			if($goods_number<$carts[$k]['goods_num']){
				$this->error("商品库存量不足,下单失败");
				die;
			}
			$goods_tp+=$v['shop_price']*$v['goods_num'];

		}
	//将总价格放到session中好在模型中使用	
		session('tp',$goods_tp);
		//判断收货人信息是否完整
		$address=I("post.address");
		$pay=I("post.pay");
		$member_add=D("memberAddress");
		//支付状态1,表示已经支付钱了
		$pay_status=0;
		//开启事务
		mysql_query('start transaction');
		//首先,如果是新添加的收货人地址的话就接收这个radio传过来的值
		if($address=="new"){
			if($member_add->create()){
		//判断如果是使用余额来支付,要先判断下余额是否够支付的
				if($this->changeMemberMonry()===1)
		//余额支付时,支付成功了这里才会是1
				$pay_status=1;
		//将值写到session中好在模型中处理		
				session('pay_sta',$pay_status);
				if($member_add->add()){
		//为商品减少库存量,如果是下单时减库存的话	
					if($this->config['下单时间']=="下单时"){
						$product=M("product");
						foreach($carts as $k=>$v){
							$goods_attrs=$carts[$k]['goods_attr'];
							$goods_ids=$carts[$k]['goods_id'];
			//减少商品的库存量	
							$product->where("goods_id='$goods_ids' and goods_attr='$goods_attrs'")->setDec('goods_number',$carts[$k]['goods_num']);
						}
					}	

		//释放锁,关闭文件			
					flock($handler,LOCK_UN);
					fclose($handler);
		//清空购物车			
					$cart->removeCart();		

		//成功下单后,进行页面的跳转			
					$this->success("下单成功!",U("flow4"));
					die;			
				}
			}else{
				$this->error($member_add->getError());
			}
		//另一种情况就是,使用以前输入的地址.会发送地址的id过来,将地址取出即可
		}else{
		//判断下查询条件,id等于订单的id且会员id等于当前session中的id防修改过的表单	
			$result=$member_add->where('id='.$address.' and member_id='.session('id'))->find();
			if(is_null($result)){
				$this->error('订单错误','/');
				die;
			}
		//判断如果是使用余额来支付,要先判断下余额是否够支付的
			if($this->changeMemberMonry()===1)
			$pay_status=1;
		//将数据写入到订单表中
			$order=M('order');
			$order->add(array(
		"sn"=>time().mt_rand(111111, 999999),//和商品添加货号一样的方法
		"addtime"=>date("Y-m-d H:i:s"),
		"shr_name"=>$result["member_name"],
		"shr_province"=>$result["member_province"],
		"shr_city"=>$result["member_city"],
		"shr_area"=>$result["member_area"],
		"shr_address"=>$result["member_address"],
		"shr_phone"=>$result["member_phone"],
		"member_id"=>session("id"),
		"delivery"=>I("post.delivery"),
		"pay"=>$pay,
		'total_price'=>$goods_tp,
		'goods_tprice'=>$goods_tp,
		'pay_status'=>$pay_status,
		'yunfei'=>''
		));
		//清空购物车	
		$cart->removeCart();
		$this->success("下单成功!",U("flow4"));
		}


	}


//提交表单成功后,跳转到订单提交成功页面,并显示支付按钮
	public function flow4(){
		$this->display();
	}

//ajax根据商品id和商品属性获取商品在数据库中的库存
	public function ajaxGetGn($goods_id,$goods_attr=''){

		echo  $this->getGn($goods_id,$goods_attr);
	}

//根据商品id和商品属性获取商品在数据库中的库存,因为多个地方要用独立出来
	public function getGn($goods_id,$goods_attr=''){
		//实例化product表模型
		$product=M("product");
		//查找数据库中的goods_id和goods_attr都相同的记录,并取出对应商品的库存
		$product->field('goods_number')->where("goods_id=".$goods_id." and goods_attr='$goods_attr'")->find();
		//最后将库存返回,直接采用对象的方式返回.没有采用变量接收的方式
		return $product->goods_number;
	}

	public function changeMemberMonry(){
		$a=0;
		//判断如果是使用余额来支付,要先判断下余额是否够支付的
		if($pay=="余额"){
			$member=M('member');
			$member->field('money')->find(session('id'));
			if(is_null($member->money)){
				$this->error("订单数据错误",'/');
				die;
			}else{
				if($member->money>=$goods_tp){
					$result=$member->where('id='.session('id'))->setDec('monry',$goods_tp);	
					if($result===false){
				//出现错误后回滚事物
				mysql_query('rollback');		

					}else{
					$a=1;
					//提交事物,这里写的不对应该将所有的判断对进行比对都正确才提交事物
					mysql_query('commit');
					}
				}else{
					$this->error('用户余额不足');
					die;
				}
			}
		}
		return $a;
	}

}
