<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>评论内容管理页</title>
</head>
<body>
	<table>
		<tr>
			<th>ID</th>
			<th>动漫id</th>
			<th>用户id</th>
			<th>内容</th>
			<th>发表时间</th>
			<th>目前状态</th>
		</tr>
	<?php if(is_array($comment)): foreach($comment as $key=>$co): ?><tr>
		<td><?php echo ($co["id"]); ?></td>
		<td><?php echo ($co["aid"]); ?></td>
		<td><?php echo ($co["uid"]); ?></td>
		<td><?php echo ($co["content"]); ?></td>
		<td><?php echo ($co["time"]); ?></td>
		<td><?php echo ($co["status"]); ?></td>
	</tr><?php endforeach; endif; ?>
	</table>
	<?php echo ($page); ?>
</body>
</html>