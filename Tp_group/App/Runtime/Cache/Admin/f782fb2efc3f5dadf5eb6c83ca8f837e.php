<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>博客列表</title>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Category/sortCate');?>" method="post">
	<table>
		<tr>
			<th>ID</th>
			<th>标题</th>
			<th>所属分类</th>
			<th>封面图</th>
			<th>点击次数</th>
			<th>发布时间</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($blog)): foreach($blog as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td>
					<?php echo ($v["title"]); ?>
					<?php if(is_array($v["attr"])): foreach($v["attr"] as $key=>$value): ?><strong style='color:<?php echo ($value["color"]); ?>'>[<?php echo ($value["name"]); ?>]</strong><?php endforeach; endif; ?>
				</td>
				<td><?php echo ($v["cate"]); ?></td>
				<td><img src="<?php echo ($v["pic"]); ?>" style="width:100px;height:40px"/></td>
				<td><?php echo ($v["click"]); ?></td>
				<td><?php echo (date("y-m-d H:i",$v["time"])); ?></td>
				<td>
					<?php if(ACTION_NAME == index): ?>[<a href="<?php echo U(GROUP_NAME.'/Blog/toTrach',array('id' => $v['id'],'type' => 1));?>">删除</a>]
					<?php else: ?>
						[<a href="<?php echo U(GROUP_NAME.'/Blog/toTrach',array('id' => $v['id'],'type' => 0));?>">还原</a>]
						[<a href="<?php echo U(GROUP_NAME.'/Blog/delete' ,array('id' => $v['id']));?>">彻底删除</a>]<?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
</form>
</body>
</html>