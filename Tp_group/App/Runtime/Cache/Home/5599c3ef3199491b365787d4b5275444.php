<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>搜索</title>
	<style>
	img{
		border-radius: 30px;
	}
	</style>
</head>
<body>
	<?php if(is_array($user)): foreach($user as $key=>$u): echo ($u["uname"]); ?>
	<img src="<?php echo ($u["pic"]); ?>" width="60px" height="60px"/><?php endforeach; endif; ?>
	<?php echo ($k); ?>
	<?php echo ($page); ?>
</body>
</html>