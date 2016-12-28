<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>修改标签</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Tag/editTag');?>" method="post">
	<table>
		<tr>
			<th colspan="2">修改标签</th>
		</tr>
		<tr>
			<td>标签名称</td>
			<td><input type="text" name="name" value="<?php echo ($edit["name"]); ?>"/></td>	
		</tr>
		<tr>
			<td>标签排序</td>
			<td><input type="text" name="sort" value="<?php echo ($edit["sort"]); ?>"/></td>	
		</tr>
		<tr>
			<td>
				<input type="hidden" name="id" value="<?php echo ($edit["id"]); ?>"/>
				<input type="submit" value="修改"/>
			</td>	
		</tr>
	</table>
</form>
</body>
</html>