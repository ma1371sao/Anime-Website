<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>修改动漫</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Animate/handelEdit');?>" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<th colspan="2">动漫修改</th>
		</tr>
		<tr>
			<td>动漫栏目分类</td>
			<td>
				<select id="" name="type" onchange="" ondblclick="" class="" ><?php  foreach($type as $key=>$val) { if(!empty($animate['tid']) && ($animate['tid'] == $key || in_array($key,$animate['tid']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
			</td>
		</tr>
		<tr>
			<td>动漫标签</td>
			<td>
				<?php if(is_array($tag)): foreach($tag as $key=>$v): ?><label>
						<input type="checkbox" name="tid[]" value="<?php echo ($v["id"]); ?>" 
						<?php foreach($checktag as $k => $t){ if($t == $v['name']) echo "checked='checked'"; } ?>
						/><?php echo ($v["name"]); ?>
					</label><?php endforeach; endif; ?>
			</td>
		</tr>
		
		<tr>
			<td>动漫名称</td>
			<td><input type="text" name="name" value="<?php echo ($animate["name"]); ?>"/></td>	
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
			<td><input type="text" name="vactor" value="<?php echo ($animate["vactor"]); ?>"/></td>	
		</tr>
		<tr>
			<td>动漫封面图</td>
			<td><img src="<?php echo ($animate["pic"]); ?>"/><input type="hidden" name="pic" value="<?php echo ($animate["pic"]); ?>"/></td>
		</tr>
		<tr>
			<td>上传新的封面图</td>
			<td><input type="file" name="new"/></td>
		</tr>
		<tr>
			<td>出品公司</td>
			<td><input type="text" name="company" value="<?php echo ($animate["company"]); ?>"/></td>	
		</tr>
		<tr>
			<td>动漫评分</td>
			<td><input type="text" name="rate" value="<?php echo ($animate["rate"]); ?>"/></td>	
		</tr>
		<tr>
			<td>动漫介绍</td>	
		</tr>
		<tr>
			<td colspan="2">
				<textarea name="content"><?php echo ($animate["content"]); ?></textarea>
			</td>	
		</tr>
		<tr>
			<input type="hidden" name="id" value="<?php echo ($animate["id"]); ?>"/>
			<td><input type="submit" value="修改动漫" /></td>	
		</tr>
	</table>
</form>
</body>
</html>