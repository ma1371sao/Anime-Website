<?php  
/**
* 动漫类别控制器
*/
class TagAction extends CommonAction
{
	/**
	 * 显示类别方法
	 * @return [type] [description]
	 */
	public function index(){
		// 引入自定义无限极分类类
		import('ExtendClass.Category',APP_PATH);

		$tag = M('tag')->order('sort ASC')->select();
		// 处理数据
		// $this->cate = Category::getParents($cate ,12 ,true);
		// $this->cate = Category::getChildrenId($cate ,4 );
		// $this->cate = Category::getChildrenId($cate ,4 , true , 'name');
		// $this->cate = Category::unlimitedForLayer( $cate ,'child');
		$this->tag =  Category::unlimitedForLevel($tag);
		$this->display();
	}
	/**
	 * 添加类别视图方法
	 * @return [type] [description]
	 */
	public function addTag(){
		$this->pid = I('pid',0,'intval');
		$this->display();
	}
	/**
	 * 处理添加分类方法
	 * @return [type] [description]
	 */
	public function handelTag(){
		if(M('tag')->add($_POST)){
			$this->success('添加成功',U(GROUP_NAME.'/Tag/index'));
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * 排序方法
	 * @return [type] [description]
	 */
	public function sortTag()
	{
		$tag = M('tag');
		foreach ($_POST as $id => $sort) {
			$tag->where(array('id'=>$id))->setField('sort',$sort);
		}
		$this->redirect(GROUP_NAME.'/Tag/index');
	}
	/**
	 * 修改方法
	 */
	public function edit()
	{
		$id = I('id','','intval');
		$tag = M('tag');
		$this->edit= $tag->find($id);
		// 显示
		$this->display();
	}
	public function editTag()
	{
		if(M('tag')->save($_POST)){
			$this->success('修改成功',U(GROUP_NAME.'/Tag/index'));
		}else{
			$this->error('修改失败');
		}
	}
	/**
	 * 删除方法
	 */
	public function delTag()
	{
		$id = I('id','','intval');
		$num = M('tag')->where('id='.$id)->delete();
		$num +=M('tag')->where('pid='.$id)->delete();
		if($num){
			$this->success('删除成功', U(GROUP_NAME.'/Tag/index'));
		}else{
			$this->error('删除失败');
		}
	}
}?>