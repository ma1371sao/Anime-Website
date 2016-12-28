<?php
	/**
	* 列表控制器
	*/
	class ListAction extends Action{
		/**
		 * 方法
		 * @return [type] [description]
		 */
		public function index()
		{	
			//引入类文件 
			import('ExtendClass.Category',APP_PATH);
			import('ORG.Util.Page');

			$id = I('id','','intval');
			$cate = M('cate')->order('sort')->select();
			
			$cids = Category::getChildrenID($cate ,$id ,true,'id');
			$cids[] = $id;
			//查询条件 
			$where=array('cid' =>array('IN',$cids));
			// 分页数据
			$count=M('blog')->where($where)->count();
			// 创建分页类
			$page =new Page($count , 3);
			$limit =$page->firstRow.','.$page->listRows;
			// 调用视图模型
			$this->blog = D('BlogView')->getAll($where , $limit);
			$this->page =$page->show();
			$this->display();
		}
	}
?>