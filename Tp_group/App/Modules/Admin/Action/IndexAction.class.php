<?php 
/**
 * 后台首页控制器 注意继承Common 以方便检查是否登录
 */
class IndexAction extends CommonAction{
	/**
	 * 后台首页
	 * @return [type] [description]
	 */
	public function index()
	{
		// 用户头像
		$where = array('uid'=>session('user_id'));
		$pic = M('user')->where($where)->getField('pic');
		$pic = Ipic($pic);
		$pic = $pic['orign'];
		$this->assign('pic',$pic);
		$this->display();
	}
	/**
	 * 载入后台左侧方法
	 * @return [type] [description]
	 */
	public function left()
	{
		$this->display();
	}
	/**
	 * 载入后台头部方法
	 * @return [type] [description]
	 */
	public function head()
	{
		$this->display();
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
		$this->redirect(GROUP_NAME.'/Login/index');
	}
}?>