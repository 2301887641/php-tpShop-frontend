<?php
namespace Home\Model;
use Think\Model;

class MemberAddressModel extends Model{
//因为是在前置钩子中要往order表中写入数据,并拿到order的id,但还牵扯到会员地址表
//所以,普通方法根本无法取到,只好用属性来取	
	public $order_id='';
	protected $_validate=array(
		// array('member_name','require','收货人不能为空',1,),
		// array('member_province','require','省份不能为空',1),
		// array('member_city','require','县市不能为空',1),
		// array('member_area','require','地区不能为空',1),
		// array('member_address','require','详细地址不能为空',1),
		// array('member_phone','require','手机号不能为空',1),
    //这个表单字段不在remark表中,也可以这样验证
		// array('delivery','require','送货方式不能为空',1),
		// array('pay','require','支付方式不能为空',1),
		);
//提交表单前执行的函数
	public function _before_insert(&$data, $options) {
	//会员地址表单还缺一个字段,会员的id给他添加上
		$member_id=session("id");
		$data['member_id']=$member_id;
		$order=M("order");
		$this->order_id=$order->add(array(
		"sn"=>time() . mt_rand(111111, 999999),//和商品添加货号一样的方法
		"addtime"=>date("Y-m-d H:i:s"),
		"shr_name"=>$data["member_name"],
		"shr_province"=>$data["member_province"],
		"shr_city"=>$data["member_city"],
		"shr_area"=>$data["member_area"],
		"shr_address"=>$data["member_address"],
		"shr_phone"=>$data["member_phone"],
		"member_id"=>$member_id,
		"delivery"=>I("post.delivery"),
		"pay"=>I("post.pay"),
		'total_price'=>session('tp'),
		'goods_tprice'=>session('tp'),
		'pay_status'=>session('pay_sta'),
		'yunfei'=>'100'
		));
	}

//最后再把购物车中的商品存到表中
	protected function _after_insert($data, $options) {
	//先取出购物车中的商品信息
		$cart=D("cart");
		$carts=$cart->getCartInfo();
		$order_goods=M("orderGoods");
		foreach($carts as $k=>$v){
			$order_goods->add(array(
	//将商品表单表的id写入该表中	
				"order_id"=>$this->order_id,
				"goods_id"=>$v["goods_id"],
				"goods_attr_id"=>$v["goods_attr"]?$v["goods_attr"]:'',
				"goods_attr_str"=>$v["goods_attrs"]?$v["goods_attrs"]:'',
				"goods_price"=>$v["price"],
				"goods_number"=>$v["goods_num"],
				"goods_name"=>$v["goods_name"]
				));

		}
	//清空购物车
		$cart->removeCart();
	}


}

