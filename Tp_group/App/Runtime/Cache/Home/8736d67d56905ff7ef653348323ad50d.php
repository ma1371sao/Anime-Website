<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>asdads</title>
	<meta charset="utf8" />
	<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
	<script>
	// 主要U方法的参数要加引号，外层用单引号
	var url = '<?php echo U("Home/Index/handel","","");?>';
	$(function(){
		$("#send").click(function(){
		event.preventDefault();
		// 获取值并判断
		var content = $("input[name=content]");
		if (content.val() == ''){
			alert("不能为空");
		}else{
		// 发送注意jquery的版本
		$.post(
			url , //地址
			{content:content.val()} , //数据
			function(data){ //回调函数
				if (data.status) {
					var news="<p>序号:"+data.id+"内容:"+data.content+"时间:"+data.time+"</p>";
					$("#get").append(news);
				}else{
					alert("发布失败");
				}
			},
			'json'//格式
			);
		}
	});
	})
	</script>
</head>
<body>
	Home lide index 控制器de index 方法模板
	<!-- 表单 -->
	信息：<br/>
	<input type="text" name="content" /><br/>
	<span id="send">发送</span>
	<!-- 数据库的数据显示 -->
	<?php if(is_array($news)): foreach($news as $key=>$v): ?><div>
			<!-- '|'用于分割 函数参数形式 '' 本身###-->
		<span>序号:<?php echo ($v["id"]); ?></span>
		<span>内容:<?php echo (pic_replace($v["content"])); ?></span>
		<span>时间<?php echo (date('y-m-d H:i',$v["time"])); ?></span>
		</div><?php endforeach; endif; ?>
	<div id="get"></div>
</body>
</html>