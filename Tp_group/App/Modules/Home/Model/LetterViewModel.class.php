<?php  
/**
* 私信视图模型
*/
class LetterViewModel extends ViewModel{

	protected $viewFields = array(
		'news' =>array(
			'id','content','time',
			'_type'=>'LEFT'//_type定义对下一个表有效，因此要注意视图模型的定义顺序
			),
		'user' =>array(
			'uid','uname','pic',
			'_on'=>'news.form_id = user.uid'//_on来给视图模型定义关联查询条件
			),
		);

}?>