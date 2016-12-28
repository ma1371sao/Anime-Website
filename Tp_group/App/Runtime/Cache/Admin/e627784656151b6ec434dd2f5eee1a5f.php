<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>首页幻灯片控制</title>
</head>
<body>
	<table>
		<tr>
			<th>Id</th>
			<th>标题</th>
			<th>图片</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($ppt)): foreach($ppt as $key=>$p): ?><tr>
				<td><?php echo ($p["id"]); ?></td>
				<td><?php echo ($p["title"]); ?></td>
				<td><img src="<?php echo ($p["pic"]); ?>" width="100" height="100"/></td>
				<td>
				<?php if($p['state'] == 1): ?>显示
					<?php else: ?>
					不显示<?php endif; ?>
				</td>
				<td>[<a href="#">修改</a>]</td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>