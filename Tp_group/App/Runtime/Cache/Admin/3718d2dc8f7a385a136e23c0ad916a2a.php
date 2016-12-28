<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8" />
	<title></title>
</head>
<body>
 <form action="<?php echo U('Admin/Rbac/editRoleHandel');?>" method="post">
	<!-- name请看数据库中的字段名 -->
	<label>修改角色</label>
	角色名称:<input type="text" name="name"   value="<?php echo ($role["name"]); ?>"/><br>
	角色描述:<input type="text" name="remark" value="<?php echo ($role["remark"]); ?>"/><br>
	角色状态:<input type="radio" name="status" value="1" <?php if($role['status'] == 1): ?>checked="checked"<?php endif; ?>/>开启
			<input type="radio" name="status" value="0"  <?php if($role['status'] == 0): ?>checked="checked"<?php endif; ?>/>关闭 <br>
	<input type="hidden" name="id" value="<?php echo ($role["id"]); ?>"/>
	<input type="submit" value="修改"/>
	<input type="reset" value="重置" />
 </form>
</body>
</html>