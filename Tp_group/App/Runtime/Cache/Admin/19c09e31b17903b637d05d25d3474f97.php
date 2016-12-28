<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>tiezi</title>
	<!-- css模板替换 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__" />
	<!-- js模板替班 -->
	<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
</head>
<body>
	查看帖子
	<table>
		<tr>
			<th>Id</th>
			<th>content</th>
			<th>time</th>
			<th>operator</th>
		</tr>
		<?php if(is_array($article)): foreach($article as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo (pic_replace($v["content"])); ?></td>
				<td><?php echo (date('y-m-d H:i',$v["time"])); ?></td>
				<td>
					<a href="<?php echo U('Admin/MsgManage/delete',array('id'=>$v['id']));?>}">删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		<!-- 分页类 -->
		<tr>
			<td colspan="4" align="center"><?php echo ($page); ?></td>
		</tr>
	</table>

</body>
</html>