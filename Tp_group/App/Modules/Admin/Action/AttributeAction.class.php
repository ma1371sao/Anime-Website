<?php  
	/**
	* 属性控制器
	*/
	class AttributeAction extends CommonAction{
		/**
		 * 属性列表
		 * @return [type] [description]
		 */
		public function index()
		{
			$this->attr = M('attr')->select();
			$this->display();
		}
		/**
		 * 添加属性列表
		 */
		public function addAttr()
		{
			$this->display();
		}
		/**
		 * 处理添加属性表单
		 */
		public function handelAddAttr()
		{
			if(M('attr')->add($_POST)){
				$this->success('添加成功',U(GROUP_NAME.'/Attribute/index'));
			}else{
				$this->error('添加失败');
			}
		}
	}
?>