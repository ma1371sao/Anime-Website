<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>角色页</title>
</head>
<body>
	<table>
		<tr>
			<th>Id</th>
			<th>角色名称</th>
			<th>角色描述</th>
			<th>开启状态</th>
			<th>操作</th>
		</tr>
		<!-- 模板循环 -->
		<?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
			<td><?php echo ($v["id"]); ?></td>
			<td><?php echo ($v["name"]); ?></td>
			<td><?php echo ($v["remark"]); ?></td>
			<td>
				<?php if($v["status"]==1): ?>开启
					<?php else: ?>
					关闭<?php endif; ?>
			</td>
			<td>
				<a href="<?php echo U('Admin/Rbac/access' ,array('rid' => $v['id']));?>">配置权限</a>
				<a href="<?php echo U('Admin/Rbac/editRole',array('id' => $v['id']));?>">修改角色</a>
				<a href="<?php echo U('Admin/Rbac/deleteRole',array('id'=>$v['id']));?>">删除角色</a>
			</td>
		</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>