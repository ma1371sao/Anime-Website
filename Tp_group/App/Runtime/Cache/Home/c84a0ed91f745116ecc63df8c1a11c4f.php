<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
	<!-- 头部模板文件 -->
	<title>首页</title>
	<meta charset="utf8" />
	<!-- 网站图标设置 -->
	<link rel="shortcut icon" href="favicon.ico" />
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/default.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/Head.css" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/Home-Index.css" />	
</head>
<body>
	<!-- 导航开始 --><!-- tolerance 向上一下滚动x距离就显示头部 -->
	<!-- offset 线下滚动超过一定距离开始显示效果 --><!-- data属性为headroom的设置值 -->
	<div id="nav" data-headroom data-tolerance="5" data-offset="100">
		<div class="inner-nav1 clearfix">
		<div class="nav-h"><img src="__PUBLIC__/Image/logo.png" />
		</div>
		<!-- 搜索 -->
		<form action="<?php echo U(GROUP_NAME.'/Search/index');?>" method="get" class="search-form clearfix">
			<span class=""><i class="fa  fa-search"></i></span>
			<input  type="text" name="k" placeholder="搜索" class="search-input"/>
			<!-- <input  type="submit" value="GO" class="search-btn r"/> -->
		</form>
		<div class="login-group r">
		<!-- 登录按钮 -->
		<?php if(session('user_name') == null): ?><a href="<?php echo U('Home/Login/index');?>" class="login-btn"><i class="fa fa-user"></i>登录</a><a href="#"class="login-btn"><i class="fa fa-pencil"></i>注册</a>
		<?php else: ?>
		<i class="fa fa-user"></i> <?php echo (session('user_name')); ?><a href="<?php echo U(GROUP_NAME.'/Login/logout');?>" class="login-btn"><i class="fa fa-info"></i> 注销</a><?php endif; ?>
		</div>
		</div>
		<!-- 搜索结束 -->
		<div id="nav-js">
		<div class="inner-nav2">
		<!-- 父级nav开始 -->
		<ul class="main-nav clearfix">
			<!-- 固定的首页链接 -->
			<li class="main-li" ><a href="__GROUP__" class="main-li-a">首页</a></li>
		<!-- 自定义nav循环标签 order 排序方式 -->
					<?php
 $nav_cate = M('cate')->order("sort ASC")->select(); import("ExtendClass.Category",APP_PATH); $nav_cate = Category::unlimitedForLayer( $nav_cate ); foreach ($nav_cate as $nav_v) : extract($nav_v); $url = U('/l/'.$id); ?><li class="main-li" data-channel="<?php echo ($id); ?>"><!-- 循环得到的li项 -->
				<a href="<?php echo ($url); ?>" class="main-li-a"><?php echo ($name); ?>
					<div class="tail"></div>
				</a><!-- 父级名称 -->
			</li><?php endforeach; ?>
		<!-- 循环结束 -->
		</ul>
		</div><!-- nav内层结束 -->
		<!-- 父级nav结束 -->
		<!-- 填充sub的子层 -->
		<div class="sub-guide">
			<div class="nav-bg"></div>
			<!-- 循环开始 -->
						<?php
 $nav_cate = M('cate')->order("sort ASC")->select(); import("ExtendClass.Category",APP_PATH); $nav_cate = Category::unlimitedForLayer( $nav_cate ); foreach ($nav_cate as $nav_v) : extract($nav_v); $url = U('/l/'.$id); if($child): ?><!-- 如果child子项存在值 -->
				<ul class="sub-nav clearfix" data-id="<?php echo ($id); ?>"><!-- 子项名称 -->
					<?php if(is_array($child)): foreach($child as $key=>$v): ?><li class><a href="<?php echo U('/l/'.$v['id']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
				</ul><?php endif; endforeach; ?>
			<!-- 启用了url路由模式 U生成 /l/+数字的形式地址 --><!-- 循环结束 -->
		</div>
		<!-- sub子层结束 -->
		</div>
	</div>
	<!-- 导航结束 -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/kindeditor/themes/default/default.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/kindeditor/themes/simple/simple.css" />
<style>
.video-main{
    display: block;
    width:854px;
    height:520px;
}
.vlist{
    display: block;
    width:296px;
    background: #303030;
    
    font: normal 12px/20px 'MicroSoft YaHei';
}
.video-control{
    width: 100%;
    height:470px;
    padding-top: 10px;
    overflow-y: scroll;
}
.video-list{
    height:40px;
    padding: 5px 10px;
    color: #bbb;
    background: #444;
    margin: 2px 0px;
    cursor: pointer;
}
.video-list:hover{
    background: #555;
}
.vlist-head{
    color: #bbb;
    background: #000;
}
.vlist-head span{
    display: inline-block;
    padding: 5px 40px;
    font: normal 20px/30px "MicroSoft YaHei";
    background: #303030;
}
.v-tit{
    margin: 20px 0px 10px 0px ;
}
.comment-tit{
    font: normal 12px/30px "MicroSoft YaHei";
    border-left: 4px solid #3b8dbd;
}
.comment-tit h3{
    display: inline-block;
    padding-left: 10px;
    font: normal 18px/30px "MicroSoft YaHei";
}
#content{
    margin: 20px 0px 0px 0px;
    width:800px;
}
#content .user-img{
    border: 1px solid #ddd;
    margin: 2px 0px 20px 0px;
}
#content .pin-body{
    border-bottom: 1px dashed #ccc;
    margin:5px 0px;
}
#content .pin-side{
    width:730px;
}
#content .pin-con{
    font:normal 14px/24px "MicroSoft YaHei";
}
#content .pin-user{
    display: inline-block;
    font:normal 12px/24px "MicroSoft YaHei";
    background: #87cefa;
    color:#fff;
    padding:0px 5px ;
}
#content .pin-user span{
    margin-right:20px ;
}
.v-ad{
    width: 100%;
    margin: 20px 0px;
}
.comment-sub{
    width: 700px;
    display: block;
    padding: 2px 5px;
    text-align: center;
    border: none;
    border-radius: 2px;
    font: normal 12px/30px "MicroSoft YaHei";
    background: #87cefa;
    color: #fff;
    margin: 10px 0px;
    cursor: pointer;
}
#page{
    font: normal 12px/20px "MicroSoft YaHei";
    margin: 10px 0px 40px 0px;
}
#page span.current{
    display: inline-block;
    padding: 5px 12px;
    background:#87cefa;
    color: #fff; 
    border: 1px solid #ccc; 
}
#page a{
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid #ccc;
}
</style>
<!-- 填充容器 -->
<div class="container">
    <div class="clearfix">
    <!-- 标题头 -->
    <div class="v-tit">
        <p class="wen-tit"><?php echo ($fname["name"]); ?>:第<?php echo ($cid["order"]); ?>话<?php echo ($cid["title"]); ?></p>
        <p class="wen-s-tit"><span>主页>视频 </span> <span>发布于2014年 11月30日(星期日) 19时54分</span> / <span>评论：84  收藏：86 / 举报视频</span></p>
    </div>
	<div id="containers" class="video-main l"></div>
    <!-- 剧集列表 -->
    <div id="Vlist" class="vlist r">
        <div id="cvideo" data-sid="<?php echo ($cid["sid"]); ?>" class="vlist-head"><span>选集</span></div>
        <ul class="video-control">
        <?php if(is_array($svideo)): foreach($svideo as $key=>$s): ?><li class="video-list" data-sid="<?php echo ($s["sid"]); ?>">第<?php echo ($s["order"]); ?>话 <?php echo ($s["title"]); ?></li><?php endforeach; endif; ?>
        </ul>
    </div>
    </div>
    <!-- 剧集列表结束 -->
    <div><img src="__ROOT__/Uploads/ad/ad8.jpg" class="v-ad"></div>
    <!-- ajax分页填充区 -->
    <div id="content">
        <div class="comment-tit"><h3>评论列表</h3><span class="sub-tit-l">Comment</span></div>
        <!-- comment主体 -->
<?php if(is_array($comment)): foreach($comment as $key=>$com): ?><div class="pin-body clearfix">
    
   	<img src="<?php echo ($com["pic"]); ?>" class="user-img l"/>
   	<div class="pin-side r">
   	<div class="pin-user"><span><?php echo ($com["uname"]); ?></span><span>评论时间:<?php echo (date('Y-m-d H:i:s',$com["time"])); ?></span></div>
    <p class="pin-con">评论:<?php echo ($com["content"]); ?></p>
	</div>
</div><?php endforeach; endif; ?>
<!-- 分页page -->
<div id="page"><?php echo ($page); ?></div><!--分页模板-->
    </div>
    <!-- ajax分页结束 -->

    <!-- 表单体检 -->
    <div id="comment">
        <!-- <form action="<?php echo U(GROUP_NAME.'/Play/addComment');?>" method="post"> -->
            <textarea id="pin" name="content"></textarea>
            
            <button id="sub" class="comment-sub"/>提交</button>
            <div id="text"></div>
        <!-- </form> -->
    </div>
    <!-- 表单提交结束 -->
</div>
﻿<!-- 底部文件模板 -->
<footer>
	<div class="nav-bg"></div>
	<div class="foot-inner">
	<div class="foot-main clearfix">
		<div class="foot-logo l">
			<img src="__PUBLIC__/Image/logo.jpg" class="round-logo"/>
			<a class="logo-tit" href="/Tp_group">萌萌网</a>
		</div>
		<div class="logo-warn l">
		<p>本站不提供视频上传</p>
		<p>本站收录的所有内容均来自网上搜集分享，其版权均归原作者及其网站所有</p>
		<p>Copyright 2014 © XXX 保留所有权利</p>
		</div>
		<div class="foot-s r">
		<h3>关于XXX网</h3>
		<a href="#">常见问题</a>
		<a href="#">联系我们</a>
		</div>
		<div class="foot-s r">
		<h3>加入我们</h3>
		<a href="#">腾讯微博</a>
		<a href="#">新浪微博</a>
		</div>
		<div class="foot-s r">
		<h3>其他</h3>
		<a href="#">BUG反馈</a>
		<a href="#">全站使用说明</a>
		</div>
		<div class="foot-s r">
		<h3>友情链接</h3>
		<a href="#">XXX网</a>
		<a href="#">XXX网</a>
		</div>
	</div>
	</div>
</footer>
</body>
<!-- jquery -->
<script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
<!-- <script type="text/javascript" src="__PUBLIC__/lazyload/jquery.lazyload.min.js?v=1.9.1"></script> -->
<script type="text/javascript" src="__PUBLIC__/Js/jquery.color.js"></script>
<!-- headroom插件 -->
<script type="text/javascript" src="__PUBLIC__/Js/headroom.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Home-index.js"></script>
</html>
<script type="text/javascript" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script type="text/javascript" src="__PUBLIC__/kindeditor/lang/zh_CN.js"></script>

    

<script type="text/javascript">
    $(document).ready(function(){

    KindEditor.ready(function(K) {
        K.create('#pin', {
            themeType : 'simple',
            width : '700px',
            height: '250px',
        });
    });

    // 预加载
    $("#containers").append("<embed "+
            "src=\"http://player.youku.com/player.php/sid/"+$('#cvideo').attr('data-sid')+"/v.swf"+
            "quality=\"high\" width=\"854\" height=\"520\" "+
            "align=\"middle\" allowScriptAccess=\"sameDomain\" "+ 
            "allowFullscreen=\"true\" "+
            "type=\"application/x-shockwave-flash\"</embed>"
        );
    //用于播放视频的函数
    $('.video-list').click(function(){
        // 清除内容
        $('#containers').empty();
        // 填充sid
        var sid = $(this).attr('data-sid');
        $("#containers").append("<embed "+
            "src=\"http://player.youku.com/player.php/sid/"+sid+"/v.swf"+
            "quality=\"high\" width=\"854\" height=\"520\" "+
            "align=\"middle\" allowScriptAccess=\"sameDomain\" "+ 
            "allowFullscreen=\"true\" "+
            "type=\"application/x-shockwave-flash\"</embed>"
        );
    });
        
    /**
     * 异步评论
     * 我怎么也搞不懂为什么post就不行 最后我笑了 index主入口有其他输出
     */
    $('#sub').click(function(){
        var content =$('textarea[name=content]').val(); 
        // ajax
        $.ajax({
            url:'addComment',
            type:'POST',
            data:{"id":1,"content":content},
            dataType:'json',
            success:function (data){
            if(data['status']==1){
                // 填充
                var obj = data['data'];
                var content= obj['content'];
                $("#text").append(content);
            }else{
                alert(data['info']);
            }}
            })
    });
    });
</script>