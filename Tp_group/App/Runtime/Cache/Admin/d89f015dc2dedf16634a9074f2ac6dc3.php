<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>结点页</title>
</head>
<body>
	<a href="<?php echo U('Admin/Rbac/addNode');?>">添加应用</a><br>
	<!-- 模板循环 -->
	<?php if(is_array($node)): foreach($node as $key=>$app): ?><strong><?php echo ($app["title"]); ?></strong>
		[<a href="<?php echo U('Admin/Rbac/addNode', array('pid' => $app['id'],'level'=> 2));?>">添加控制器</a>]
		[<a href="">修改</a>]
		[<a href="">删除</a>]
		<!-- 把所有的action循环显示出来 是上一级的child-->
		<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
				<dt>
				<strong><?php echo ($action["title"]); ?></strong>
				[<a href="<?php echo U('Admin/Rbac/addNode', array('pid'=> $action['id'] ,'level' => 3));?>">添加方法</a>]
				</dt>

				<!-- 把所有控制器里的方法显示出来 是上一级的child-->
				<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
						<span><?php echo ($method["title"]); ?></span>
						[<a href="">修改</a>]
						[<a href="">删除</a>]
					</dd><?php endforeach; endif; ?>

			</dl><?php endforeach; endif; endforeach; endif; ?>
</body>
</html>