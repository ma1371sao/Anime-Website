<?php  
	/**
	* 系统配置控制器
	*/
	class SystemAction extends CommonAction{
		/**
		 * 验证码配置
		 * @return [type] [description]
		 */
		public function verify()
		{
			$this->display();
		}
		/**
		 * 验证码处理方法
		 * @return [type] [description]
		 */
		public function updateVerify()
		{
			//F方法写入文件
			if(F('verify', $_POST, CONF_PATH)){
				$this->success('修改成功',U(GROUP_NAME.'/System/verify'));
			}else{
				$this->error('修改失败'.CONF_PATH.'verify.php文件');
			}
		}
		/**
		 * 水印配置
		 * @return [type] [description]
		 */
		public function water()
		{
			$this->display();
		}
		/**
		 * 水印处理方法
		 * @return [type] [description]
		 */
		public function updateWater()
		{
			if(F('water', $_POST, CONF_PATH)){
				$this->success('修改成功',U(GROUP_NAME.'/System/water'));
			}else{
				$this->error('修改失败'.CONF_PATH.'water.php文件');
			}
		}
}?>