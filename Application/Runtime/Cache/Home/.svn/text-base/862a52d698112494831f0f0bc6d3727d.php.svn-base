<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta name="keywords" content="">
<meta name="description" content="">

<title><?php echo $page_title?></title>
<link rel="stylesheet" href="/Public/style/base.css" type="text/css">
<link rel="stylesheet" href="/Public/style/global.css" type="text/css">
<link rel="stylesheet" href="/Public/style/header.css" type="text/css">
<?php foreach($css as $c):?>   
<link rel="stylesheet" href="/Public/style/<?php echo $c?>.css" type="text/css">
<?php endforeach;?>   
<link rel="stylesheet" href="/Public/style/bottomnav.css" type="text/css">
<link rel="stylesheet" href="/Public/style/footer.css" type="text/css">
<script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/Public/js/header.js"></script>
<script type="text/javascript" src="/Public/js/login.js"></script>

<?php foreach($js as $j):?>
<script type="text/javascript" src="/Public/js/<?php echo $j?>.js"></script>
<?php endforeach;?>
</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
<div class="topnav_bd w1210 bc">
<div class="topnav_left">

</div>
<div class="topnav_right fr">
<ul>

<li class="login_info"></li>
<?php if($bts['上']) foreach($bts['上'] as $bbb) :?>
<li class="line">|</li>
<li><?php echo $bbb['btn_name']?></li>
<?php endforeach;?>
</ul>
</div>
</div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 头部 start -->
<div class="header w1210 bc mt15">
<!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
<div class="logo w1210">
<h1 class="fl"><a href="index.html"><img src="/Public/images/logo.png" alt="京西商城"></a></h1>
<!-- 头部搜索 start -->
<div class="search fl">
<div class="search_form">
<div class="form_left fl"></div>
<form action="/Home/Index/search" target="_blank" name="serarch" method="get" class="fl">
<input name="key" type="text" class="txt" value="<?php if(I('key')) echo I('key'); else echo '请输入商品关键字';?>" /><input type="submit" class="btn" value="搜索" />
</form>
<div class="form_right fl"></div>
</div>

<div style="clear:both;"></div>

<div class="hot_search">
<strong>热门搜索:</strong>
<?php $arr=explode(",",$config["热门搜索"]);?>
<?php foreach ($arr as $key => $value):?> 
	<a href="/Home/Index/search/key/<?php echo $value;?>" target="_blank"><?php echo $value;?></a>
<?php endforeach;?>	
</div>
</div>
<!-- 头部搜索 end -->

<!-- 用户中心 start-->
<div class="user fl">
<dl>
<dt>
<em></em>
<a href="">用户中心</a>
<b></b>
</dt>
<dd>
<div class="prompt">
您好，请<a href="">登录</a>
</div>
<div class="uclist mt10">
<ul class="list1 fl">
<li><a href="">用户信息></a></li>
<li><a href="">我的订单></a></li>
<li><a href="">收货地址></a></li>
<li><a href="">我的收藏></a></li>
</ul>

<ul class="fl">
<li><a href="">我的留言></a></li>
<li><a href="">我的红包></a></li>
<li><a href="">我的评论></a></li>
<li><a href="">资金管理></a></li>
</ul>

</div>
<div style="clear:both;"></div>
<div class="viewlist mt10">
<h3>最近浏览的商品：</h3>
<ul>
<li><a href=""><img src="/Public/images/view_list1.jpg" alt="" /></a></li>
<li><a href=""><img src="/Public/images/view_list2.jpg" alt="" /></a></li>
<li><a href=""><img src="/Public/images/view_list3.jpg" alt="" /></a></li>
</ul>
</div>
</dd>
</dl>
</div>
<!-- 用户中心 end-->

<!-- 购物车 start -->
<div class="cart fl">
<dl>
<dt>
<a href="/Home/Flow/flow2">去购物车结算</a>
<b></b>
</dt>
<dd>
<div class="prompt">
购物车中还没有商品，赶紧选购吧！
</div>
</dd>
</dl>
</div>
<!-- 购物车 end -->
</div>
<!-- 头部上半部分 end -->

<div style="clear:both;"></div>

<!-- 导航条部分 start -->
<div class="nav w1210 bc mt10">
<!--  商品分类部分 start-->

<div class="category fl <?php if(!isset($nav_show)) echo 'cat1'?>"> <!-- 非首页，需要添加cat1类 -->
<div class="cat_hd <?php if(!isset($nav_show)) echo 'off'?>">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
<h2>全部商品分类</h2>
<em></em>
</div>

<div class="cat_bd <?php if(!isset($nav_show)) echo 'none'?>">
<?php foreach($category as $k=>$c):?>
<div class="cat <?php if($k==0) echo 'item1'?>">
<h3><a href="/Home/Index/search/catId/<?php echo $c['id']?>"><?php echo $c['cat_name']?></a> <b></b></h3>
<div class="cat_detail">
<dl class="dl_1st">
<?php foreach($c['children'] as $child):?>
<dt><a href="/Home/Index/search/catId/<?php echo $child['id']?>"><?php echo $child['cat_name']?></a></dt>

<dd>
<?php foreach($child['children'] as $childs):?>
<a href="/Home/Index/search/catId/<?php echo $childs['id']?>"><?php echo $childs['cat_name']?></a>
<?php endforeach;?>    

</dd>
<?php endforeach;?>
</dl>


</div>
</div>
<?php endforeach;?>
</div>

</div>


<!--  商品分类部分 end--> 

<div class="navitems fl">
<ul class="fl">
<li class="current"><a href="">首页</a></li>
<?php if($bts['中']) foreach($bts['中'] as $bb) :?>
<li><a href=""><?php echo $bb['btn_name']?></a></li>

<?php endforeach;?>
</ul>
<div class="right_corner fl"></div>
</div>

</div>
<!-- 导航条部分 end -->

<!-- 头部 end-->
<div style="clear:both;"></div>





<!-- 商品页面主体 start -->
<div class="main w1210 mt10 bc">
    <!-- 面包屑导航 start -->
    <div class="breadcrumb">
        <h2>当前位置：<a href="">首页</a> > <a href="">电脑、办公</a> > <a href="">笔记本</a> > ThinkPad X230(23063T4）12.5英寸笔记本</h2>
    </div>
    <!-- 面包屑导航 end -->

    <!-- 主体页面左侧内容 start -->
    <div class="goods_left fl">
        <!-- 相关分类 start -->
        <div class="related_cat leftbar mt10">
            <h2><strong>相关分类</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li><a href="">笔记本</a></li>
                    <li><a href="">超极本</a></li>
                    <li><a href="">平板电脑</a></li>
                </ul>
            </div>
        </div>
        <!-- 相关分类 end -->
        <!-- 相关品牌 start -->
        <div class="related_cat	leftbar mt10">
            <h2><strong>同类品牌</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li><a href="">D-Link</a></li>
                    <li><a href="">戴尔</a></li>
                    <li><a href="">惠普</a></li>
                    <li><a href="">苹果</a></li>
                    <li><a href="">华硕</a></li>
                    <li><a href="">宏基</a></li>
                    <li><a href="">神舟</a></li>
                </ul>
            </div>
        </div>
        <!-- 相关品牌 end -->

        <!-- 热销排行 start -->
        <div class="hotgoods leftbar mt10">
            <h2><strong>热销排行榜</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li></li>
                </ul>
            </div>
        </div>
        <!-- 热销排行 end -->


        <!-- 浏览过该商品的人还浏览了  start 注：因为和list页面newgoods样式相同，故加入了该class -->
        <div class="related_view newgoods leftbar mt10">
            <h2><strong>浏览了该商品的用户还浏览了</strong></h2>
            <div class="leftbar_wrap">
                <ul>
                    <li>
                        <dl>
                            <dt><a href=""><img src="/Public/images/relate_view1.jpg" alt="" /></a></dt>
                            <dd><a href="">ThinkPad E431(62771A7) 14英寸笔记本电脑 (i5-3230 4G 1TB 2G独显 蓝牙 win8)</a></dd>
                            <dd><strong>￥5199.00</strong></dd>
                        </dl>
                    </li>

                    <li>
                        <dl>
                            <dt><a href=""><img src="/Public/images/relate_view2.jpg" alt="" /></a></dt>
                            <dd><a href="">ThinkPad X230i(2306-3V9） 12.5英寸笔记本电脑 （i3-3120M 4GB 500GB 7200转 蓝牙 摄像头 Win8）</a></dd>
                            <dd><strong>￥5199.00</strong></dd>
                        </dl>
                    </li>

                    <li>
                        <dl>
                            <dt><a href=""><img src="/Public/images/relate_view3.jpg" alt="" /></a></dt>
                            <dd><a href="">T联想（Lenovo） Yoga13 II-Pro 13.3英寸超极本 （i5-4200U 4G 128G固态硬盘 摄像头 蓝牙 Win8）晧月银</a></dd>
                            <dd><strong>￥7999.00</strong></dd>
                        </dl>
                    </li>

                    <li>
                        <dl>
                            <dt><a href=""><img src="/Public/images/relate_view4.jpg" alt="" /></a></dt>
                            <dd><a href="">联想（Lenovo） Y510p 15.6英寸笔记本电脑（i5-4200M 4G 1T 2G独显 摄像头 DVD刻录 Win8）黑色</a></dd>
                            <dd><strong>￥6199.00</strong></dd>
                        </dl>
                    </li>

                    <li class="last">
                        <dl>
                            <dt><a href=""><img src="/Public/images/relate_view5.jpg" alt="" /></a></dt>
                            <dd><a href="">ThinkPad E530c(33662D0) 15.6英寸笔记本电脑 （i5-3210M 4G 500G NV610M 1G独显 摄像头 Win8）</a></dd>
                            <dd><strong>￥4399.00</strong></dd>
                        </dl>
                    </li>					
                </ul>
            </div>
        </div>
        <!-- 浏览过该商品的人还浏览了  end -->

        <!-- 最近浏览 start -->
        <div class="viewd leftbar mt10">
            <h2><a href="">清空</a><strong>最近浏览过的商品</strong></h2>
            <div class="leftbar_wrap">
                <dl>
                    <dt><a href=""><img src="/Public/images/hpG4.jpg" alt="" /></a></dt>
                    <dd><a href="">惠普G4-1332TX 14英寸笔记...</a></dd>
                </dl>

                <dl class="last">
                    <dt><a href=""><img src="/Public/images/crazy4.jpg" alt="" /></a></dt>
                    <dd><a href="">直降200元！TCL正1.5匹空调</a></dd>
                </dl>
            </div>
        </div>
        <!-- 最近浏览 end -->

    </div>
    <!-- 主体页面左侧内容 end -->

    <!-- 商品信息内容 start -->
    <div class="goods_content fl mt10 ml10">
        <!-- 商品概要信息 start -->
        <div class="summary">
            <h3><strong><?php echo $goods['goods_name']?></strong></h3>

            <!-- 图片预览区域 start -->
            <div class="preview fl">
                <div class="midpic">
                    <a href="<?php echo URL_PATH.'/'.$goods['logo']?>" class="jqzoom" rel="gal1">  <!--  第一幅图片的大图 class 和 rel属性不能更改 -->
                        <img src="<?php echo URL_PATH.'/'.$goods['big_logo']?>" alt="" />              <!--  第一幅图片的中图 -->
                    </a>
                </div>

                <!--使用说明：此处的预览图效果有三种类型的图片，大图，中图，和小图，取得图片之后，分配到模板的时候，把第一幅图片分配到 上面的midpic 中，其中大图分配到 a 标签的href属性，中图分配到 img 的src上。 下面的smallpic 则表示小图区域，格式固定，在 a 标签的 rel属性中，分别指定了中图（smallimage）和大图（largeimage），img标签则显示小图，按此格式循环生成即可，但在第一个li上，要加上cur类，同时在第一个li 的a标签中，添加类 zoomThumbActive  -->

                <div class="smallpic">
                    <a href="javascript:;" id="backward" class="off"></a>
                    <a href="javascript:;" id="forward" class="on"></a>
                    <div class="smallpic_wrap">
                        <ul>
                            <li class="cur">
                                <a class="zoomThumbActive" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?php echo URL_PATH.'/'.$goods['big_logo']?>',largeimage: '<?php echo URL_PATH.'/'.$goods['logo']?>'}"><img src="<?php echo URL_PATH.'/'.$goods['sm_logo']?>"></a>
                            </li>
                            <?php foreach($goods_pic as $g):?>
                                <li>
                                    <a href="javascript:void(0);" 
                                    rel="{gallery: 'gal1', smallimage: '<?php echo URL_PATH.'/'.$g['big_logo']?>',largeimage: '<?php echo URL_PATH.'/'.$g['logo']?>'}">
                                    <img src="<?php echo URL_PATH.'/'.$g['sm_logo']?>"></a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- 图片预览区域 end -->

            <!-- 商品基本信息区域 start -->
            <div class="goodsinfo fl ml10">
                <ul>
                    <li><span>商品编号： </span><?php echo $goods['goods_sn']?></li>
                    <li class="market_price"><span>定价：</span><em>￥<?php echo $goods['market_price']?></em></li>
                    <li class="shop_price"><span>本店价：</span> <strong>￥<?php echo $goods['shop_price']?></strong> <a href="">(降价通知)</a></li>
                    <li class="shop_price member_price"><span>会员价：</span> <strong></strong></li> 
                    <li class="star"><span>商品评分：</span> <strong></strong><a href="">(已有21人评价)</a></li> <!-- 此处的星级切换css即可 默认为5星 star4 表示4星 star3 表示3星 star2表示2星 star1表示1星 -->

                </ul>
                <form action="/Home/Flow/addToCart" method="post" class="choose">
                    <input type="hidden" name="goods_id" value="<?php echo $goods['id'];?>">
                    <ul>
                        <?php foreach($radio as $k=>$r):?>    
                            <li class="product">
                                <dl>
                                    <dt><?php echo $r[0]['attr_name'];?>：</dt>
                                    <dd>
                                     <!--  页面中提交商品的属性时,因为属性的id不同,所以构建name="goods_attr[<?php echo $k?>]"来进行提交时的区分 用于将单选按钮区分开
                                     cookir中存储的是id,所以这里也要提交商品属性表的id
                                 -->
                                 <?php foreach($r as $kk=>$rr):?>   
                                    <a class="<?php if($kk==0) echo 'selected';?>" href="javascript:;"><?php echo $rr['attr_value']?>[+￥<?php echo $rr['attr_price']?>元]<input type="radio" name="goods_attr[<?php echo $k?>]" value="<?php echo $rr['id']?>" <?php if($kk==0) echo 'checked="checked"'?>/></a>
                                <?php endforeach;?>

                            </dd>
                        </dl>
                    </li>
                <?php endforeach;?>


                <li>
                    <dl>
                        <dt>购买数量：</dt>
                        <dd>
                            <a href="javascript:;" id="reduce_num"></a>
                            <input type="text" name="amount" value="1" class="amount"/>
                            <a href="javascript:;" id="add_num"></a>
                        </dd>
                    </dl>
                </li>
                <li class="shop_price kucun"></li>
                <li>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd>
                            <input type="submit" value="" class="add_btn" />
                        </dd>
                    </dl>
                </li>

            </ul>
        </form>
    </div>
    <!-- 商品基本信息区域 end -->
</div>
<!-- 商品概要信息 end -->

<div style="clear:both;"></div>

<!-- 商品详情 start -->
<div class="detail">
    <div class="detail_hd">
        <ul>
            <li class="first"><span>商品介绍</span></li>
            <li class="on"><span>商品评价</span></li>
            <li><span>售后保障</span></li>
        </ul>
    </div>
    <div class="detail_bd">
        <!-- 商品介绍 start -->
        <div class="introduce detail_div none">
            <div class="attr mt15">
                <ul>
                    <?php foreach($requires as $r):?>    
                        <li><span><?php echo $r['attr_name']?>：</span><?php echo $r['attr_value']?></li>
                    <?php endforeach;?>
                </ul>
            </div>

            <div class="desc mt10">
                <!-- 此处的内容 一般是通过在线编辑器添加保存到数据库，然后直接从数据库中读出 -->
                <?php echo htmlspecialchars_decode($goods['goods_desc']);?>
            </div>
        </div>
        <!-- 商品介绍 end -->

        <!-- 商品评论 start -->
        <div class="comment detail_div mt10">
            <div class="comment_summary">
                <div class="rate fl">

                </div>
                <div class="percent fl">

                </div>
                <div class="buyer fl">
                    <dl>
                        <dt>买家印象：</dt>

                    </dl>
                </div>
            </div>
            <!--用户评论js动态插入-->
            <div id="pinglun"></div>    






            <!-- 加载更多 start -->
            <div class="get_more">加载更多</div>
            <!-- 加载更多 end -->

            <!--  评论表单 start-->
            <div class="comment_form mt20">
                <form id="send_contents">
                    <!--获取商品的id,好发送给后台-->
                    <input type="hidden" name="goods_id" value="<?php echo I('get.id')?>">
                    <ul>
                        <li>
                            <label for=""> 评分：</label>
                            <input type="radio" name="star" value="5" checked="checked"/> <strong class="star star5"></strong>
                            <input type="radio" name="star" value="4"/> <strong class="star star4"></strong>
                            <input type="radio" name="star" value="3"/> <strong class="star star3"></strong>
                            <input type="radio" name="star" value="2"/> <strong class="star star2"></strong>
                            <input type="radio" name="star" value="1"/> <strong class="star star1"></strong>
                        </li>

                        <li>
                            <label for="">评价内容：</label>
                            <textarea name="content" id="" cols="" rows=""></textarea>
                        </li>
                        <li>
                            <label for="">印象：</label>
                            <input name="yx_name" type="text" size="80px">
                        </li>
                        <li>
                            <label for="">&nbsp;</label>
                            <input type="button" value="提交评论"  class="comment_btn"/>										
                        </li>
                    </ul>
                </form>
            </div>
            <!--  评论表单 end-->

        </div>
        <!-- 商品评论 end -->

        <!-- 售后保障 start -->
        <div class="after_sale mt15 none detail_div">
            <div>
                <p>本产品全国联保，享受三包服务，质保期为：一年质保 <br />如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7日内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！</p>
                <p>售后服务电话：800-898-9006 <br />品牌官方网站：http://www.lenovo.com.cn/</p>

            </div>

            <div>
                <h3>服务承诺：</h3>
                <p>本商城向您保证所售商品均为正品行货，京东自营商品自带机打发票，与商品一起寄送。凭质保证书及京东商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由本商城联系保修，享受法定三包售后服务），与您亲临商场选购的商品享受相同的质量保证。本商城还为您提供具有竞争力的商品价格和运费政策，请您放心购买！</p> 

                <p>注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！</p>

            </div>

            <div>
                <h3>权利声明：</h3>
                <p>本商城上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是京东商城重要的经营资源，未经许可，禁止非法转载使用。</p>
                <p>注：本站商品信息均来自于厂商，其真实性、准确性和合法性由信息拥有者（厂商）负责。本站不提供任何保证，并不承担任何法律责任。</p>

            </div>
        </div>
        <!-- 售后保障 end -->

    </div>
</div>
<!-- 商品详情 end -->


</div>
<!-- 商品信息内容 end -->


</div>
<!-- 商品页面主体 end -->
<script>
//ajax根据后台返回数据决定是否隐藏评论功能        
$(function () {
    //默认取评论的第一页	
    var page = 1;
    //comment元素到达顶部的距离
    var comment_offset_top=$('.comment').offset().top;
    //获取当前窗口的高度
    var window_offset_top=$(window).height();
   //滚动条监听事件
   $(window).scroll(function(){
    //获取滚动条下拉的距离
    var comment_scroll_top=$(window).scrollTop();   
    //判断如果(当前窗口的高度+滚动条下拉后距离顶部的高度)如果大于元素距离浏览器顶部的距离(说明下拉到这个元素了),就显示该元素,并停止窗口滚动事件监听    
    if((comment_scroll_top+window_offset_top)>comment_offset_top){
     $(window).unbind('scroll'); 
//  这个函数用来获取第几页的评论数据
ajaxGetRemark(page);    

}

});



    //当点击加载加载更多时,显示下一页的信息到页面中
    $('.get_more').click(function(){
    //++page,必须先++,不然page==1还会循环一次,这样才能取下一页    
    ajaxGetRemark(++page);

});
    
    //获取所有会员以及匿名用户对当前商品的评论
    function ajaxGetRemark(page) {
        $.ajax({
            url: '/Home/Index/ajaxGetRemark/pages/' + page + '/goods_id/' + <?php echo I('get.id')?>,
            dataType: 'json',
            success: function (value) {
            //判断如果查找的评论为空了,没有评论了
            if(value.remark==''){
            //将'加载更多'改为没有了
            $('.get_more').html('没有了');
            //将'加载更多'的click事件取消掉
            $('.get_more').unbind('click');
            
        }
    //这里在取总评分数和好评,中评以及差评时,只有在第一页时才获取这些数据        
    if(page==1){
    //使用jquery.html()命令时,要让html代码放在一行上不然会报错.取出好评来        
    $('.rate').html('<strong><em>'+value.good+'</em>%</strong><br /><span>好评度</span>');
    $('.percent').html('<dl><dt>好评（'+value.good+'%）</dt><dd><div style="width:"'+value.good+'"px;"></div></dd></dl><dl><dt>中评（'+value.middle+'%）</dt><dd><div style="width:'+value.middle+'px;"></div></dd></dl><dl><dt>差（'+value.cha+'%）</dt><dd><div style="width:'+value.cha+'px;" ></div></dd></dl>');
         //取出当前商品被用户评论的印象
         $.each(value.yinxiang,function(i,n){  
            $('.buyer dl').append('<dd><span>'+value.yinxiang[i]['yx_name']+'</span><em>('+value.yinxiang[i]['yx_count']+')</em></dd>');

        });
     }
    //非第一页获取数据循环,将pinglun属性中的数据循环取出
    $.each(value['remark'],function(i,n){ 
     $('#pinglun').append('<div class="comment_items mt10"><div class="user_pic"><dl><dt><a href=""><img src="'+n.face+'" alt="" /></a></dt><dd><a href="">'+n.username+'</a></dd></dl></div><div class="item"><div class="title" style="margin-bottom:30px;"><span>'+n.addtime+'</span><strong class="star star'+n.star+'"></strong> <!-- star5表示5星级 start4表示4星级，以此类推 --></div><div class="comment_content" >'+n.content+'</div></div><div class="cornor"></div></div>');
 });

}
});
}

    //将评论元素对象获取到    
    var cf = $('.comment_form');
    $.ajax({
        url: '/Home/Index/ajaxGetRemarkConfig/',
        success: function (data) {
            //判断如果返回的是-1,并且window.login()为真才能证明用户登录了    
            if (data == -1) {
                if (window.login) {
                    cf.show();
                    //否则隐藏评论功能
                } else {
                    cf.hide();
                }
                //如果返回1表示全部显示 
            } else {
                cf.show();
            }
        }
    });

    //用户提交评论ajax
    $('.comment_btn').click(function () {
        var str = $('textarea[name="content"]').val();
        var str2 = $('input[name="yx_name"]').val();

        var d = $('#send_contents').serialize();
        $.ajax({
            type: 'post',
            url: '/Home/Index/ajaxRemark',
            data: d,
            datetype: 'json',
            success: function (data) {
                alert(data.info);
                $('#send_contents')[0].reset();
            }
        });

    });
//js放大镜效果    
$('.jqzoom').jqzoom({
    zoomType: 'standard',
    lens: true,
    preloadImages: false,
    alwaysOn: false,
    title: false,
    zoomWidth: 400,
    zoomHeight: 400
});
//获取当前商品的会员价格    
$('.member_price strong').load("/Home/Index/ajaxGetMemberPrice/goods_id/<?php echo $goods['id']?>");

//页面加载完毕,先执行这个函数检查

});
ajaxCheckGn();
//检查商品的库存量
function ajaxCheckGn(){
    var goods_id="<?php echo $goods['id']?>";
    //arr这个数组用来存放单选框中被选中的属性值
    var arr=[];
//遍历所有被选中的属性
$('.selected').each(function(){
//查找出所有被选中的单选框中的值    
arr.push($(this).find(":radio").val());
});
//转换成字符串拼接
var _arr=arr.join(',');
    /*
    对url地址进行特殊处理,发送到当前模块下的Flow控制器下的ajaxGetGn方法,
    如果没有传递$goods_attr属性则不发送
    */
    var url=_arr?"/Home/Flow/ajaxGetGn/goods_id/"+goods_id+'/goods_attr/'+_arr:"/Home/Flow/ajaxGetGn/goods_id/"+goods_id;
    //取出购买数量
    var amount=$('.amount').val();
    $.ajax({
        url:url,
        success:function(data){
    //判断如果服务器端返回有数据显示有货,否则无货    
    if((data-amount)>=0){
      $('.kucun').html("<span>库存：</span><strong>有货</strong>"); 
      $('.add_btn').removeAttr('disabled');

  }else{
    $('.add_btn').attr('disabled',true);
    $('.kucun').html("<span>库存：</span><strong>缺货</strong>");  
}
}
});
}
</script>    












<div style="clear:both;"></div>

<!-- 底部导航 start -->
<div class="bottomnav w1210 bc mt10">
<?php foreach($articcles as $a):?>

<div class="bnav<?php echo ++$i?>">
<h3><b></b> <em><?php echo $a['cat_name']?></em></h3>
<ul>
<?php foreach($a['articles'] as $aa):?>
<li><a href=""><?php echo $aa['title']?></a></li>
<?php endforeach;?>	
</ul>
</div>
<?php endforeach;?>

</div>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt10">
<p class="links">
<?php if($bts['下']) foreach($bts['下'] as $b) :?>
<a href=""><?php echo $b['btn_name']?></a> |
<?php endforeach;?>
</p>
<p class="copyright">
<?php echo $config['tcp备案号']?> 
</p>
<p class="auth">
<a href=""><img src="/Public/images/xin.png" alt="" /></a>
<a href=""><img src="/Public/images/kexin.jpg" alt="" /></a>
<a href=""><img src="/Public/images/police.jpg" alt="" /></a>
<a href=""><img src="/Public/images/beian.gif" alt="" /></a>
</p>
</div>
<!-- 底部版权 end -->

</body>
</html>