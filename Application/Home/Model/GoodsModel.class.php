<?php
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model{
  //通过栏目名取商品,默认取5条,最后一个参数可以另外添加where条件
	public function get_goods_by_recname($recname,$limit=5,$existsWhere=1){
		$sql="select id,goods_name,shop_price,mid_logo from sh_goods where $existsWhere and id in(select goods_id from sh_recommend_item where rec_id=(select id from sh_recommend
			where rec_name='$recname'and rec_type='商品')) limit $limit";
return $this->query($sql);

}

    //获取当前商品的会员价格,如果当前商品没有定义会员价格就需要再取得商品的shop_price再乘以当前会员的级别对应的折扣率
public function get_member_price($goods_id){
	//在session中获取当前会员的折扣率,并且折扣率要除以100才行	
	$level_rete=session('level_rate')/100;
	//在session中获取当前会员的会员级别id	
	$level_id=session('level_id');
	/*这里分为两种情况,如果当前商品针对当前的会员级别设置了最终价格,就直接返回这个价格
	而如果当前商品没有针对当前级别的会员设置最终价格,则返回当前商品的(shop_price*折扣率)当前会员级别的折扣率*/
	//在sh_member_price表中查找和当前会员级别以及商品id相同的最终商品价格
	$sql="select price from sh_member_price  where goods_id=$goods_id and level_id=$level_id";
	$pri=$this->query($sql);
	//说明已经找到了价格	
	if($pri){
		return $pri[0]['price'];
	//没有找到价格需要继续查找商品的shop_price价格并乘以折扣率		
	}else{
		$price=$this->field('shop_price')->where('id='.$goods_id)->find();
		return  (int)($price['shop_price']*$level_rete);
	}


}

public function search(){
	$where=1;
	//接收页面的get数据
	$key=I("get.key");
	$brand_id=I("get.brand");
	$catId=I("get.catId");
	$od=I('get.od');
	$dc=I('get.dc');
	$price=I('get.price');
	//排序的字段
	$orderby="xl";
	//默认降序
	$desc="desc";
	$catids='';
	//这里在判断下传递过来的get信息是否在我们指定的数组内容里面
	//xl表示销量、pl表示评论、shop_price表示价格、id表示上架时间
	if($od && in_array($od,array('xl','pl','shop_price','id')))
		$orderby=$od;
	if($dc && in_array($dc,array('desc','asc')))
		$desc=$dc;
	//如果传入了关键字就根据关键字在商品的名称或商品的描述中查找
	if(!empty($key)){
		$where.=" and a.goods_name like '%{$key}%' or a.goods_desc like '%{$key}%'";
	}
	//如果传入了品牌id查找
	if(!empty($brand_id))
		$where.=" and brand_id=".$brand_id;
	if(!empty($price)){
		$_price=str_replace('-',',',$price);
		$where.=" and shop_price in(".$_price.")";
	}

	//如果传入了catId,就在该id和该id的子级分类下进行查找
	if(!empty($catId)){
		$category=D("category");
		//将子分类中的catid也取出
		$cat_id=$category->get_category($catId);
		foreach($cat_id as $k=>$v){
			$catids.=$v.",";
		}

		$catids.=$catId;
		$where.=" and a.cat_id in($catids)";
		//用于商品赛选时,挑选出当前cai_id下所有的品牌
		$children_id = $category->get_category($catId, true);
		//把自身cat_id也需要放到数组中去要不少一个大类啊
		$children_id[]=$catId;
		$str_children_id = implode(',', $children_id);

	//连表查出当前分类下的品牌
		$brands = $this->alias('a')->field('DISTINCT(b.brand_name),b.id')->join('sh_brand b on a.brand_id=b.id')->where('cat_id in (' . $str_children_id . ') and brand_id!=0')->select();
	//用于搜索页面中显示价格区间,原理是先取出最小的价格和最高的价格.
	//然后用最大的价格减去最小的价格,剩下的价格再除以要显示多少的个数	
		$shop_price=$this->field('min(shop_price) min,max(shop_price) max')->where('cat_id in('.$str_children_id.')')->find();
		if($shop_price['max']!==$shop_price['min']){
	//最高价减去最低价后剩余的价格	
			$first_price=$shop_price['max']-$shop_price['min'];
	//存放分隔好价格的数组
			$price_arr=array();
	//用来存放分隔价格的次数,也就是分成几段	
			$price_num=9;
	//变量接收每段的价格	
			$duan='';
	//计算出来这些段价格的差是多少	
			$cha=ceil($first_price/$price_num);
	//定义每段的最低价格	
			$low_price=$shop_price['min'];
	//定义每段的最高价格	
			$top_price=$cha;
	//循环这些段数	
			for($i=0;$i<$price_num;$i++){
	//判断如果是最有一段的话,直接将最后的值跳到最大值即可		
		if($i==($price_num-1))
		$count=$shop_price['max'];
		else
		$count=$low_price+$cha;
	//将每段的字符串记录下来,按照'200-300'的格式		
		$duan=$low_price.'-'.$count;
	//每段的起始价格都要等于每段的最高价格,便于下次输出		
		$low_price=$count;
	//最后将价格都放到数组中,返回这个数组即可		
		$price_arr[]=$duan;
			}	
		}

		$_arr=array();
		$attri=M('attribute');
		$_attrs='';
	//#取出分类下关联的单选属性	
		$attrs=$category->field('filter_goods_attr_id')->where('id in ('.$str_children_id.")and filter_goods_attr_id!=''")->select();
		if(!empty($attrs)){
			foreach ($attrs as $key2 => $value2) {
				$_attrs.=$value2['filter_goods_attr_id'].',';
			}
				//下面做的事情是将重复的id过滤掉,要不前台会重复显示
			$_attrs=rtrim($_attrs,',');
			$_attrs2=explode(',',$_attrs);
			$_attrs2=array_unique($_attrs2);
			if($_attrs2){
				foreach ($_attrs2 as $k3 => $v3) {
					$_arr[]=$attri->where('id='.$v3)->find();
				}
			}
		}

	}	
		//用于分页时,计算出总条数,要起一个别名a才行不然报错啊
	$total=$this->alias('a')->where($where)->count();
		$Page = new \Think\Page($total,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		//因为需要进行销量、评论数的排序,所以需要进行连表查询才行。
		$sql="select a.id,a.logo,a.goods_name,a.shop_price,count(c.goods_id) pl,ifnull(sum(b.goods_number),0) xl from sh_goods a left join sh_order_goods b on a.id=b.goods_id left join sh_remark c on a.id=c.goods_id where $where group by a.id order by $orderby $desc limit $Page->firstRow,$Page->listRows";
		$result=$this->query($sql);
		return array(
			'result'=>$result,
			'page'=>$show,
			'brands'=>$brands,
			'price'=>$price_arr,
			'attr'=>$_arr
			);
	}


}
