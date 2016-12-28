<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.green-back{
	background: #82b965;
}
</style>
<!-- new 最新博客工具 -->
<div class="side-head green-back">
	<h3>文章列表</h3>
</div>
<ul class="side-p">
<?php if(is_array($news)): foreach($news as $key=>$v): ?><li class="p-list">
	<a href="<?php echo U('/'.$v['id']);?>" target="_blank" class="p-li"><?php echo ($v["title"]); ?></a>
</li><?php endforeach; endif; ?>
</ul>