<?php if (!defined('THINK_PATH')) exit();?>﻿﻿<!DOCTYPE html>
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
<!-- 代码高亮插件 -->
<link rel="stylesheet" type="text/css" href="__ROOT__/App/Modules/Admin/Tpl/Public/kindeditor/plugins/code/prettify.css" />
<script type="text/javascript" src="__ROOT__/App/Modules/Admin/Tpl/Public/kindeditor/plugins/code/prettify.js"></script>
<div class="container">
	<!-- <a href="">首页</a> -->
	<?php $last = count($parents) - 1; ?>
	<?php if(is_array($parents)): foreach($parents as $key=>$v): ?><a href="<?php echo U('/l/'.$v['id']);?>"><?php echo ($v["name"]); ?></a>
		<!-- 判断最后一个 -->
		<?php if($key != $last): ?>>><?php endif; endforeach; endif; ?>
	<div class="clearfix">
	<div class="warpper l">
		<div>
			<p class="wen-tit"><?php echo ($blog["title"]); ?></p>
			<p class="wen-s-tit"><span>主页>文章</span>发布于<span><?php echo (date("Y年m月d日 H时i分",$blog["time"])); ?></span> /
				<span>已被阅读<script type="text/javascript" src="<?php echo U(GROUP_NAME.'/Show/click',array('id' =>$blog['id']));?>"></script>次</span>
				<span>评论：380  收藏：67 / 举报文章<span>
			</p>
		</div>

		<div class="wen-con"><?php echo ($blog["content"]); ?></div>
	</div>
	<div class="side r">
		<?php echo W('New',array('limit' => 9));?>
		<img src="__ROOT__/Uploads/ad/l-ad1.jpg" class="advertise"/>
		<img src="__ROOT__/Uploads/ad/ad11.jpg" class="advertise"/>
		<img src="__ROOT__/Uploads/ad/ad5.jpg" class="advertise"/>
		<img src="__ROOT__/Uploads/ad/ad10.jpg" class="advertise"/>
		<img src="__ROOT__/Uploads/ad/ad9.jpg" class="advertise"/>
	</div>
	</div>
</div>
<script type="text/javascript">
	prettyPrint();
</script>
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