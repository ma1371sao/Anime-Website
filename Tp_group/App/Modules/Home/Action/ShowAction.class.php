<?php
	/**
	* 展示控制器
	*/
	class ShowAction extends Action{
		/**
		 * 方法
		 * @return [type] [description]
		 */
		public function index()
		{
			$id =I('id','','intval');
			// 条件
			$field=array('id','title','time','content','cid');
			// 查询
			$this->blog=M('blog')->field($field)->find($id);

			import('ExtendClass.Category',APP_PATH);
			$cate = M('cate')->order('sort')->select();
			$cid  = $this->blog['cid'];
			// 获取所有父级
			$this->parents = Category::getParents($cate, $cid , true);
			
			$this->display();
		}

		public function click()
		{
			$id =(int)$_GET['id'];
			$where= array('id'=>$id);
			$click=M('blog')->where($where)->getField('click');
			// click 自增一
			M('blog')->where($where)->setInc('click');//默认加1
			echo "document.write(".$click.")";
		}
	}
?>