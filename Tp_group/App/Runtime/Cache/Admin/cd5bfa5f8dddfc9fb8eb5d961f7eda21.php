<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>图片裁剪页</title>
	<style type="text/css">
	.crop-info{
		display: inline-block;
		width: 400px;
	}
	.half{
		display: inline-block;
		float:left;
		width: 50%
	}
	</style>
</head>
<body>
	<?php if(is_array($pic)): foreach($pic as $key=>$p): ?><div class="crop-info">
		<div class="half">
			<?php echo ($p["name"]); ?>
			<div><a href="<?php echo U(GROUP_NAME.'/ThinkImg/crop',array('id'=>$p['id']));?>">裁剪</a></div>
			<div>目前尺寸:W=<?php echo ($p["w"]); ?> X H=<?php echo ($p["h"]); ?></div>
		</div>
		<div class="half"><img src="<?php echo ($p["pic"]); ?>" width="200px" height="100px"/></div>
		</div><?php endforeach; endif; ?>
</body>
</html>