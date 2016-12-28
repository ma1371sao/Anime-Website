<?php  
/**
* 动漫类别控制器
*/
class TypeAction extends CommonAction
{
	/**
	 * 显示类别方法
	 * @return [type] [description]
	 */
	public function index(){
		$type = M('type')->order('sort ASC')->select();
		$this->assign('type',$type);
		$this->display();
	}
	/**
	 * 添加类别视图方法
	 * @return [type] [description]
	 */
	public function addType(){
		$this->display();
	}
	/**
	 * 处理添加分类方法
	 * @return [type] [description]
	 */
	public function handelType(){
		if(M('type')->add($_POST)){
			$this->success('添加成功',U(GROUP_NAME.'/Type/index'));
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * 排序方法
	 * @return [type] [description]
	 */
	public function sortType()
	{
		$type = M('type');
		foreach ($_POST as $id => $sort) {
			$type->where(array('id'=>$id))->setField('sort',$sort);
		}
		$this->redirect(GROUP_NAME.'/Type/index');
	}
	/**
	 * 修改方法
	 * @return [type] [description]
	 */
	public function editType()
	{
		// 根据id查询信息
		$id = I('id','','intval');
		$this->info = M('type')->find($id);
		$this->display();
	}
	/**
	 * 处理修改
	 * @return [type] [description]
	 */
	public function handelEdit()
	{
		if(M('type')->save($_POST)){
			$this->success('修改成功',U(GROUP_NAME.'/Type/index'));
		}else{
			$this->error('修改失败');
		}
	}
	/**
	 * 删除方法
	 * @return [type] [description]
	 */
	public function delType()
	{
		$id = I('id','','intval');
		if(M('Type')->delete($id)){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		};
	}
}?>