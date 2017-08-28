<?php
namespace Layout\Controller;
use Think\Controller;
class LayoutController extends Controller {
    public $config;
    public function __construct() {
        parent::__construct();  
        $articleCat = M('articleCat');//文章分类
        $articleCats = $articleCat->select();
        $article = M('article');//文章

        foreach ($articleCats as $k => $a) {

            $articleCats[$k]['articles'] = $article->where('cat_id=' . $a['id'])->select();
        }
        //取出首页的导航按钮
        $button=M('buttons');//所有按钮
        $buttons=$button->select();
        foreach($buttons as $k=>$b){
            $bt[$buttons[$k]['btn_pos']][]=$b;
        }
        //取出店铺设置
        $shop_config=M('shopConfig');//网站配置项
        $shop_configs=$shop_config->select();
        
        $config=array();
        foreach($shop_configs as $s){
            $config[$s['config_name']]=$s['config_value'];
        }
        //取出网站的1~3级分类
        $category=D('category');
        $categorys=$category->get_category_tree();
        //$this->$config=$categorys;//传递给属性,这样子类继承也能用
        $this->config=$config;//传递给属性,这样子类继承也能用
        //将店铺设置assign到页面中
        $this->assign(array(
            'articcles'=>$articleCats,
            'bts'=>$bt,
            'config'=>$config,
            'category'=>$categorys
        ));
    }

}
?>

