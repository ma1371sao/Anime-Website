<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>结点页</title>
</head>
<body>
	<a href="<?php echo U('Admin/Rbac/role');?>">返回</a><br>
	<!-- 模板循环 -->
	<form action="<?php echo U('Admin/Rbac/setAccess');?>" method="post">
	<!-- 权限提交表单 -->
	<?php if(is_array($node)): foreach($node as $key=>$app): ?><div class="app">
		<strong><?php echo ($app["title"]); ?></strong>
		<input type="checkbox" name="access[]" value="<?php echo ($app["id"]); ?>_1" level="1" <?php if($app["access"]): ?>checked="checked"<?php endif; ?>/>
		<!-- 把所有的action循环显示出来 是上一级的child-->
		<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
				<dt>
				<strong><?php echo ($action["title"]); ?></strong>
				<input type="checkbox" name="access[]" value="<?php echo ($action["id"]); ?>_2" level="2" <?php if($action["access"]): ?>checked="checked"<?php endif; ?>/>
				</dt>

				<!-- 把所有控制器里的方法显示出来 是上一级的child-->
				<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
						<span><?php echo ($method["title"]); ?></span>
						<input type="checkbox" name="access[]" value="<?php echo ($method["id"]); ?>_3" level="3" <?php if($method["access"]): ?>checked="checked"<?php endif; ?>/>
					</dd><?php endforeach; endif; ?>
			</dl><?php endforeach; endif; ?>
	</div><?php endforeach; endif; ?>
	<input type="hidden" name="rid" value="<?php echo ($rid); ?>"/>
	<input type="submit" value="提交"/>
	</form>
</body>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
<script type="text/javascript">
	// 复选框子集全部选中 
	$(function(){
		// level 1的元素
		$("input[level=1]").click(function(){
			// 获取子集元素
			var inputs = $(this).parents('.app').find('input');

			$(this).attr('checked')?inputs.attr('checked','checked') : inputs.removeAttr('checked');
		});
		// level 2的元素 
		$("input[level=2]").click(function(){
			// 获取子集元素
			var inputs = $(this).parents('dl').find('input');

			$(this).attr('checked')?inputs.attr('checked','checked') : inputs.removeAttr('checked');
		});
		// level 3的元素
		$("input[level=3]").click(function(){
			// 获取父元素
			var input_level_2 = $(this).parents('dd').prevAll('dt').find('input');
			// 是否有选中
			var is_level_2_checked = $(this).parents('dd').siblings('dd').andSelf().find('input:checked');
			 is_level_2_checked.length > 0 ? input_level_2.attr('checked','checked') : input_level_2.removeAttr('checked');
		});
		//level 1>2>3
		$("input[level=2],input[level=3]").click(function() {
			var input_level_1= $(this).parents('.app').children();
			var is_level_1_checked = input_level_1.find('input:checked');
			is_level_1_checked.length > 0 ? input_level_1.attr('checked','checked') : input_level_1.removeAttr('checked');
		});
	});
</script>
</html>