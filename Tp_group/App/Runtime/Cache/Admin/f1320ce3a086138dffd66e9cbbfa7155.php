<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta charset="utf8"/>
	<title>结点页</title>
</head>
<body>
 <form action="<?php echo U('Admin/Rbac/addNodeHandel');?>" method="post">
 	<!-- 影藏与 2个-->
 	<input type="hidden" name="pid" value="<?php echo ($pid); ?>" />
 	<input type="hidden" name="level" value="<?php echo ($level); ?>"/>
 	<!-- 填写表单 -->
	<?php echo ($type); ?>名称:<input type="text" name="name"/><br>
	<?php echo ($type); ?>描述:<input type="text" name="title"/><br>
	是否开启:<input type="radio" name="status" value="1" checked="checked"/>开启  
	<input type="radio" name="status" value="0"/>关闭 <br>			
	排序:<input type="text" name="sort" value="1"/><br>
	<input type="submit" value="添加"/><br>
 </form>
</body>
</html>