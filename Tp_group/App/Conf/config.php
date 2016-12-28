<?php
// 公用配置文件
return array(
	// 数据库配置
	'DB_HOST'				=> '127.0.0.1',		//数据库地址
	'DB_USER'				=> 'root',			//数据库用户名
	'DB_PWD'                => 'admin',         // 密码
	'DB_NAME'               => 'test',          // 数据库名
	'DB_PREFIX'             => 'think_',        // 数据库名前缀

	// 缓存配置
	'DB_FIELDS_CACHE'	=> false, 				// 字段缓存信息
	'TMPL_CACHE_ON'    	=> false,				// 是否开启模板编译缓存,设为false则每次都会重新编译
	
	// 分组配置
	'APP_GROUP_LIST' 	=>'Home,Admin',			//开启分组
	'APP_GROUP_MODE' 	=> 1,					// 分组模式
	'APP_GROUP_PATH' 	=>'Modules',			// 独立分组文件夹
	'DEFAULT_GROUP'		=>'Home',				//默认分组

	// 模板引擎设置
	'TMPL_FILE_DEPR' 	=>'/',		    // 模板文件解析路径分隔符
	'TAGLIB_BUILD_IN'=>'Cx,Html',//cx系统内置标签库 引入Newtag作为内置标签库 注意不能重名
	/**
	 * @param Db
	 * 这样session不会以文件存储于服务器端，而是存入数据库 利于服务器集群
	 * 默认param ''
	 * 这样session以文件存储
	 */
	'SESSION_TYPE' 		=> '',			// session 存储方式

	//开启REWRITE模式
	'URL_MODEL'         =>2,			//需配合httpfd.conf中的AllowOverride None->AllowOverride All
	'URL_ROUTER_ON'		=>true,			// url路由模式

	// 路由规则 
	'URL_ROUTE_RULES'	=>array(		// 分组时放到公共文件中
		// l 负责展示列表的信息 \d 必须是数字
		'l/:id\d' 		=>'Home/List/index',	//路由规则中如果以“:”开头，表示动态变量，否则为静态地址
		':id\d'	 		=>'Home/Show/index',	//数字直接展示内容
		's/:id\d'		=>'Home/Detail/index',	//详情页
		'av/:id\d'		=>'Home/AVList/index',  //动漫视频列表路由
		'v/:id\d' 		=>'Home/Play/index', 	//动漫播放列表路由
		),
	'URL_HTML_SUFFIX' 	=>'',//伪静态后缀名
	// 加载扩展配置文件
	'LOAD_EXT_CONFIG' 	=>'verify,water'//后台验证码等配置文件
);
?>