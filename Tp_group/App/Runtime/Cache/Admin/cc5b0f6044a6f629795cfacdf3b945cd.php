<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>系统配置</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/System/updateVerify');?>" method="post">
	<table>
		<tr>
			<th colspan="2">验证码配置</th>
		</tr>
		<tr>
			<td>验证码长度</td>
			<td><input type="text" name="VERIFY_LENGTH" value="<?php echo (C("verify_length")); ?>"/></td>	
		</tr>
		<tr>
			<td>验证码图片宽度</td>
			<td><input type="text" name="VERIFY_WIDTH" value="<?php echo (C("VERIFY_WIDTH")); ?>"/></td>	
		</tr>
		<tr>
			<td>验证码图片高度</td>
			<td><input type="text" name="VERIFY_HEIGHT" value="<?php echo (C("VERIFY_HEIGHT")); ?>"/></td>	
		</tr>
		<tr>
			<td>验证码背影颜色</td>
			<td><input type="text" name="VERIFY_BGCOLOR" value="<?php echo (C("VERIFY_BGCOLOR")); ?>"/></td>	
		</tr>
		<tr>
			<td>验证码种子</td>
			<td><input type="text" name="VERIFY_SEED" value="<?php echo (C("VERIFY_SEED")); ?>"/></td>	
		</tr>
		<tr>
			<td>验证码字体文件</td>
			<td><input type="text" name="VERIFY_FONTFILE" value="<?php echo (C("VERIFY_FONTFILE")); ?>"/></td>	
		</tr>
		<tr>
			<td>验证码字体大小</td>
			<td><input type="text" name="VERIFY_SIZE" value="<?php echo (C("VERIFY_SIZE")); ?>"/></td>	
		</tr>
		<tr>
			<td>验证码字体颜色</td>
			<td><input type="text" name="VERIFY_COLOR" value="<?php echo (C("VERIFY_COLOR")); ?>"/></td>	
		</tr>
		<tr>
			<td>SESSION识别名称</td>
			<td><input type="text" name="VERIFY_NAME" value="<?php echo (C("VERIFY_NAME")); ?>"/></td>	
		</tr>
		<tr>
			<td>存储验证码到SESSION时使用函数</td>
			<td><input type="text" name="VERIFY_FUNC" value="<?php echo (C("VERIFY_FUNC")); ?>"/></td>	
		</tr>
		<tr>
			<td><input type="submit" value="提交"/></td>	
		</tr>
	</table>
</form>
</body>
</html>