<?php  
/**
* 视图模型
*/
class AnimateViewModel extends ViewModel{

	protected $viewFields = array(
		'animate' =>array(
			'id','name','content','vactor','pic','time','company','click','rate','reply',
			'_type'=>'LEFT'//_type定义对下一个表有效，因此要注意视图模型的定义顺序
			),
		'type' =>array(
			'name'=>'type',
			'_on'=>'animate.tid = type.id'//_on来给视图模型定义关联查询条件
			),
		);

	public function getAll($where , $limit)
	{
		return $this->where($where)->limit($limit)->order('time DESC')->select();
	}
}?>