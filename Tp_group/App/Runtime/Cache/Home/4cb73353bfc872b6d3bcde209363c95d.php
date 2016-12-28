<?php if (!defined('THINK_PATH')) exit();?><!-- 首页ppt工具 -->
<div class="Hband clearfix">
<ul class="ppt l">
	<?php if(is_array($ppt)): foreach($ppt as $key=>$po): ?><li class="ppt-li">
		<a href="<?php echo ($po["aid"]); ?>" target="_blank"><img src="<?php echo ($po["pic"]); ?>" width="880px" height="410px" alt="<?php echo ($po["title"]); ?>"/></a>
	</li><?php endforeach; endif; ?>
</ul>
<!-- 每日更新 -->
<style>
.side-update{
	display: inline-block;
	width: 240px;
	height:400px;
	vertical-align: top;
	font: normal 12px/24px "MicroSoft YaHei" ;
}
.menu_body{
	position: relative;
	margin-left: 40px;
	width:190px;
	height:200px;
	overflow-y:  auto;
	border-bottom: 1px dashed #ddd;
	border-left: 1px dashed #9ed900;
	display: none;
}
.menu_body li{
	padding-left: 14px;
	font: normal 12px/24px "MicroSoft YaHei" ;
}
.menu_body li a{
	color:#333;
}
.menu_head{
	display: inline-block;
	position: relative;
	line-height: 20px;
	text-align: center;
	height:20px;
	width: 40px;
	cursor: pointer;
	background: #f3f3f3;
	color:#333;
	border-radius: 2px;
}
.side-update .current{
	background: #9ed900;
	color: #fff;
}
.menu_guide{
	display:inline-block;
	padding-left: 10px;
	height:20px;
	width:180px;
	color: #333;
}
.menu_san{
	display: inline-block;
	position: absolute;
	bottom: -10px;
	left:   15px;
	width: 0px;
	height: 0px;

	border-top:    5px solid #9ed900;
	border-right:  5px solid transparent;
	
	border-left:   5px solid transparent;
	border-bottom: 5px solid transparent; 
	overflow: hidden;
}
.under{
	border-bottom:  1px dashed #ddd;
}
</style>

	

<div id="update_menu" class="side-update r">
	<div class="side-head green-back"><h3>每周更新</h3></div>
	<?php if(is_array($update)): foreach($update as $km=>$up): ?><div class="menu_head <?php if($km == 1): ?>current<?php endif; ?>"><?php echo (int_to_date($km)); ?>
		<span class="<?php if($km == 1): ?>menu_san<?php endif; ?>"></span></div>
	<?php if(is_array($up)): foreach($up as $key=>$upp): if($key == 0): ?><a href="<?php echo U('/s/'.$upp['id']);?>" class="menu_guide <?php if($km != 1): ?>under<?php endif; ?>"><?php echo ($upp["title"]); ?></a><ul class="menu_body">
			<?php else: ?><li><a href="<?php echo U('/s/'.$upp['id']);?>"><?php echo ($upp["title"]); ?></a></li><?php endif; endforeach; endif; ?>
	</ul><?php endforeach; endif; ?>
	<!-- <div class="menu_head current">周一<span class="menu_san"><span></div>
	<a href="#" class="menu_guide">ab</a>
<ul class="menu_body">
	<li><a href="">a</a></li>
	<li><a href="">c</a></li>
	<li><a href="">d</a></li>
	<li><a href="">e</a></li>
	<li><a href="">f</a></li>
</ul>
	<div class="menu_head">周二<span class=""><span></div>
	<a href="#" class="menu_guide under">a</a>
<ul class="menu_body">
	<li><a href="">b</a></li>
	<li><a href="">c</a></li>
	<li><a href="">d</a></li>
	<li><a href="">e</a></li>
	<li><a href="">f</a></li>
</ul>
	<div class="menu_head">周三<span class=""><span></div>
	<a href="#" class="menu_guide under">a</a>
<ul class="menu_body">
	<li>b</li>
	<li>c</li>
	<li>d</li>
	<li>e</li>
	<li>f</li>
</ul>
	<div class="menu_head">周四<span class=""><span></div>
	<a href="#" class="menu_guide under">a</a>
<ul class="menu_body">
	<li>b</li>
	<li>c</li>
	<li>d</li>
	<li>e</li>
	<li>f</li>
</ul>
	<div class="menu_head">周五<span class=""><span></div>
	<a href="#" class="menu_guide under">a</a>
<ul class="menu_body">
	<li>b</li>
	<li>c</li>
	<li>d</li>
	<li>e</li>
	<li>f</li>
</ul>
	<div class="menu_head">周六<span class=""><span></div>
	<a href="#" class="menu_guide under">a</a>
<ul class="menu_body">
	<li>b</li>
	<li>c</li>
	<li>d</li>
	<li>e</li>
	<li>f</li>
</ul>
	<div class="menu_head">周日<span class=""><span></div>
	<a href="#" class="menu_guide under">a</a>
<ul class="menu_body">
	<li>b</li>
	<li>c</li>
	<li>d</li>
	<li>e</li>
	<li>f</li>
</ul> -->
</div>
</div>