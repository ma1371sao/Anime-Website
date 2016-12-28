<?php
// 前台配置文件
return array(
	// 模板文件解析路径
	'TMPL_FILE_DEPR' 		=>'/',
	'SHOW_PAGE_TRACE'		=>true,
	// 'TMPL_EXCEPTION_FILE' 	=> './Public/Tpl/error.html',// 错误页面模板路径
	
	//自动载入文件
	'APP_AUTOLOAD_PATH'=>'@.TagLib',//@符号代表当前应用Home
	'TAGLIB_BUILD_IN'=>'Cx,Newtag',//cx系统内置标签库 引入Newtag作为内置标签库 注意不能重名
	// ajax分页设置参数
	'PAGE'=>array(
		'theme'=>'%upPage% %linkPage% %downPage% %ajax%'
	),
	// 开启静态缓存
	'HTML_CACHE_ON'=>true,
	// 静态缓存归责
	'HTML_CACHE_RULES'=>array(
		//缓存名称 缓存时间
		// 永远走静态文件
		// 'Show:index'=>array('{:module}_{:action}_{id}',0)//缓存模块 - 控制器 - get里的参数
		),
	// 动态缓存
	'DATA_CACHE_TYPE'=>'File',//Memcache  或者 Radis 也支持
);?>