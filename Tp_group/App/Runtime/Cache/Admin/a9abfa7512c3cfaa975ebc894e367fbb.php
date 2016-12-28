<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>admin</title>
	<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
	<script type="text/javascript">
		var URL ="<?php echo U('Admin/Login/imagecode','','');?>";
		// 解析一个验证码的路径
		$(function(){
			$("#change").click(function change_verify() {
				$("#code").attr("src",URL +'/'+ Math.random());
			});
		})
	</script>
</head>
<body>
	这是登录
	<form action="<?php echo U('Admin/Login/login');?>" method="post" >
		账号<input name="uname"/><br>
		密码<input name="upass" /><br>
		验证码<input type="text" name="code"/>
		<img id="code" src="<?php echo U('Admin/Login/imagecode');?>"><a id="change" href="#">看不清</a><br>
		<input type="submit" value="提交" />
		<input type="reset" value="重置" />
	</form> 
</body>
</html>