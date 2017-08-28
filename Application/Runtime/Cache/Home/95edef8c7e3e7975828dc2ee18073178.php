<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>填写核对订单信息</title>
	<link rel="stylesheet" href="/Public/style/base.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/global.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/header.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/fillin.css" type="text/css">
	<link rel="stylesheet" href="/Public/style/footer.css" type="text/css">

	<script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/Public/js/login.js"></script>
	<script type="text/javascript" src="/Public/js/cart2.js"></script>

</head>
<body>
	<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li class="login_info"></li>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="/"><img src="/Public/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr flow2">
				<ul>
					<li>1.我的购物车</li>
					<li class="cur">2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="fillin w990 bc mt15">
		<div class="fillin_hd">
			<h2>填写并核对订单信息</h2>
		</div>
		<form action="/Home/Flow/flow3" method="post"  name="address_form">
		<div class="fillin_bd">
			<!-- 收货人信息  start-->
			<div class="address">
				<h3>收货人信息</h3>
				<div class="address_info">
				<?php foreach($address as $a):?>
					<p><input type="radio" name="address"  value="<?php echo $a['id']?>"><?php echo $a['member_name'],'  ',$a['member_phone'];?>
					<?php echo $a['member_province'],' ',$a['member_city'],'  ',$a['member_area'],'  ',$a['member_address']?></p>
				</div>
			<?php endforeach;?>
				<div class="address_select">
					<ul>
						<li><input type="radio" checked="checked" name="address" class="new_address" value="new" />使用新地址</li>
					</ul>	
						<ul>
							<li>
								<label for=""><span>*</span>收 货 人：</label>
								<input type="text" name="member_name" class="txt" />
							</li>
							<li>
								<label for=""><span>*</span>所在地区：</label>
								<select name="member_province">
									<option value="">请选择</option>
									<option value="北京">北京</option>
									<option value="上海">上海</option>
									<option value="天津">天津</option>
									<option value="重庆">重庆</option>
									<option value="武汉">武汉</option>
								</select>

								<select name="member_city">
									<option value="">请选择</option>
									<option value="朝阳区">朝阳区</option>
									<option value="东城区">东城区</option>
									<option value="西城区">西城区</option>
									<option value="海淀区">海淀区</option>
									<option value="昌平区">昌平区</option>
								</select>

								<select name="member_area">
									<option value="">请选择</option>
									<option value="西二旗">西二旗</option>
									<option value="西三旗">西三旗</option>
									<option value="三环以内">三环以内</option>
								</select>
							</li>
							<li>
								<label for=""><span>*</span>详细地址：</label>
								<input type="text" name="member_address" class="txt address"  />
							</li>
							<li>
								<label for=""><span>*</span>手机号码：</label>
								<input type="text" name="member_phone" class="txt" />
							</li>
						</ul>
				</div>
			</div>
			<!-- 收货人信息  end-->

			<!-- 配送方式 start -->
			<div class="delivery">
				<h3>送货方式</h3>
				<div class="delivery_select">
					<table>
						<thead>
							<tr>
								<th class="col1">送货方式</th>
								<th class="col2">运费</th>
								<th class="col3">运费标准</th>
							</tr>
						</thead>
						<tbody>
							<tr class="cur">	
								
								<td><input type="radio" name="delivery" value="顺丰" />顺丰快递</td>
								<td>￥10.00</td>
								<td>每张订单不满499.00元,运费15.00元, 订单4...
							</tr>
							<tr>
								
								<td><input type="radio" name="delivery" value="圆通" />圆通快递</td>
								<td>￥40.00</td>
								<td>每张订单不满499.00元,运费40.00元, 订单4...</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div> 
			<!-- 配送方式 end --> 

			<!-- 支付方式  start-->
			<div class="pay">
				<h3>支付方式</h3>
				<div class="pay_select">
					<table> 
						<tr class="cur">
							<td class="col1"><input type="radio" name="pay" value="支付宝"/>支付宝</td>
							<td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
						</tr>
						<tr>
							<td class="col1"><input type="radio" name="pay" value="余额"/>余额支付</td>
							<td class="col2">即时到帐，支持绝大数银行借记卡及部分银行信用卡</td>
						</tr>
					
					</table>
				</div>
			</div>
			<!-- 支付方式  end-->

		

			<!-- 商品清单 start -->
			<div class="goods">
				<h3>商品清单</h3>
				<table>
					<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col2">规格</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>	
					</thead>
					<tbody>
						<?php $prices=''; $shop_price=''; ?>
						<?php foreach ($goods_info as $k => $v): $prices+=number_format($v['price']*$v['goods_num'],2,'.',''); $shop_price+=number_format($v['shop_price']*$v['goods_num'],2,'.',''); ?>
						<!-- 将商品id和商品属性取出放到tr上,用于修改数量 -->
						<tr goods_id="<?php echo $v['goods_id'];?>" goods_attr="<?php echo $v['goods_attr'];?>">
							<td class="col1"><a href=""><img src="<?php echo URL_PATH.'/'.$v['logo']?>" alt="" /></a>  <strong><a href=""><?php echo $v['goods_name']?></a></strong></td>
							<td class="col2"> 
								<?php $arr=explode('<br>',$v['goods_attrs']);?>
								<?php foreach ($arr as $key => $value):?>
									<p><?php echo $value;?></p>
								<?php endforeach;?>
							</td>
							<td class="col3">￥<span><?php echo $v['price']?></span></td>
							<td class="col4"> 
								<a href="javascript:;" class="reduce_num"></a>
								<?php echo $v['goods_num']?>
								<a href="javascript:;" class="add_num"></a>
							</td>
							<td class="col5">￥<span><?php echo number_format($v['price']*$v['goods_num'],2,'.','')?></span></td>
						</tr>
					<?php endforeach;?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5">
							<ul>
								<li>
									<span>4 件商品，总商品金额：</span>
									<em>￥<?php echo number_format($shop_price,2,'.','');?></em>
								</li>
								<li>
									<span>优惠：</span>
									<em>￥<?php echo number_format($shop_price-$prices,2,'.','');?></em>
								</li>
								<li>
									<span>运费：</span>
									<em>￥10.00</em>
								</li>
								
							</ul>
						</td>
					</tr>
				</tfoot>
			</table>

		</div>
		<!-- 商品清单 end -->
	</div>
	<div class="fillin_ft">
		<a href="javascript:;" onclick="document.forms[0].submit()"><span>提交订单</span></a>
		<p>应付总额：<strong>￥<?php echo number_format($prices,2,'.','')?>元</strong></p>
	</div>
	</form>
</div>
<!-- 主体部分 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
	<p class="links">
		<a href="">关于我们</a> |
		<a href="">联系我们</a> |
		<a href="">人才招聘</a> |
		<a href="">商家入驻</a> |
		<a href="">千寻网</a> |
		<a href="">奢侈品网</a> |
		<a href="">广告服务</a> |
		<a href="">移动终端</a> |
		<a href="">友情链接</a> |
		<a href="">销售联盟</a> |
		<a href="">京西论坛</a>
	</p>
	<p class="copyright">
		© 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
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