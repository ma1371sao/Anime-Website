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
	这是动漫视频列表
	<div class="container">
		<!-- 分类 -->
		<style>
		.ret-tag-w{
			font-size: 12px;
			width: 300px;
			border: 1px solid #dadada;
			line-height: 1.5;
			padding: 20px 0px;
		}
		.ret-tag-w h2{
			color: #666;
			font: normal 24px/26px "MicroSoft YaHei";
			margin: 0px 20px 5px 20px;
			padding-left: 12px;
			border-left: 4px solid #ff9126;
		}
		.ret-tag-u{
			margin-left: 25px;
			margin-right: 25px;
			padding: 10px 0px;
			border-bottom: 1px dashed #ccc;
		}
		.ret-tag-u.last{
			border-bottom: none;
		}
		.ret-tag-u h3{
			color: #666;
			font: normal 16px/20px "MicroSoft YaHei";
			margin-bottom: 10px;
		}
		.ret-tag-u h3 span{
			display: inline-block;
			width:10px;
		}
		.ret-tag-u li{
			margin: 0px 10px 5px 0px;
			padding: 0 5px;
			float: left;
			font-family: "MicroSoft YaHei";
		}
		.ret-tag-u li a{
			color: #3a3a3a;
		}
		.ret-search-main{
			width:800px;
		}
		.ret-search li{
			float: left;
			width: 370px;
			margin-right: 20px;
			margin-bottom: 30px;
		}
		.ret-search-img{
			width:150px;
			height:200px;
		}
		.ret-search-desc{
			width:200px;
			font: normal 12px/20px "MicroSoft YaHei";
		}
		.ret-search-title{
			font: normal 18px/20px "MicroSoft YaHei";
			margin-bottom: 5px;
			white-space:nowrap;
		}
		.ret-search-more{
			display: inline-block;
			font: normal 12px/20px "MicroSoft YaHei";
			margin: 0 40px 0px 0px;
			padding: 2px 10px;
			background-color: #ccc; 
			color: #fff;
		}
		.ret-blue{
			background-color: #6495ED;
		}
		.ret-search-info{
			color: #000;
			line-height: 24px;
			height: 25px;
			/*强行不换行*/
			white-space:nowrap;
			overflow: hidden;
		}
		.ret-search-i{
			color: #767676;;
		}
		.ret-search-p{
			display: block;
			min-height: 76px;
		}
		</style>
		<div class="clearfix">
		<div class="ret-tag-w l">
			<h2>动漫检索</h2>
			<div class="ret-tag-body">
			<ul class="ret-tag-u clearfix">
				<h3><i class="fa  fa-qrcode"></i><span></span>类型</h3>
			<?php if(is_array($type)): foreach($type as $key=>$t): ?><li><a href="#"><?php echo ($t["name"]); ?></a></li><?php endforeach; endif; ?>
			</ul>
			<ul class="ret-tag-u clearfix last">
				<h3><i class="fa  fa-tag"></i><span></span>标签</h3>
			<?php if(is_array($tag)): foreach($tag as $key=>$g): ?><li><a href="#"><?php echo ($g["name"]); ?></a></li><?php endforeach; endif; ?>
			</ul>
			</div>
		</div>
		<!-- 分类结束 -->
		<!-- 分配的cate目录 列表页主体-->
		<div class="ret-search-main r">
			<h2>最新 人气 最热 共XXX记录</h2>
		<ul class="ret-search clearfix">
		<?php if(is_array($animate)): foreach($animate as $key=>$v): ?><li class="clearfix">
			<a href="<?php echo U(GROUP_NAME.'/Detail/index',array('id' => $v['id']));?>" target="_blank"><img class="ret-search-img l" src="<?php echo ($v["pic"]); ?>"/></a>
			<div class="ret-search-desc r">
			<div class="ret-search-title"><?php echo ($v["name"]); ?></div>
			<div class="ret-search-info"><span class="ret-search-i"><i class="fa fa-user"></i> 声优：</span><?php echo ($v["vactor"]); ?></div>
			<!-- <div class="ret-search-info"><span class="ret-search-i">点击：</span><?php echo ($v["click"]); ?>次</div> -->
			<div class="ret-search-info"><span class="ret-search-i"><i class="fa fa-thumbs-o-up"></i>  评分：</span><?php echo ($v["rate"]); ?></div>
			<!-- <div class="ret-search-info"><span class="ret-search-i">回复：</span><?php echo ($v["reply"]); ?>次</div> -->
			<div class="ret-search-info"><span class="ret-search-i"><i class="fa fa-map-marker"></i>   制作出品：</span><?php echo ($v["company"]); ?></div>
			<!-- <span>发布于:<?php echo (date("Y年m月d日 H:i:s",$v["time"])); ?></span> -->	
			<p class="ret-search-p"><?php echo (msubstr($v["content"],0,40)); ?></p>
			<!-- 按钮 -->
			<a href="<?php echo U(GROUP_NAME.'/Detail/index',array('id' => $v['id']));?>" target="_blank" class="ret-search-more"><i class="fa fa-file-text"></i> 详情</a>
			<a href="#" target="_blank" class="ret-search-more ret-blue"><i class="fa fa-play-circle"></i> 播放</a>
			</div>
		</li><?php endforeach; endif; ?>
		</ul>
		<div><?php echo ($page); ?></div>
		</div>	
	</div>
</div>
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