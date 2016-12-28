<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>添加动漫</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Animate/handelAddAnimate');?>" method="post" 
	enctype="multipart/form-data">
	<table>
		<tr>
			<th colspan="2">动漫添加</th>
		</tr>
		<tr>
			<td>动漫栏目分类</td>
			<td>
				<select id="" name="type" onchange="" ondblclick="" class="" ><?php  foreach($type as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
			</td>
		</tr>
		<tr>
			<td>动漫标签</td>
			<td>
				<?php if(is_array($tag)): foreach($tag as $key=>$v): ?><label>
						<input type="checkbox" name="tid[]" value="<?php echo ($v["id"]); ?>"/><?php echo ($v["name"]); ?>
					</label><?php endforeach; endif; ?>
			</td>
		</tr>
		
		<tr>
			<td>动漫名称</td>
			<td><input type="text" name="name" /></td>	
		</tr>
		<tr>
			<td>更新日期</td>
			<td><select name="update">
			  	<option value ="1">周一</option>
			  	<option value ="2">周二</option>
			  	<option value ="3">周三</option>
			  	<option value ="4">周四</option>
			  	<option value ="5">周五</option>
			  	<option value ="6">周六</option>
			  	<option value ="7">周日</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>动漫声优</td>
			<td><input type="text" name="vactor" /></td>	
		</tr>
		<tr>
			<td>动漫封面图</td>
			<td><input type="file" name="pic" /></td>	
		</tr>
		<tr>
			<td>出品公司</td>
			<td><input type="text" name="company" /></td>	
		</tr>
		<tr>
			<td>动漫评分</td>
			<td><input type="text" name="rate" /></td>	
		</tr>
		<tr>
			<td>动漫状态:默认为新增</td>
			<td><select name="state">
			  	<option value ="0">新增</option>
			  	<option value ="1">显示</option>
			  	<option value ="2">预告</option>
			  	<option value ="3">推荐</option>
			  	<option value ="4">不显示</option>
				</select>
			</td>	
		</tr>
		<tr>
			<td>动漫介绍</td>	
		</tr>
		<tr>
			<td colspan="2">
				<textarea name="content"></textarea>
			</td>	
		</tr>
		<tr>
			<td><input type="submit" value="添加动漫" /></td>	
		</tr>
	</table>
</form>
</body>
</html>