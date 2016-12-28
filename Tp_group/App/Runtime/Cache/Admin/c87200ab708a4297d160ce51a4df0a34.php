<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>添加博文</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/kindeditor/plugins/code/prettify.css" />
	<script type="text/javascript" src="__PUBLIC__/kindeditor/plugins/code/prettify.js"></script>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Blog/handelAddBlog');?>" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<th colspan="2">博文发布</th>
		</tr>
		<tr>
			<td>所属分类</td>
			<td>
				<select name="cid">
					<option>分类列表</option>
					<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["html"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</td>	
		</tr>
		<tr>
			<td>博文属性</td>
			<td>
				<?php if(is_array($attr)): foreach($attr as $key=>$v): ?><label>
						<input type="checkbox" name="aid[]" value="<?php echo ($v["id"]); ?>"/><?php echo ($v["name"]); ?>
					</label><?php endforeach; endif; ?>
			</td>	
		</tr>
		<tr>
			<td>博文标题</td>
			<td><input type="text" name="title" /></td>	
		</tr>
		<tr>
			<td>博文摘要</td>
			<td><input type="text" name="summary" /></td>	
		</tr>
		<tr>
			<td>博文封面</td>
			<td><input type="file" name="pic"/></td>
		</tr>
		<tr>
			<td>点击次数</td>
			<td><input type="text" name="click" value="5"/></td>	
		</tr>
		<tr>
			<td colspan="2">
				<textarea name="content" id="content"></textarea>
			</td>	
		</tr>
		<tr>
			<td><input type="submit" value="保存添加" /></td>	
		</tr>
	</table>
</form>
</body>
	<script type="text/javascript" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
	<script type="text/javascript" src="__PUBLIC__/kindeditor/lang/zh_CN.js"></script>

	
<!-- 初始化插件 -->
<script>
	KindEditor.ready(function(K) {
		K.create('#content', {
			width : '700px',
			height: '350px',
			uploadJson : "<?php echo U(GROUP_NAME.'/Blog/upload');?>",
			cssPath :['__PUBLIC__/kindeditor/plugins/code/prettify.css']
		});
		// 代码高亮
		prettyPrint();
	});
</script>
</html>