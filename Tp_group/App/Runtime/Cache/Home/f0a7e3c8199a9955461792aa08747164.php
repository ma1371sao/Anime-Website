<?php if (!defined('THINK_PATH')) exit();?><!-- hot 热门博客工具 -->
<style type="text/css">
ol{
	counter-reset: li;
	list-style: none;
	*list-style: decimal;
	font: 12px '微软雅黑';
	padding: 0;
	margin-bottom: 4em;
}

ol ol{
	margin: 0 0 0 2em;
}

/* -------------------------------------- */
.rounded-list a{
	position: relative;
	display: block;
	padding: .4em .4em .4em 1.5em;
	*padding: .4em;
	margin:.2em 0.1em;
	background: #fff;
	color: #444;
	text-decoration: none;
	-moz-border-radius: .3em;
	-webkit-border-radius: .3em;
	border-radius: .3em;
	white-space:nowrap;
	-webkit-transition: all .3s ease-out;
	-moz-transition: all .3s ease-out;
	-ms-transition: all .3s ease-out;
	-o-transition: all .3s ease-out;
	transition: all .3s ease-out;	
}

.rounded-list a:hover{
	background: #eee;
}

.rounded-list a:hover:before{
	-moz-transform: rotate(360deg);
  	-webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);	
}

.rounded-list a:before{
	content: counter(li);
	counter-increment: li;
	position: absolute;	
	left: -1.3em;
	top: 50%;
	margin-top: -1.3em;
	background: #87ceeb;
	height: 2em;
	width: 2em;
	line-height: 2em;
	border: .3em solid #fff;
	text-align: center;
	font-weight: bold;
	-moz-border-radius: 2em;
	-webkit-border-radius: 2em;
	border-radius: 2em;
	-webkit-transition: all .3s ease-out;
	-moz-transition: all .3s ease-out;
	-ms-transition: all .3s ease-out;
	-o-transition: all .3s ease-out;
	transition: all .3s ease-out;
}

/* -------------------------------------- */

.rectangle-list a{
	position: relative;
	display: block;
	margin-bottom:1em;
	padding-left: 0.5em; 
	*padding: .4em;
	line-height:1.6em;
	margin-left:1.5em;
	margin-right:0em;
	background: transparent;
	color: #444;
	text-decoration: none;
	white-space: nowrap;
	-webkit-transition: all .3s ease-out;
	-moz-transition: all .3s ease-out;
	-ms-transition: all .3s ease-out;
	-o-transition: all .3s ease-out;
	transition: all .3s ease-out;	
}

.rectangle-list a:hover{
	background: #eee;
}	

.rectangle-list a:before{
	content: counter(li);
	counter-increment: li;
	position: absolute;	
	left: -2em;
	top: 50%;
	margin-top: -0.8em;
	background: #fe7012;
	height: 1.6em;
	width: 1.6em;
	color: #fff;
	line-height: 1.6em;
	text-align: center;
	font-weight: bold;
}

.rectangle-list a:after{
	position: absolute;	
	content: '';
	border: .5em solid transparent;
	left: -1em;
	top: 45%;
	margin-top: -.5em;
	-webkit-transition: all .3s ease-out;
	-moz-transition: all .3s ease-out;
	-ms-transition: all .3s ease-out;
	-o-transition: all .3s ease-out;
	transition: all .3s ease-out;				
}

.rectangle-list a:hover:after{
	left: -.5em;
	border-left-color: #fe7012;				
}
.side-body{
	width:92%;
	padding-left: 10px;
	padding-top: 10px; 
	overflow: hidden;
}
</style>
<div class="side r">
	<div class="side-head green-back">
		<h3 class="">动漫榜单</h3>
	</div>
<div class="side-body">
<ol class="rectangle-list">
	<?php if(is_array($blog)): foreach($blog as $key=>$v): ?><li><a href="<?php echo U('/'.$v['id']);?>" target="_blank"><?php echo ($v["title"]); ?></a></li><?php endforeach; endif; ?>
</ol>
</div>
<div class="side-yugao">
	<img src="__ROOT__/Uploads/ad/ad5.jpg" class="img-yugao"/>
</div>
</div>