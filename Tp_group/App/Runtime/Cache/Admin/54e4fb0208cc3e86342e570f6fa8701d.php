<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8" />
	<title></title>
</head>
<body>
 <form action="<?php echo U('Admin/Rbac/addUserHandel');?>" method="post">
	<!-- name请看数据库中的字段名 -->
	<label>添加用户</label><br>
	用户名称:<input type="text" name="username"/><br>
	用户密码:<input type="password" name="password"/><br>
	所属角色:
	<select name="role_id[]" id="role_list">
		<option value="">请选择角色</option>
		<?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
	</select>
	<input type="button" id="add_role" value="添加一个角色"/>
	<br>
	<input type="submit" value="添加"/>
	<input type="reset" value="重置" />
 </form>
</body>
<!-- jquery -->
<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#add_role").click(function() {
				var obj = $("#role_list").clone();
				$("input[type=submit]").before(obj); 
			});
		})
	</script>
</html>