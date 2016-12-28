<?php 
// 后台配置文件
return array(
	/***************RBAC配置******************/
	'RBAC_SUPERADMIN' 	=>	'admin',		//超级管理员账号名称
	'ADMIN_AUTH_KEY' 	=>	'superadmin',	// 超级管理员识别号

	// 'USER_AUTH_MODLE' =>'user',       	// 模型实例用户表名称
	'USER_AUTH_ON' 		=>	true,			//是否开启验证 
	'USER_AUTH_TYPE' 	=>	1,				//验证类型 (1 登录认证 2 实施认证)
	'USER_AUTH_KEY' 	=>	'user_id',		// session 用户认证识别号
	
	'NOT_AUTH_MODULE' =>'Index',			// 无需验证的模块（控制器） 一般用于登录模块
	'NOT_AUTH_ACTION' =>'addUserHandel,addRoleHandel,addNodeHandel,setAccess',// 无需验证的控制器中的方法
	
	'RBAC_ROLE_TABLE' 	=>	'think_role',		// 角色表名称
	'RBAC_USER_TABLE' 	=>	'think_role_user',	// 用户角色中间表 
	'RBAC_ACCESS_TABLE' =>	'think_access',		// 权限表名称
	'RBAC_NODE_TABLE' 	=>	'think_node',		// 节点表名称

	/************后台通用****************/
	'UPLOADPATH' 		=> '/Uploads',// 上传图片的保存位置
	'URL_HTML_SUFFIX' 	=>'',//伪静态后缀名
	// 后台公用路径
	'TMPL_PARSE_STRING'	=> array(
		'__PUBLIC__'   	=>__ROOT__ . '/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public', 
	),
	'TMPL_CACHE_ON'    	=> false,// 是否开启模板编译缓存,设为false则每次都会重新编译
	'SHOW_PAGE_TRACE' 	=> true,
);
?>