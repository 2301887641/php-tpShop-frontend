<?php
namespace Home\Model;
use Think\Model;
/**
 * 购物车类
 */
class CartModel extends Model {

    protected $fields = array(//直接指明当前表的字段,而不查询数据库
        'table_name', 'module_name'
        );

//购物车函数,用于将商品的信息写入到cookie,参数分别为商品id,商品属性id,商品数量
    /**
     * 
     * @param type $goods_id
     * @param type $goods_attr_id cookie中存的是商品属性表中的id,而不是属性表中的atr_id
     * @param type $goods_num
     */
    public function addCart($goods_id, $goods_attr_id, $goods_num = 1) {
//将商品id和商品属性用_拼接    1_3
        $key =(!empty($goods_attr_id))?$goods_id . '-' . $goods_attr_id:$goods_id;
//检查cookie中是否设置了cart购物车,没有返回空数组
        $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
//判断下,如果某个商品的id_商品的属性id,和数组中的相同,判断为同一个商品,数量加一
        if (array_key_exists($key, $cart))
            $cart[$key]+=$goods_num;
//否则,就认为是新的商品,需要在$cart数组中再加一条信息,确保不要清空掉以前的
        else
            $cart[$key] = $goods_num;
//写到cookie中
        setcookie('cart', serialize($cart), time() + 3600 * 30 * 24, '/');
    }

//清空购物车函数
    public function removeCart() {
//就是将cookie清空
        setcookie('cart', '', -1, '/');
    }

    //修改购物车中商品的数量
    /**
     * 
     * @param type $goods_id
     * @param type $goods_attr_id
     * @param type $goods_num
     */
    public function saveCart($goods_id, $goods_attr_id, $goods_num) {
        //将商品id和商品属性用_拼接    1_3 判断下商品属性是否为空(或0),没属性就不拼接
        //为0的原因是,前端空没法传只能传0,来代表空
        $key = ($goods_attr_id)?$goods_id . '-'.$goods_attr_id:$goods_id;
        // echo $key;
//检查cookie中是否设置了cart购物车,没有返回空数组
        $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
        // echo var_dump($cart);die;
        //将商品设置为指定数量
        $cart[$key] = $goods_num;
        //序列号后写进cookie
        setcookie('cart', serialize($cart), time() + 3600 * 30 * 24, '/');
        return 1;
    }

//删除指定购物车中商品
    /**
     * 
     * @param type $goods_id
     * @param type $goods_attr_id
     */
    public function delCart($goods_id, $goods_attr_id) {
        //拼接属性
        $key = $goods_attr_id ? $goods_id . '-' . $goods_attr_id:$goods_id;
        //取出购物车
        $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
        //删除对应的商品
        unset($cart[$key]);
        //最后,再写进cookie中
        setcookie('cart', serialize($cart), time() + 3600 * 30 * 24, '/');
        return 2;
    }
    //获取商品的详细信息
    public function getCartInfo(){
        //先从cookie中取出反序列化的购物车信息
        $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
        //判断如果清空了cookie,那么直接跳转页面
        if(empty($cart)){
            redirect(U('/'));
            die;
        //如果cookie存在的话    
        }else
        //生成模型
        $goods=D('goods');
        //创建一个数组,用于存储商品的信息
        $_cart=array();
        //循环cookie的信息
        foreach ($cart as $key => $value) {
        //用-分隔cookie中的数组取出信息    
            $cart_goods=explode('-',$key);
        //查找当前商品的商品名,logo,和价格(用于用户没登陆时用)
            $goods_info=$goods->field('goods_name,logo,shop_price,goods_weight,weight_unit')->find($cart_goods[0]);
        //判断果然用户没有登录就来到结账页面,单价直接取本店价格即可
            if(!session('id'))
                $member_price=$goods_info['shop_price'];
        //如果会员登录了,那么就要取出会员价格来
            else
                $member_price=$goods->get_member_price($cart_goods[0]);
        //将商品数量,商品名称,logo,shop_price(计算比会员价本店价优惠了多少钱),goods_id,goods_attr分别赋给数组
            $_cart[$key]['goods_num']=$value;
            $_cart[$key]['goods_name']=$goods_info['goods_name'];
            $_cart[$key]['logo']=$goods_info['logo'];
            $_cart[$key]['price']=$member_price;
            $_cart[$key]['goods_id']=$cart_goods[0];
            $_cart[$key]['shop_price']=$goods_info['shop_price'];
            //检查商品的重量,都是以克为单位的
            $_cart[$key]['goods_weight']=$goods_info['goods_weight']=="克"?$goods_info['goods_weight']:$goods_info['goods_weight']*1000;
            //用三目运算符检验下
            $_cart[$key]['goods_attr']=($cart_goods[1])?$cart_goods[1]:'';
            //临时数组用于最后返回
            $_arr=array();
            //计算价格,用于将属性价格添加进来
            $_price=0;
        //判断下商品有没有属性   
            if($cart_goods[1]){
        //将数组分隔成用逗号连接的字符串
                $cart_attr=explode(',',$cart_goods[1]);
        //计算当前商品的属性和属性名
                $sql="select a.attr_value,b.attr_name,a.attr_price from sh_goods_attr a left join sh_attribute b on a.attr_id=b.id where a.goods_id={$cart_goods[0]} and a.id in ($cart_goods[1])";
                $goods_attrs=$goods->query($sql);
                foreach ($goods_attrs as $k => $v){
                    $_price+=$v['attr_price'];
                    //格式:->产地:日本(111.00)
                    array_push($_arr,$v['attr_name'].':'.$v['attr_value'].'(￥'.$v['attr_price'].')');
                }
            //格式如下->产地:日本(111.00)<br>颜色:黑色(1000.00)    
            $_arr=implode('<br>',$_arr);
            //商品的属性    
            $_cart[$key]['goods_attrs']=$_arr;
        //最后将商品的属性价格加到商品的价格上,相当于总价格    
            $_cart[$key]['price']+=$_price;
        //商品的本店价最后也要加上属性的价格才行    
            $_cart[$key]['shop_price']+=$_price;
            }
        }
        //以(商品id-商品属性,商品属性)为下表
            return $_cart;
    }

}

?>