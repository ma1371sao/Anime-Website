<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>添加属性</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Attribute/handelAddAttr');?>" method="post">
	<table>
		<tr>
			<th colspan="2">添加博文属性</th>
		</tr>
		<tr>
			<td>属性名称</td>
			<td><input type="text" name="name" /></td>	
		</tr>
		<tr>
			<td>标签颜色</td>
			<td><input type="text" name="color" /></td>	
		</tr>
		<tr>
			<td>
				<input type="submit" value="保存添加"/>
			</td>	
		</tr>
	</table>
</form>
</body>
</html>