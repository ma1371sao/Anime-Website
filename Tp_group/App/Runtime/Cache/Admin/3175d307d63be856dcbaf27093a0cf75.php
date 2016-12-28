<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>动漫类别列表</title>
</head>
<body>
	<a href="<?php echo U(GROUP_NAME.'/Type/addType');?>">继续添加</a>
	<form action="<?php echo U(GROUP_NAME.'/Type/sortType');?>" method="post">
	<table>
		<tr>
			<th>ID</th>
			<th>名称</th>
			<th>排序</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($type)): foreach($type as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><input type="text" name="<?php echo ($v["id"]); ?>" value="<?php echo ($v["sort"]); ?>"/></td>
				<td>
					[<a href="<?php echo U(GROUP_NAME.'/Type/editType',array('id' => $v['id']));?>">修改</a>]
					[<a href="<?php echo U(GROUP_NAME.'/Type/delType',array('id' => $v['id']));?>">删除</a>]
				</td>
			</tr><?php endforeach; endif; ?>
		<tr>
			<td colspan="4">
				<input type="submit" value="排序"/>
			</td>	
		</tr>
	</table>
</form>
</body>
</html>