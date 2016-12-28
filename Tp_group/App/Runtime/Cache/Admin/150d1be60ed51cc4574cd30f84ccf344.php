<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>admin</title>
</head>
<body>
	这是后台
	<!-- 退出登录 -->
	<a href="<?php echo U('Admin/Index/logout');?>">退出登录</a>
	<!-- 帖子 -->
	<a href="<?php echo U('Admin/MsgManage/index');?>">查看帖子</a>
</body>
</html>