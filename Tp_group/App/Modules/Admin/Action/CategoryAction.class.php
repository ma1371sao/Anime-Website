<?php  
/**
* 分类控制器
*/
class CategoryAction extends CommonAction{
	/**
	 * 显示分类方法
	 * @return [type] [description]
	 */
	public function index(){
		// 引入自定义无限极分类类
		import('ExtendClass.Category',APP_PATH);

		$cate = M('cate')->order('sort ASC')->select();
		// 处理数据
		// $this->cate = Category::getParents($cate ,12 ,true);
		// $this->cate = Category::getChildrenId($cate ,4 );
		// $this->cate = Category::getChildrenId($cate ,4 , true , 'name');
		// $this->cate = Category::unlimitedForLayer( $cate ,'child');
		$this->cate =  Category::unlimitedForLevel($cate);
		$this->display();
	}
	/**
	 * 添加分类视图方法
	 * @return [type] [description]
	 */
	public function addCate(){
		$this->pid = I('pid',0,'intval');
		$this->display();
	}
	/**
	 * 处理添加分类方法
	 * @return [type] [description]
	 */
	public function handelCate(){
		if(M('cate')->add($_POST)){
			$this->success('添加成功',U(GROUP_NAME.'/Category/index'));
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * 排序方法
	 * @return [type] [description]
	 */
	public function sortCate()
	{
		$cate = M('cate');
		foreach ($_POST as $id => $sort) {
			$cate->where(array('id'=>$id))->setField('sort',$sort);
		}
		$this->redirect(GROUP_NAME.'/Category/index');
	}
	/**
	 * 删除方法
	 */
	public function delCate()
	{
		$id = I('id','','intval');
		$num = M('cate')->where('id='.$id)->delete();
		$num += M('cate')->where('pid='.$id)->delete();
		if($num){
			$this->success('删除成功', U(GROUP_NAME.'/Category/index'));
		}else{
			$this->error('删除失败');
		}
	}
}
?>