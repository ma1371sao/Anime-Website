<?php  
/**
* 视图模型
*/
class BlogViewModel extends ViewModel{

	protected $viewFields = array(
		'blog' =>array(
			'id','title','time','click','summary',
			'_type'=>'LEFT'//_type定义对下一个表有效，因此要注意视图模型的定义顺序
			),
		'cate' =>array(
			'name',
			'_on'=>'blog.cid = cate.id'//_on来给视图模型定义关联查询条件
			),
		);

	public function getAll($where , $limit)
	{
		return $this->where($where)->limit($limit)->order('time DESC')->select();
	}

}?>