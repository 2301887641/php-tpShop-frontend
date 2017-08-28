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






	<!-- 列表主体 start -->
	<div class="list w1210 bc mt10">
		<!-- 面包屑导航 start -->
		<div class="breadcrumb">
			<h2>当前位置：<a href="">首页</a> > <a href="">电脑、办公</a></h2>
		</div>
		<!-- 面包屑导航 end -->

		<!-- 左侧内容 start -->
		<div class="list_left fl mt10">
			<!-- 分类列表 start -->
			<div class="catlist">
				<h2>电脑、办公</h2>
				<div class="catlist_wrap">
					<div class="child">
						<h3 class="on"><b></b>电脑整机</h3>
						<ul>
							<li><a href="">笔记本</a></li>
							<li><a href="">超极本</a></li>
							<li><a href="">平板电脑</a></li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>电脑配件</h3>
						<ul class="none">
							<li><a href="">CPU</a></li>
							<li><a href="">主板</a></li>
							<li><a href="">显卡</a></li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>办公打印</h3>
						<ul class="none">
							<li><a href="">打印机</a></li>
							<li><a href="">一体机</a></li>
							<li><a href="">投影机</a></li>
							</li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>网络产品</h3>
						<ul class="none">
							<li><a href="">路由器</a></li>
							<li><a href="">网卡</a></li>
							<li><a href="">交换机</a></li>
							</li>
						</ul>
					</div>

					<div class="child">
						<h3><b></b>外设产品</h3>
						<ul class="none">
							<li><a href="">鼠标</a></li>
							<li><a href="">键盘</a></li>
							<li><a href="">U盘</a></li>
						</ul>
					</div>
				</div>
				
				<div style="clear:both; height:1px;"></div>
			</div>
			<!-- 分类列表 end -->
				
			<div style="clear:both;"></div>	

			<!-- 新品推荐 start -->
			<div class="newgoods leftbar mt10">
				<h2><strong>新品推荐</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li>
							<dl>
								<dt><a href=""><img src="/Public/images/list_hot1.jpg" alt="" /></a></dt>
								<dd><a href="">美即流金丝语悦白美颜新年装4送3</a></dd>
								<dd><strong>￥777.50</strong></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/Public/images/list_hot2.jpg" alt="" /></a></dt>
								<dd><a href="">领券满399减50 金斯利安多维片</a></dd>
								<dd><strong>￥239.00</strong></dd>
							</dl>
						</li>

						<li class="last">
							<dl>
								<dt><a href=""><img src="/Public/images/list_hot3.jpg" alt="" /></a></dt>
								<dd><a href="">皮尔卡丹pierrecardin 男士长...</a></dd>
								<dd><strong>￥1240.50</strong></dd>
							</dl>
						</li>
					</ul>
				</div>
			</div>
			<!-- 新品推荐 end -->

			<!--热销排行 start -->
			<div class="hotgoods leftbar mt10">
				<h2><strong>热销排行榜</strong></h2>
				<div class="leftbar_wrap">
					<ul>
						<li></li>
					</ul>
				</div>
			</div>
			<!--热销排行 end -->

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
		<!-- 左侧内容 end -->
	
		<!-- 列表内容 start -->
		<div class="list_bd fl ml10 mt10">
			<!-- 热卖、促销 start -->
			<div class="list_top">
				<!-- 热卖推荐 start -->
				<div class="hotsale fl">
					<h2><strong><span class="none">热卖推荐</span></strong></h2>
					<ul>
						<li>
							<dl>
								<dt><a href=""><img src="/Public/images/hpG4.jpg" alt="" /></a></dt>
								<dd class="name"><a href="">惠普G4-1332TX 14英寸笔记本电脑 （i5-2450M 2G 5</a></dd>
								<dd class="price">特价：<strong>￥2999.00</strong></dd>
								<dd class="buy"><span>立即抢购</span></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/Public/images/list_hot3.jpg" alt="" /></a></dt>
								<dd class="name"><a href="">ThinkPad E42014英寸笔记本电脑</a></dd>
								<dd class="price">特价：<strong>￥4199.00</strong></dd>
								<dd class="buy"><span>立即抢购</span></dd>
							</dl>
						</li>

						<li>
							<dl>
								<dt><a href=""><img src="/Public/images/acer4739.jpg" alt="" /></a></dt>
								<dd class="name"><a href="">宏碁AS4739-382G32Mnkk 14英寸笔记本电脑</a></dd>
								<dd class="price">特价：<strong>￥2799.00</strong></dd>
								<dd class="buy"><span>立即抢购</span></dd>
							</dl>
						</li>
					</ul>
				</div>
				<!-- 热卖推荐 end -->

				<!-- 促销活动 start -->
				<div class="promote fl">
					<h2><strong><span class="none">促销活动</span></strong></h2>
					<ul>
						<li><b>.</b><a href="">DIY装机之向雷锋同志学习！</a></li>
						<li><b>.</b><a href="">京东宏碁联合促销送好礼！</a></li>
						<li><b>.</b><a href="">台式机笔记本三月巨惠！</a></li>
						<li><b>.</b><a href="">富勒A53g智能人手识别鼠标</a></li>
						<li><b>.</b><a href="">希捷硬盘白色情人节专场</a></li>
					</ul>

				</div>
				<!-- 促销活动 end -->
			</div>
			<!-- 热卖、促销 end -->
			
			<div style="clear:both;"></div>
			
			<!-- 商品筛选 start -->
			<div class="filter mt10">
				<h2><a href="">重置筛选条件</a> <strong>商品筛选</strong></h2>
				<div class="filter_wrap">
					<dl>
						<dt>品牌：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<?php foreach($brands as $b):?>
						<dd><a href="/Home/Index/search/<?php echo inUrl('brand',$b['id']);?>#px"><?php echo $b['brand_name']; ?></a></dd>
						<?php endforeach; ?>
					</dl>

					<dl>
						<dt>价格：</dt>
						<dd class="cur"><a href="">不限</a></dd>
						<?php foreach($price as $p): ?>
						<dd><a href="/Home/Index/search/<?php echo inUrl('price',$p);?>#px"><?php echo $p; ?></a></dd>
						<?php endforeach; ?>
					</dl>
					<?php foreach ($attr as $key => $value):$_arr=explode(',',$value['attr_values']);?>
					<dl>
						<dt><?php echo $value['attr_name'];?></dt>
						<dd class="cur"><a href="">不限</a></dd>
				       <?php foreach ($_arr as $k3 => $v3):?> 
						<dd><a href=""><?php echo $v3; ?></a></dd>
					<?php endforeach; ?>
					</dl>
					<?php endforeach;?>
				</div>
			</div>
			<!-- 商品筛选 end -->
			
			<div style="clear:both;"></div>

			<!-- 排序 start -->
			<div class="sort mt10">
				<dl>
				<a name="px"></a>
					<dt>排序：</dt>
					<!-- 将url上的get信息保留,防止丢失 -->
					<?php if($_GET['key']) $word='key/'.I('get.key'); else if($_GET['catId']) $word='catId/'.I('get.catId'); ?>
					<dd class="cur"><a href="/Home/Index/search<?php echo inUrl('od','xl')?>#px">销量</a></dd>
					<dd><a href="/Home/Index/search/<?php echo inUrl('od','shop_price')?>#px">价格</a></dd>
					<dd><a href="/Home/Index/search/<?php echo inUrl('od','pl')?>#px">评论数</a></dd>
					<dd><a href="/Home/Index/search/<?php echo inUrl('od','id')?>#px">上架时间</a></dd>
				</dl>
			</div>
			<!-- 排序 end -->
			<div style="clear:both;"></div>
			<!-- 商品列表 start-->
			<div class="goodslist mt10">
				<ul>
				<?php foreach($data as $k=>$v):?>
					<li>
						<dl>
							<dt><a href="/Home/Index/goods/id/<?php echo $v['id']?>"><img src="<?php echo URL_PATH.'/'.$v['logo']?>" alt="" /></a></dt>
							<dd><a href=""><?php echo $v['goods_name']?></a></dt>
							<dd><strong>￥<?php echo $v['shop_price']?></strong></dt>
							<dd><a href=""><em>已有<?php echo $v['pl']?>人评价 </em></a>销量<?php echo $v['xl']?></dt>
						</dl>
					</li>
				<?php endforeach;?>

		
				</ul>
			</div>
			<!-- 商品列表 end-->

			<!-- 分页信息 start -->
			<div class="page mt20">
			<?php echo $page;?>
			</div>
			<!-- 分页信息 end -->

		</div>
		<!-- 列表内容 end -->
	</div>
	<!-- 列表主体 end-->

	









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