<?php if (!defined('THINK_PATH')) exit();?><!-- comment主体 -->
<?php if(is_array($comment)): foreach($comment as $key=>$com): ?>用户:<?php echo ($com["uid"]); ?><br/>
    评论:<?php echo ($com["content"]); ?><br/>
    评论时间:<?php echo (date('Y-m-d H:i:s',$com["time"])); ?><br/><?php endforeach; endif; ?>
<!-- 分页page -->
<div id="page"><?php echo ($page); ?></div>