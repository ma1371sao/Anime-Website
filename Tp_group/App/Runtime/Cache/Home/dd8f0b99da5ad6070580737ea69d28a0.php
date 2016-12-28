<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>私信页</title>
	<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
	<script type="text/javascript" src="__PUBLIC__/Js/letter.js"></script>
</head>
<body>
	<!-- 输出私信部分 -->
	<h4>我的私信共<?php echo ($count); ?>条</h4>
	<?php if(is_array($letter)): foreach($letter as $key=>$v): ?><div class="letter">
		<a href="#"><img src="<?php echo ($v["pic"]); ?>"/></a>
		用户名:<?php echo ($v["uname"]); ?>
		内容:<span><?php echo ($v["content"]); ?></span>
		<p>发送时间<span><?php echo (time_format($v["time"])); ?></span></p>
		<p><a href="javascript:;" class="del" del-id='<?php echo ($v["id"]); ?>'>删除</a><a href="#">回复</a></p>
		</div><?php endforeach; endif; ?>
	<!-- 分页页码 -->
	<?php echo ($page); ?>
	<!-- 发送私信 -->
	<form action="<?php echo U(GROUP_NAME.'/User/letterSend');?>" method="post">
		用户姓名 :<input type="text" name="name"/><br/>
		私信内容 :<textarea name="content"></textarea><br/>
		<input type="submit" value="发送" />
	</form>
</body>
</html>