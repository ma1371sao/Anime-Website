<?php  
	/**
	* 动漫分类内页控制器
	*/
	Class AVListAction extends Action
	{
		/**
		 * 首页控制器
		 * @return [type] [description]
		 */
		public function index()
		{
			$this->type();
			// 引入分类页文件
			import('ORG.Util.Page');
			$id = I('id','','intval');
			//查询条件 
			$where=array('tid' => $id);
			// 分页数据
			$count=M('animate')->where($where)->count();
			// 创建分页类
			$page = new Page($count , 6);
			$limit = $page->firstRow.','.$page->listRows;
			// 调用视图模型
			$this->animate = D('AnimateView')->getAll($where , $limit);
			
			$this->page    = $page->show();
			$this->display();
		}
		/**
		 * 展示分类
		 * @return [type] [description]
		 */
		public function type()
		{
			$order= "sort DESC";
			$type = M('type')->order($order)->select();
			$tag = M('tag')->order($order)->select();
			$this->assign('type',$type);
			$this->assign('tag',$tag);
		}
		/**
		 * order排序
		 */
		public function order()
		{
			$od = I('order');
			$this->order =array(); 
		}
	}
?>