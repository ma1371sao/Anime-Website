<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>动漫列表</title>
</head>
<body>
	<a href="<?php echo U(GROUP_NAME.'/Animate/addAnimate');?>">添加动漫</a>
	<table>
		<tr>
			<th>ID</th>
			<th>动漫名称</th>
			<th>所属类别</th>
			<th>动漫标签</th>
			<th>动漫声优</th>
			<th>出品公司</th>
			<th>动漫简介</th>
			<th>封面图</th>
			<th>发布时间</th>
			<th>点击次数</th>
			<th>评分</th>
			<th>评论数</th>
			<th>状态</th>
			<th style="width:30%">操作</th>
		</tr>
		<?php if(is_array($animate)): foreach($animate as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["type"]); ?></td>
				<td style="width:50px;">
					<?php if(is_array($v["tag"])): foreach($v["tag"] as $key=>$value): ?><small>[<?php echo ($value["name"]); ?>]</small><?php endforeach; endif; ?>
				</td>
				<td><?php echo ($v["vactor"]); ?></td>
				<td><?php echo ($v["company"]); ?></td>
				<td style="width:20%"><?php echo (msubstr($v["content"],0,30,'utf-8',true)); ?></td>
				<td><img src="<?php echo ($v["pic"]); ?>" width="120px" height="100px"/></td>
				<td><?php echo (date("y-m-d H:i",$v["time"])); ?></td>
				<td><?php echo ($v["click"]); ?></td>
				<td><?php echo ($v["rate"]); ?></td>
				<td><?php echo ($v["reply"]); ?></td>
				<td><?php echo ($v["state"]); ?></td>
				<td>
					[<a href="<?php echo U(GROUP_NAME.'/Animate/edit',array('id'=>$v['id']));?>">修改</a>]
					[<a href="">删除</a>]
					[<a href="<?php echo U(GROUP_NAME.'/Animate/addPpt',array('id'=>$v['id'],'name'=>$v['name']));?>">添加幻灯片</a>]
					[<a href="<?php echo U(GROUP_NAME.'/Animate/diversity',array('id'=>$v['id'],'name'=>$v['name']));?>">添加分集</a>]
				</td>
			</tr><?php endforeach; endif; ?>
		<tr>
			<td colspan="14"><?php echo ($page); ?></td>
		</tr>
	</table>
</body>
</html>