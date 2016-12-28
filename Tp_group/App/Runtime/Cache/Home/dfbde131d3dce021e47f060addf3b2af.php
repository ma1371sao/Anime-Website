<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
	<!-- 头部模板文件 -->
	<title>首页</title>
	<meta charset="utf8" />
	<!-- 网站图标设置 -->
	<link rel="shortcut icon" href="favicon.ico" />
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/default.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/Head.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/Home-Index.css" />	
</head>
<body>
	<!-- 导航开始 --><!-- tolerance 向上一下滚动x距离就显示头部 -->
	<!-- offset 线下滚动超过一定距离开始显示效果 --><!-- data属性为headroom的设置值 -->
	<div id="nav" data-headroom data-tolerance="5" data-offset="100">
		<div class="inner-nav1 clearfix">
		<div class="nav-h"><img src="__PUBLIC__/Image/logo.png" />
		</div>
		<!-- 搜索 -->
		<form action="<?php echo U(GROUP_NAME.'/Search/index');?>" method="get" class="search-form clearfix">
			<span class=""><i class="fa  fa-search"></i></span>
			<input  type="text" name="k" placeholder="搜索" class="search-input"/>
			<!-- <input  type="submit" value="GO" class="search-btn r"/> -->
		</form>
		<div class="login-group r">
		<!-- 登录按钮 -->
		<?php if(session('user_name') == null): ?><a href="<?php echo U('Home/Login/index');?>" class="login-btn"><i class="fa fa-user"></i>登录</a><a href="#"class="login-btn"><i class="fa fa-pencil"></i>注册</a>
		<?php else: ?>
		<i class="fa fa-user"></i> <?php echo (session('user_name')); ?><a href="<?php echo U(GROUP_NAME.'/Login/logout');?>" class="login-btn"><i class="fa fa-info"></i> 注销</a><?php endif; ?>
		</div>
		</div>
		<!-- 搜索结束 -->
		<div id="nav-js">
		<div class="inner-nav2">
		<!-- 父级nav开始 -->
		<ul class="main-nav clearfix">
			<!-- 固定的首页链接 -->
			<li class="main-li" ><a href="__GROUP__" class="main-li-a">首页</a></li>
		<!-- 自定义nav循环标签 order 排序方式 -->
					<?php
 $nav_cate = M('cate')->order("sort ASC")->select(); import("ExtendClass.Category",APP_PATH); $nav_cate = Category::unlimitedForLayer( $nav_cate ); foreach ($nav_cate as $nav_v) : extract($nav_v); $url = U('/l/'.$id); ?><li class="main-li" data-channel="<?php echo ($id); ?>"><!-- 循环得到的li项 -->
				<a href="<?php echo ($url); ?>" class="main-li-a"><?php echo ($name); ?>
					<div class="tail"></div>
				</a><!-- 父级名称 -->
			</li><?php endforeach; ?>
		<!-- 循环结束 -->
		</ul>
		</div><!-- nav内层结束 -->
		<!-- 父级nav结束 -->
		<!-- 填充sub的子层 -->
		<div class="sub-guide">
			<div class="nav-bg"></div>
			<!-- 循环开始 -->
						<?php
 $nav_cate = M('cate')->order("sort ASC")->select(); import("ExtendClass.Category",APP_PATH); $nav_cate = Category::unlimitedForLayer( $nav_cate ); foreach ($nav_cate as $nav_v) : extract($nav_v); $url = U('/l/'.$id); if($child): ?><!-- 如果child子项存在值 -->
				<ul class="sub-nav clearfix" data-id="<?php echo ($id); ?>"><!-- 子项名称 -->
					<?php if(is_array($child)): foreach($child as $key=>$v): ?><li class><a href="<?php echo U('/l/'.$v['id']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
				</ul><?php endif; endforeach; ?>
			<!-- 启用了url路由模式 U生成 /l/+数字的形式地址 --><!-- 循环结束 -->
		</div>
		<!-- sub子层结束 -->
		</div>
	</div>
	<!-- 导航结束 -->
<style>
	#top{
		position: fixed;
		top: auto;
		right:40px;
		bottom: 32px;
		z-index: 65535;
		width: 50px;
		height: 50px;
		text-align: center;
		border: 1px solid #aaa;
		background: #fff;
		display: none;
	}
	#top .noshow{
		display: block;
		padding: 10px;
		font-size: 12px;
		line-height: 16px;
		font-family: 'MicroSoft YaHei';
		font-weight: normal;
		width:30px;
		height:30px;
		background: #bbb;
		color: #fff;
		display: none;
	}
	#top .t-btn{
		color:#aaa;
	}
</style>
<!-- gototop开始 -->
<div>
	<!-- gotoTop 内层-->
	<div id="top"><a href="#" class="t-btn"><i class="fa  fa-angle-up fa-3x" title="返回顶部"></i><p class="noshow">返回顶部</p></a></div>
</div>
<!-- gototop结束 -->
<!-- 引入头部公用模板文件 不需要加html 末尾要加/ -->
	<div class="container">
		<!-- 首页ppt -->
		<?php echo W('Ppt',array('limit' => 6));?>
		<!-- tag 小工具 已废除-->
		<!-- <div>
			<img src="__PUBLIC__/Image/headform.jpg" style="width:100%;height:100px" />
		</div> -->
		<!-- 第一部分 -->
		<div id="area-b" class="clearfix">
	<div class="warpper l">
		<div class="tit">
		<h3 class="">热播推荐</h3><span class="sub-tit-l">Recommend</span>
		<!-- 随机数局 -->
		<?php if(is_array($recommend_more)): foreach($recommend_more as $key=>$rm): ?><a href="<?php echo U('/s/'.$rm['id']);?>"><span class="sub-tit"><?php echo ($rm["name"]); ?></span></a><?php endforeach; endif; ?>
		<!-- 结束 -->
		<!-- <a href="<?php echo U('/av/'.$rm['id']);?>" class="more"><span class="green">更多More</span></a> -->
		</div>
	<ul class="con clearfix">
		
	<?php if(is_array($recommend)): foreach($recommend as $key=>$r): ?><li class="l <?php if($key == 0): ?>first<?php endif; ?>">
		<a href="<?php echo U('/s/'.$r['id']);?>" class =""><img class="warpper-img <?php if($key == 0): ?>ss200<?php else: ?>ss150<?php endif; ?>" src="<?php echo ($r["pic"]); ?>"/></a>
		<div>
		<p><a href="<?php echo U('/s/'.$r['id']);?>" class="p-title"><?php echo ($r["name"]); ?></a></p>
		<p class="p-info"><i class="fa fa-tags"></i><?php echo (msubstr($r["content"],0,9,'utf-8',false)); ?></p>
		</div>
		</li><?php endforeach; endif; ?>
	</ul>
	</div>

	<div class="side r">
		<?php echo W('New',array('limit' => 9));?>
	</div>

</div>
<!-- 第er部分结束 -->
		
		﻿		<!-- 第二部分开始 -->
		<div class="clearfix">
		<!-- 分配的animate目录 -->
		
		<?php if(is_array($AT)): foreach($AT as $k=>$a): ?><div class="area-fen clearfix">
		 <div class="warpper l">
		 	<div class="tit">
				<h3 class=""><?php echo ($a["name"]); ?></h3>
				<span class="sub-tit-l">Recommend</span>
				<!-- 随机数局 -->
				<?php if(is_array($a["more"])): foreach($a["more"] as $key=>$mo): ?><a href="<?php echo U('/s/'.$mo['id']);?>"><span class="sub-tit"><?php echo ($mo["name"]); ?></span></a><?php endforeach; endif; ?>
				<!-- 更多 -->
				<a href="<?php echo U('/av/'.$a['id']);?>" class="more"><span class="green">更多>></span></a>
				</div>
			<ul class="con clearfix">

				<?php if($k == 0): if(is_array($a["animate"])): $i = 0; $__LIST__ = array_slice($a["animate"],0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$an): $mod = ($i % 2 );++$i;?><li class="l ">
					<a href="<?php echo U('/s/'.$an['id']);?>" class="load">
						<img class="warpper-img ss150" src="<?php echo (to150x100($an["pic"])); ?>"/>
					<span class="infoBg">
					<?php foreach($an['tag'] as $ke => $v){ echo "<span class='info_tag'>".$v['name']."</span>"; } ?>
					</span>
					</a>
					<p class=""><a href="<?php echo U('/s/'.$an['id']);?>" class="p-title"><?php echo ($an["name"]); ?></a></p>
					<p class="p-info"><i class="fa fa-tags"></i><?php echo (msubstr($an["content"],0,8,'utf-8',false)); ?></p>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>

				<?php elseif($k == 2): ?>
				<?php if(is_array($a["animate"])): $i = 0; $__LIST__ = array_slice($a["animate"],0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$an): $mod = ($i % 2 );++$i;?><li class="l first">
					<a href="<?php echo U('/s/'.$an['id']);?>" class="load">
						<img class="warpper-img ss200" src="<?php echo (to200x250($an["pic"])); ?>"/>
					<span class="infoBg">
					<?php foreach($an['tag'] as $ke => $v){ echo "<span class='info_tag'>".$v['name']."</span>"; } ?>
					</span>
					</a>
					<p class=""><a href="<?php echo U('/s/'.$an['id']);?>" class="p-title"><?php echo ($an["name"]); ?></a></p>
					<p class="p-info"><i class="fa fa-tags"></i><?php echo (msubstr($an["content"],0,8,'utf-8',false)); ?></p>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>

				<?php elseif($k == 3): ?>
				<?php if(is_array($a["animate"])): $i = 0; $__LIST__ = array_slice($a["animate"],0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$an): $mod = ($i % 2 );++$i;?><li class="l ">
					<a href="<?php echo U('/s/'.$an['id']);?>" class="load">
						<img class="warpper-img ss150" src="<?php echo (to150x100($an["pic"])); ?>"/>
					<span class="infoBg">
					<?php foreach($an['tag'] as $ke => $v){ echo "<span class='info_tag'>".$v['name']."</span>"; } ?>
					</span>
					</a>
					<p class=""><a href="<?php echo U('/s/'.$an['id']);?>" class="p-title"><?php echo ($an["name"]); ?></a></p>
					<p class="p-info"><i class="fa fa-tags"></i><?php echo (msubstr($an["content"],0,8,'utf-8',false)); ?></p>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>

				

				<?php else: ?>
				<!-- 具体每一项 -->
				<?php if(is_array($a["animate"])): foreach($a["animate"] as $key=>$an): ?><li class="l <?php if($key == 0): ?>first<?php endif; ?>">
					<a href="<?php echo U('/s/'.$an['id']);?>" class="load">
						<img class="warpper-img 
						<?php if($key == 0): ?>ss200<?php else: ?>ss150<?php endif; ?>" src="
						<?php if($key == 0): echo (to200x250($an["pic"])); else: ?>
							<?php echo (to150x100($an["pic"])); endif; ?>"/>
					<span class="infoBg">
					<?php foreach($an['tag'] as $ke => $v){ echo "<span class='info_tag'>".$v['name']."</span>"; } ?>
					</span>
					</a>
					<p class=""><a href="<?php echo U('/s/'.$an['id']);?>" class="p-title"><?php echo ($an["name"]); ?></a></p>
					<p class="p-info"><i class="fa fa-tags"></i><?php echo (msubstr($an["content"],0,8,'utf-8',false)); ?></p>
					</li><?php endforeach; endif; endif; ?>
			</ul>
		</div>

		<?php if($k == 0): ?><div class="side2 r">
				<img src="__ROOT__/Uploads/ad/l-ad1.jpg" class="advertise"/>
			</div>
			<?php elseif($k == 2): ?>
				<div class="side r ">
		<div class="side-head green-back"><h3>讨论区</h3>
			</div>
		<ul class="rank-side">
			<li><i class="number o1">1</i><a class="side-link">【东京喰种】动画与漫画之间的出入</a></li>
			<li><i class="number o1">2</i><a class="side-link">2015年一月新番看点</a></li>
			<li><i class="number o1">3</i><a class="side-link">Fate系列作品</a></li>
			<li><i class="number">4</i><a class="side-link">【CV】御三家</a></li>
			<li><i class="number">5</i><a class="side-link">【CV】雨宫天热潮</a></li>
			<li><i class="number">6</i><a class="side-link">2014年十月最强番</a></li>
			<li><i class="number">7</i><a class="side-link">【A/Z】第二季剧情如何展开</a></li>
		</ul>
		<div class="side-yugao">
			<img src="__ROOT__/Uploads/ad/ad9.jpg" class="img-yugao"/>
		</div>
		</div>
			<?php else: ?>
		<!-- side 部分-->
		<div class="side r ">
		<div class="side-head green-back"><h3>Music</h3>
		</div>
		<ul class="rank-side">
			<li><i class="number o1">1</i><a class="side-link">lovelive！</a></li>
			<li><i class="number o1">2</i><a class="side-link">FripSide</a></li>
			<li><i class="number o1">3</i><a class="side-link">Sword Art Online</a></li>
			<li><i class="number">4</i><a class="side-link">甘城光辉游乐园</a></li>
			<li><i class="number">5</i><a class="side-link">Fate/stay night-UBW</a></li>
			<li><i class="number">6</i><a class="side-link">东京喰种</a></li>
			<li><i class="number">7</i><a class="side-link">加速世界</a></li>
		</ul>
		<div class="side-yugao">
			<img src="__ROOT__/Uploads/ad/ad10.jpg" class="img-yugao"/>
		</div>
		</div><?php endif; ?>
	</div>
		<!-- side部分结束 --><?php endforeach; endif; ?>
		<!-- animate 结束 -->

		</div>
		<!-- 第二部分结束 -->
	<!-- 第二部分 -->
		﻿<!-- 第yi部分开始 -->
<!-- 	<div class="clearfix">
	<div class="warpper l">
		<div class="tit">
		<h3 class="">最近新番</h3><span class="sub-tit">New</span>
		<a href="#" class=""><span class="">更多>></span></a>
		</div>
	<ul class="con clearfix">
		
	<?php if(is_array($new)): foreach($new as $key=>$n): ?><li class="l <?php if($key == 0): ?>first<?php endif; ?>">
			<a href="#" class=""><img class="warpper-img <?php if($key == 0): ?>ss200<?php else: ?>ss150<?php endif; ?>" src="<?php echo ($n["pic"]); ?>"/></a>
		<div class=>
		<p><a href="#" class="p-title"><?php echo ($n["name"]); ?></a></p>
		<p class="p-info"><?php echo (msubstr($n["content"],0,9,'utf-8',false)); ?></p>
		</div>
		</li><?php endforeach; endif; ?>

	</ul>
	</div>
	</div> -->
<!-- 第yi部分结束 -->
<style>
.band-img{
	display: block;
}
.band-desc{
	width: 700px;
}
.arti-tit{
	color: #333;
	text-decoration: none;
	font-size: 16px;
	line-height: 18px;
	font-weight: bold;
	padding: 0 0 5px;
	border-bottom: 1px dotted #CCC;
	font-family: "Microsoft YaHei","Helvetica Neue",Helvetica,Arial;
	transition: all .3s ease-out;
	margin-bottom: 10px;
}
.arti-tit:hover{
	color: #e32d40;
}
.arti-summ{
text-indent:2em;
	padding: 10px 0px;
	color: #626773;
	font-size: 13px;
	line-height: 25px;
	height:70px;
	font-family: "Microsoft YaHei","Helvetica Neue",Helvetica,Arial;
}
.arti-more{
	display: inline-block;
	line-height: 1em;
	padding: 6px 15px;
	border-radius: 15px;
	background: #eee;
	color: #999;
	text-shadow: 0 1px #fff;
	font-size: 12px;
	font-family: "Microsoft YaHei","Helvetica Neue",Helvetica,Arial;
	transition: all .3s ease-out;
}
.arti-more:hover{
	background:#e32d40; 
	color: #fff;
	text-shadow: none;
}
.arti-foot{
	line-height: 1.6em;
	font: normal 14px/1.6em "Microsoft Yahei";
	border-top: 2px solid #ddd;
	padding: 5px 0px;
}
.arti-f{
	font-size: 12px;
	color: #999;
	margin:0px 10px;
}
#page{
	margin-top:30px;
	margin-bottom:5px;
	margin-left:30px;
}
</style>
<div id="area-a" class="area-fen clearfix">
	<div class="topic l">
		<div class="topic-tit">
		<h3 class="">专题文章区</h3><span class="sub-tit-l">Txt</span>
		</div>

		<!-- 主题展示 -->
		<ul class="topic-main l">
			
	<?php if(is_array($new)): foreach($new as $key=>$n): ?><ul class="topic-inner clearfix">
			<li class="l band">
			<a href="<?php echo U('/'.$n['id']);?>" class="l band-img"><img class="lazy warpper-img ss130" src="<?php echo ($n["pic"]); ?>"/></a>
			<!-- 解释字段 -->
			<div class="r band-desc">
			<a href="<?php echo U('/'.$n['id']);?>" class="arti-tit"><?php echo ($n["title"]); ?></a>
			
			<p class="arti-summ"><?php echo (msubstr($n["summary"],0,155,'utf-8',true)); ?></p>
			<p class="arti-foot">
			<span class="arti-f"><i class="fa fa-calendar"></i> 时间：<?php echo (date("Y-m-d",$n["time"])); ?></span>
			<span class="arti-f"><i class="fa fa-edit"></i> 点击：<?php echo ($n["click"]); ?></span>
			<a href="<?php echo U('/'.$n['id']);?>" class="arti-more r">更多</a>
			</p>
			</div>
		</li>
			
		</ul><?php endforeach; endif; ?>
		<!-- <div class="topic-divder"><a href="javascript:;"><span>动漫专题</span></a></div> -->
	<div id="page"><?php echo ($page); ?></div>
	</ul>
	</div>

	<!-- 侧边 -->
	<!-- 调用hot工具 -->
	<?php echo W('Hot');?>
	<!-- <div class="side r">
		<div class="side-head yellow-bottom g1"><h3>新番预告</h3>
			<span class="side-sub">全部</span>
			<span class="side-sub">当月</span>
			<span class="side-sub">每周</span></div>
		<ul class="rank-side">
			<li><i class="number o1">1</i><a class="side-link">wenti1</a></li>
			<li><i class="number o1">2</i><a class="side-link">wenti2</a></li>
			<li><i class="number o1">3</i><a class="side-link">地球把百合子3123</a></li>
			<li><i class="number">4</i><a class="side-link">地球把百合子3213</a></li>
			<li><i class="number">5</i><a class="side-link">地球把百合子3213</a></li>
			<li><i class="number">6</i><a class="side-link">地球把百合子3213</a></li>
			<li><i class="number">7</i><a class="side-link">地球把百合子3213</a></li>
		</ul>
		<div class="side-tag">
			<ul class="clearfix">
				<li>CV标签</li>
				<li>CV标签</li>
				<li>CV标签</li>
				<li>CV标签</li>
				<li>CV标签</li>
				<li>CV标签</li>
			</ul>
		</div>
	</div> -->
		<div class="side r">
		<div class="side-yugao">
			<div class="side-head green-back"><h3>即将上映</h3></div>
			<ul class="ul-yugao">
				<li>
					<img src="__ROOT__/Uploads/ad/ad6.jpg" class="img-yugao"/>
					<img src="__ROOT__/Uploads/ad/ad2.jpg" class="img-yugao"/>
					<img src="__ROOT__/Uploads/ad/ad3.jpg" class="img-yugao"/>
					<img src="__ROOT__/Uploads/ad/ad4.jpg" class="img-yugao"/>
				</li>
			</ul>
		</div>
	</div>
</div>

	<!-- 调用new工具 -->
	
	</div>
<!-- 引入底部公用模板文件 -->
﻿<!-- 底部文件模板 -->
<footer>
	<div class="nav-bg"></div>
	<div class="foot-inner">
	<div class="foot-main clearfix">
		<div class="foot-logo l">
			<img src="__PUBLIC__/Image/logo.jpg" class="round-logo"/>
			<a class="logo-tit" href="/Tp_group">萌萌网</a>
		</div>
		<div class="logo-warn l">
		<p>本站不提供视频上传</p>
		<p>本站收录的所有内容均来自网上搜集分享，其版权均归原作者及其网站所有</p>
		<p>Copyright 2014 © XXX 保留所有权利</p>
		</div>
		<div class="foot-s r">
		<h3>关于XXX网</h3>
		<a href="#">常见问题</a>
		<a href="#">联系我们</a>
		</div>
		<div class="foot-s r">
		<h3>加入我们</h3>
		<a href="#">腾讯微博</a>
		<a href="#">新浪微博</a>
		</div>
		<div class="foot-s r">
		<h3>其他</h3>
		<a href="#">BUG反馈</a>
		<a href="#">全站使用说明</a>
		</div>
		<div class="foot-s r">
		<h3>友情链接</h3>
		<a href="#">XXX网</a>
		<a href="#">XXX网</a>
		</div>
	</div>
	</div>
</footer>
</body>
<!-- jquery -->
<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
<!-- <script type="text/javascript" src="__PUBLIC__/lazyload/jquery.lazyload.min.js?v=1.9.1"></script> -->
<script type="text/javascript" src="__PUBLIC__/Js/jquery.color.js"></script>
<!-- headroom插件 -->
<script type="text/javascript" src="__PUBLIC__/Js/headroom.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Home-index.js"></script>
</html>