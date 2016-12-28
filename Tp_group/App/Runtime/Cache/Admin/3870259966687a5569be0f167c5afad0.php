<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>属性列表</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Category/sortCate');?>" method="post">
	<table>
		<tr>
			<th>ID</th>
			<th>属性名称</th>
			<th>颜色</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($attr)): foreach($attr as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><div style="width:20px;height:20px;background:<?php echo ($v["color"]); ?>"></div></td>
				<td>
					[<a href="">修改</a>]
					[<a href="">删除</a>]
				</td>
			</tr><?php endforeach; endif; ?>
	
	</table>
</form>
</body>
</html>