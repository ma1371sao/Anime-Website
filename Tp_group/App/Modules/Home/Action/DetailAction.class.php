<?php  
	/**
	* 详情页控制器
	*/
	class DetailAction extends Action
	{
		/**
		 * 主控制器
		 * @return [type] [description]
		 */
		public function index()
		{
			$id = I('id','','intval');
			$animate = M('animate')->where(array('id'=>$id))->select();
			// 分集
			$diversity = M('diversity')->where(array('pid'=>$id))->select();
			$this->assign('animate',$animate);
			$this->assign('diversity',$diversity);
			$this->display();
		}
		/**
		 * 加载评论列表
		 * @return [type] [description]
		 */
		public function comment()
		{
			
		}
	}
?>