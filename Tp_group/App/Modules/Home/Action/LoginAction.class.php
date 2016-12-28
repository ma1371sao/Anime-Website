<?php  
	/**
	 * 前台登录控制器
	 */
	Class LoginAction extends Action{
	public function index(){
	    $this->display();
	}
	 /**
	 * 验证码产生方法
	 * @return [type] [description]
	 */
	public function imagecode()
	{
		ob_clean();//去掉ob缓存里的bom头
		// 引入think验证码类
		import('ORG.Util.Image');
		Image::buildImageVerify( 1 , 5 , 'png' , 90 , 30 );

		// 引入自定义验证码类
		// import('ExtendClass.Image',APP_PATH);
		// Image::verify(1);
	}
	/**
	 * 登录方法
	 * @return [type] [description]
	 */
	public function login()
	{
		// 防止恶意访问
		if(!IS_POST) halt("页面不存在");
		// 验证码
		// echo $_SESSION['verify'];//MD5码加密
		// echo "<br>";
		// echo md5($_POST['code']);//严格区分大小写
		
	 	if( I('code','',	'md5'	) != session('verify') ){//在使用think 里的验证码要使用 MD5 方法
		// if( I('code','','strtolower') != session('verify') ){//自定义里的验证码要使用strtolower方法
			$this->error('验证码不正确');
		}
		// 读取参数
		$uname	=	I('uname');
		$pwd	=	I('upass','','md5');
		// 查找用户
		$u = M('user')->where(array('uname' => $uname))->find();

		// 验证密码
		if(!$u || $u['upass'] != $pwd){
			$this->error("账号或密码不正确");
		}
		if(!$u['active']){
			echo "账号未激活";
		}

		// 更新登录ip和登录时间
		$data =array(
			'uid'   => $u['uid'],
			'date'  => time(),//最后一次登录时间
			'ip'    => get_client_ip()//最后一次登录ip 	**有bug**
			);
		// 更新操作
		M('user')->save($data);

		// session 写入
		session(C('USER_AUTH_KEY'),	$u['uid']);//USER_AUTH_KEY 用户认证识别号 这里为'user_id'
		session('user_name'		,	$u['uname']);
		session('user_logintime', date( "y-m-d H:i" , $u['date'] ) );//时间转换存入session
		session('user_ip'		,	$u['ip']);

		// // 超级管理员的情况
		// if ($u['uname'] == C('RBAC_SUPERADMIN')) {
		// 	session( C('ADMIN_AUTH_KEY'),true);//写入超级管理员的识别号
		// }

		// // 读取用户权限 
		// import('ORG.Util.RBAC');// 引入rbac控制类
		// RBAC::saveAccessList();//静态方法 用于检测用户权限的方法,并保存到Session中

		// 重定向回首页
		$this->redirect(GROUP_NAME.'/Index/index');
	}
	/**
	* 登出方法
	* @return [type] [description]
	*/
	public function logout()
	{
		// 销毁session
		session_unset();
		session_destroy();
		$this->redirect(GROUP_NAME.'/Index/index');
	}
	}
?>