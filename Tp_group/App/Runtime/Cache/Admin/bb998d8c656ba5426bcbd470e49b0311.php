<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>用户页</title>
	<style type="text/css">
	*{
		margin: 0px;
		padding: 0px;
		list-style-type: none;
	}
	</style>
</head>
<body>
	<table>
		<tr>
			<th>Id</th>
			<th>用户名称</th>
			<th>上一次登录时间</th>
			<th>上一次登录的IP</th>
			<th>锁定状态</th>
			<th>用户所属组别</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
				<td><?php echo ($v["uid"]); ?></td>
				<td><?php echo ($v["uname"]); ?></td>
				<td><?php echo (date("y-m-d H:i",$v["date"])); ?></td>
				<td><?php echo ($v["ip"]); ?></td>
				<td><?php if($v["active"]): ?>锁定<?php else: ?>不锁定<?php endif; ?></td>
				<td>
					<?php if($v["uname"] == C("RBAC_SUPERADMIN")): ?>超级管理员
					<?php else: ?>
					<ul>
						<?php if(is_array($v["user_role"])): foreach($v["user_role"] as $key=>$role): ?><li><?php echo ($role["name"]); ?>(<?php echo ($role["remark"]); ?>)</li><?php endforeach; endif; ?>
					</ul><?php endif; ?>
				</td>
				<td>
					<a href="<?php echo U('Admin/Rbac/lock',array('uid'=> $v['uid']));?>">锁定</a>
					<a href="<?php echo U('Admin/Rbac/unlock',array('uid'=> $v['uid']));?>">解锁</a>
				</td>
			</tr><?php endforeach; endif; ?>
		
	</table>
</body>
</html>