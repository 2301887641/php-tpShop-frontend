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
<h1 class="fl"><a href="/"><img src="/Public/images/logo.png" alt="京西商城"></a></h1>
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




  
<!-- 综合区域 start 包括幻灯展示，商城快报 -->
	<div class="colligate w1210 bc mt10">
		<!-- 幻灯区域 start -->
		<div class="slide fl">
			<div class="area">
				<div class="slide_items">
					<ul>
                                            <?php echo $ad2;?>
					</ul>
				</div>
			</div>
		</div>
		<!-- 幻灯区域 end-->
	
		<!-- 快报区域 start-->
		<div class="coll_right fl ml10">
			<div class="ad"><?php echo $ad1?></div>
			<div class="news mt10">
				<h2><a href="">更多快报&nbsp;></a><strong>京西快报</strong></h2>
				<ul>
					<li class="odd"><a href="">电脑数码双11爆品抢不停</a></li>
					<li><a href="">买茶叶送武夷山旅游大奖</a></li>
					<li class="odd"><a href="">爆款手机最高直降1000</a></li>
					<li><a href="">新鲜褚橙全面包邮开售！</a></li>
					<li class="odd"><a href="">家具家装全场低至3折</a></li>
					<li><a href="">买韩束，志玲邀您看电影</a></li> 
					<li class="odd"><a href="">美的先行惠双11快抢悦</a></li>
					<li><a href="">享生活 疯狂周期购！</a></li>
				</ul>

			</div>
			
			<div class="service mt10">
				<h2>
					<span class="title1 on"><a href="">话费</a></span>
					<span><a href="">旅行</a></span>
					<span><a href="">彩票</a></span>
					<span class="title4"><a href="">游戏</a></span>
				</h2>
				<div class="service_wrap">
					<!-- 话费 start -->
					<div class="fare">
						<form action="">
							<ul>
								<li>
									<label for="">手机号：</label>
									<input type="text" name="phone" value="请输入手机号" class="phone" />
									<p class="msg">支持移动、联通、电信</p>
								</li>
								<li>
									<label for="">面值：</label>
									<select name="" id="">
										<option value="">10元</option>
										<option value="">20元</option>
										<option value="">30元</option>
										<option value="">50元</option>
										<option value="" selected>100元</option> 
										<option value="">200元</option>
										<option value="">300元</option>
										<option value="">400元</option>
										<option value="">500元</option>
									</select>
									<strong>98.60-99.60</strong>
								</li>
								<li>
									<label for="">&nbsp;</label>
									<input type="submit" value="点击充值" class="fare_btn" /> <span><a href="">北京青春怒放独家套票</a></span>
								</li>
							</ul>
						</form>
					</div>
					<!-- 话费 start -->
	
					<!-- 旅行 start -->
					<div class="travel none">
						<ul>
							<li>
								<a href=""><img src="/Public/images/holiday.jpg" alt="" /></a>
								<a href="" class="button">度假查询</a>
							</li>
							<li>
								<a href=""><img src="/Public/images/scenic.jpg" alt="" /></a>
								<a href="" class="button">景点查询</a>
							</li>
						</ul>
					</div>
					<!-- 旅行 end -->
						
					<!-- 彩票 start -->
					<div class="lottery none">
						<p><img src="/Public/images/lottery.jpg" alt="" /></p>
					</div>
					<!-- 彩票 end -->

					<!-- 游戏 start -->
					<div class="game none">
						<ul>
							<li><a href=""><img src="/Public/images/sanguo.jpg" alt="" /></a></li>
							<li><a href=""><img src="/Public/images/taohua.jpg" alt="" /></a></li>
							<li><a href=""><img src="/Public/images/wulin.jpg" alt="" /></a></li>
						</ul>
					</div>
					<!-- 游戏 end -->
				</div>
			</div>

		</div>
		<!-- 快报区域 end-->
	</div>
	<!-- -综合区域 end -->
	
	<div style="clear:both;"></div>

	<!-- 导购区域 start -->
	<div class="guide w1210 bc mt15">
		<!-- 导购左边区域 start -->
		<div class="guide_content fl">
			<h2>
				<span class="on">疯狂抢购</span>
				<span>热卖商品</span>
				<span>推荐商品</span>
				<span>新品上架</span>
				<span class="last">猜您喜欢</span>
			</h2>
			
			<div class="guide_wrap">
				<!-- 疯狂抢购 start-->
				<div class="crazy">
					<ul>
					
						<?php foreach($goods1 as $g1):?>	
						
                                            <li>
							<dl>
                                                            <dt><a href="/Home/Index/goods/id/<?php echo $g1['id']?>"><img src="<?php echo URL_PATH?>/<?php echo $g1['mid_logo']?>" alt="" /></a></dt>
								<dd><a href="/Home/Index/goods/id/<?php echo $g1['id']?>"><?php echo $g1['goods_name']?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo $g1['shop_price']?></strong></dd>
							</dl>
						</li>
                      <?php endforeach;?>    
					</ul>	
				</div>
				<!-- 疯狂抢购 end-->

				<!-- 热卖商品 start -->
				<div class="hot none">
					<ul>
                                            <?php foreach($goods2 as $g2):?>	
                                            <li>
							<dl>
                                                            <dt><a href="/Home/Index/goods/id/<?php echo $g2['id']?>"><img src="<?php echo URL_PATH?>/<?php echo $g2['mid_logo']?>" alt="" /></a></dt>
								<dd><a href="/Home/Index/goods/id/<?php echo $g2['id']?>"><?php echo $g2['goods_name']?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo $g2['shop_price']?></strong></dd>
							</dl>
						</li>
                                            <?php endforeach;?>    
					</ul>
				</div>
				<!-- 热卖商品 end -->

				<!-- 推荐商品 atart -->
				<div class="recommend none">
					<ul>
					<?php foreach($goods3 as $g3):?>	
                                            <li>
							<dl>
                                                            <dt><a href="/Home/Index/goods/id/<?php echo $g3['id']?>"><img src="<?php echo URL_PATH?>/<?php echo $g3['mid_logo']?>" alt="" /></a></dt>
								<dd><a href="/Home/Index/goods/id/<?php echo $g3['id']?>"><?php echo $g3['goods_name']?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo $g3['shop_price']?></strong></dd>
							</dl>
						</li>
                                            <?php endforeach;?>    
					</ul>
				</div>
				<!-- 推荐商品 end -->
			
				<!-- 新品上架 start-->
				<div class="new none">
					<ul>
						<?php foreach($goods4 as $g4):?>	
                                            <li>
							<dl>
                                                            <dt><a href="/Home/Index/goods/id/<?php echo $g4['id']?>"><img src="<?php echo URL_PATH?>/<?php echo $g4['mid_logo']?>" alt="" /></a></dt>
								<dd><a href="/Home/Index/goods/id/<?php echo $g4['id']?>"><?php echo $g4['goods_name']?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo $g4['shop_price']?></strong></dd>
							</dl>
						</li>
                                            <?php endforeach;?> 
					</ul>
				</div>
				<!-- 新品上架 end-->

				<!-- 猜您喜欢 start -->
				<div class="guess none">
					<ul>
						<?php foreach($goods5 as $g5):?>	
                                            <li>
							<dl>
                                                            <dt><a href="/Home/Index/goods/id/<?php echo $g5['id']?>"><img src="<?php echo URL_PATH?>/<?php echo $g5['mid_logo']?>" alt="" /></a></dt>
								<dd><a href="/Home/Index/goods/id/<?php echo $g5['id']?>"><?php echo $g5['goods_name']?></a></dd>
								<dd><span>售价：</span><strong> ￥<?php echo $g5['shop_price']?></strong></dd>
							</dl>
						</li>
                                            <?php endforeach;?> 
					</ul>
				</div>
				<!-- 猜您喜欢 end -->

			</div>

		</div>
		<!-- 导购左边区域 end -->
		
		<!-- 侧栏 网站首发 start-->
		<div class="sidebar fl ml10">
			<h2><strong>网站首发</strong></h2>
			<div class="sidebar_wrap">
				<dl class="first">
					<dt class="fl"><a href=""><img src="/Public/images/viewsonic.jpg" alt="" /></a></dt>
					<dd><strong><a href="">ViewSonic优派N710 </a></strong> <em>首发</em></dd>
					<dd>苹果iphone 5免费送！攀高作为全球智能语音血压计领导品牌，新推出的黑金刚高端智能电子血压计，改变传统测量方式让血压测量迈入一体化时代。</dd>
				</dl>

				<dl>
					<dt class="fr"><a href=""><img src="/Public/images/samsung.jpg" alt="" /></a></dt>
					<dd><strong><a href="">Samsung三星Galaxy</a></strong> <em>首发</em></dd>
					<dd>电视百科全书，360°无死角操控，感受智能新体验！双核CPU+双核GPU+MEMC运动防抖，58寸大屏打造全新视听盛宴！</dd>
				</dl>
			</div>
			

		</div>
		<!-- 侧栏 网站首发 end -->
		
	</div>
	<!-- 导购区域 end -->
	
	<div style="clear:both;"></div>
        <?php foreach($cat as $k=>$c):?>
	<!--1F 电脑办公 start -->
	<div class="floor1 floor w1210 bc mt10">
		<!-- 1F 左侧 start -->
		<div class="floor_left fl">
			<!-- 商品分类信息 start-->
			<div class="cate fl">
				<h2><?php echo $c['cat_name']?></h2>
				<div class="cate_wrap">
					<ul>
                                            <?php foreach($c['subCat'] as $cc):?>
						<li><a href=""><b>.</b><?php echo $cc['cat_name']?></a></li>
                                            <?php endforeach;?>    
					</ul>
					<p><a href=""><img src="/Public/images/notebook.jpg" alt="" /></a></p>
				</div>
				

			</div>
			<!-- 商品分类信息 end-->

			<!-- 商品列表信息 start-->
			<div class="goodslist fl">
				<h2>
					<span class="on">推荐商品</span>
                                        <?php foreach($c['recSubcat'] as $ccc):?>
					<span><?php echo $ccc['cat_name']?></span>
                                        <?php endforeach;?>
				</h2>
				<div class="goodslist_wrap">
					<div>
						<ul>
						<?php foreach($c['goods'] as $cccc):?>
                                                    <li>
								<dl>
                                                                    <dt><a href="/Home/Index/goods/id/<?php echo $cccc['id']?>"><img src="<?php echo URL_PATH.'/'.$cccc['mid_logo']?>" alt="" /></a></dt>
									<dd><a href=""><?php echo $cccc['goods_name']?> </a></dd>
									<dd><span>售价：</span> <strong><?php echo $cccc['shop_price']?></strong></dd>
								</dl>
							</li>
                                                <?php endforeach;?>        
						</ul>
					</div>
					<?php foreach($c['recSubcat'] as $ccccc):?>
                                       
					<div class="none">
						<ul>
                                                    <?php foreach($ccccc['goods'] as $c6):?>
							<li>
								<dl>
									<dt><a href=""><img src="<?php echo URL_PATH.'/'.$c6['mid_logo']?>" alt="" /></a></dt>
									<dd><a href=""><?php echo $c6['goods_name']?></a></dd>
									<dd><span>售价：</span> <strong>￥<?php echo $c6['shop_price']?></strong></dd>
								</dl>
							</li>

                                                    <?php endforeach;?>            
						</ul>
					</div>
                                        <?php endforeach;?>
				</div>
			</div>
			<!-- 商品列表信息 end-->
		</div>
		<!-- 1F 左侧 end -->
                
		<!-- 右侧 start -->
		<div class="sidebar fl ml10">
			<!-- 品牌旗舰店 start -->
			<div class="brand">
				<h2><a href="">更多品牌&nbsp;></a><strong>品牌旗舰店</strong></h2>
				<div class="sidebar_wrap">
					<ul>
                                            <?php foreach($cat[$k]['brand'] as $c7):?>
                                            <li><a href="<?php echo (strpos('http://',$c7['brand_url'])!==0)? 'http://'.$c7['brand_url']:$c7['brand_url']?>" target="_blank"><img src="<?php echo URL_PATH.'/'.$c7['brand_logo']?>" alt="" /></a></li>
                                            <?php endforeach;?>        
					</ul>
				</div>
			</div>
			<!-- 品牌旗舰店 end -->
			
			<!-- 分类资讯 start -->
			<div class="info mt10">
				<h2><strong>分类资讯</strong></h2>
				<div class="sidebar_wrap">
					<ul>
						<li><a href=""><b>.</b>iphone 5s土豪金大量到货</a></li>
						<li><a href=""><b>.</b>三星note 3低价促销</a></li>
						<li><a href=""><b>.</b>thinkpad x240即将上市</a></li>
						<li><a href=""><b>.</b>双十一来临，众商家血拼</a></li>
					</ul>
				</div>
				
			</div>
			<!-- 分类资讯 end -->
			
			<!-- 广告 start -->
			<div class="ads mt10">
				<a href=""><img src="/Public/images/canon.jpg" alt="" /></a>
			</div>
			<!-- 广告 end -->
		</div>
		<!-- 右侧 end -->

	</div>
	<!--1F 电脑办公 start -->
        <?php endforeach;?>









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