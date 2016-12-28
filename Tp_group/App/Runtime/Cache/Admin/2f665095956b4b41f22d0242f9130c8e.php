<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>系统配置</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/System/updateWater');?>" method="post">
	<table>
		<tr>
			<th colspan="2">上传图片水印配置</th>
		</tr>
		<tr>
			<td>水印图路径</td>
			<td><input type="text" name="WATER_IMAGE" value="<?php echo (C("WATER_IMAGE")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印位置</td>
			<td><input type="text" name="WATER_POS" value="<?php echo (C("WATER_POS")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印透明度</td>
			<td><input type="text" name="WATER_ALPHA" value="<?php echo (C("WATER_ALPHA")); ?>"/></td>	
		</tr>
		<tr>
			<td>JPEG图片压缩比</td>
			<td><input type="text" name="WATER_COMPRESSION" value="<?php echo (C("WATER_COMPRESSION")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印文字</td>
			<td><input type="text" name="WATER_TEXT" value="<?php echo (C("WATER_TEXT")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印文字旋转角度</td>
			<td><input type="text" name="WATER_ANGLE" value="<?php echo (C("WATER_ANGLE")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印文字大小</td>
			<td><input type="text" name="WATER_FONTSIZE" value="<?php echo (C("WATER_FONTSIZE")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印文字颜色</td>
			<td><input type="text" name="WATER_FONTCOLOR" value="<?php echo (C("WATER_FONTCOLOR")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印文字字体文件<small>(写入中文字时需使用支持中文的字体文件)<small></td>
			<td><input type="text" name="WATER_FONTFILE" value="<?php echo (C("WATER_FONTFILE")); ?>"/></td>	
		</tr>
		<tr>
			<td>水印文字字符编码</td>
			<td><input type="text" name="WATER_CHARSET" value="<?php echo (C("WATER_CHARSET")); ?>"/></td>	
		</tr>
		<tr>
			<td><input type="submit" value="提交"/></td>	
		</tr>
	</table>
</form>
</body>
</html>