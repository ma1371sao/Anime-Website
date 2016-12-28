<?php 
/**
 * 后台预设控制器
 */
class CommonAction extends Action{
	/**
	* 类自动运行方法 优先级大于其他方法
	* @return [type] [description]
	*/
	public function _initialize()
	{
		if( !isset($_SESSION[C('USER_AUTH_KEY')]) ){
			$this->redirect(GROUP_NAME.'/Login/index');
		}

		// 不需要验证的模块或者方法
		$notAuth = in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))||
				   in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));

		// 权限认证是否开启
		if (C('USER_AUTH_ON') && !$notAuth) {
			// 引入Rbac类
			import('ORG.Util.RBAC');
			// 短路 前真后不执行 由于是项目分组要叫上分组名称
			RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');
		}
	}
}?>