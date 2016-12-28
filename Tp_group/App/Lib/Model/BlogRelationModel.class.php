<?php  
/**
* 博客关联模型
*/
class BlogRelationModel extends RelationModel{
	// 定义主表名称
	protected $tableName = 'blog';
	// 定义关联关系
	protected $_link = array(
	// attr 副表名称 新增字段 并返回数组
	'attr' =>array(
		'mapping_type' 			=> MANY_TO_MANY,//关联关系 多对多
		'mapping_name' 			=> 'attr',		//关联的映射名称，用于获取数据用
		//该名称不要和当前模型的字段有重复，否则会导致关联数据获取的冲突。
		'foreign_key'  			=> 'bid',		//主表外键
		'relation_foreign_key' 	=>'aid',		//关联表外键
		'relation_table'		=> 'think_blog_attr'//制定中间表的名称
		),
	'cate' =>array(
		'mapping_type' 	=> BELONGS_TO,			//关联关系 属于
		'mapping_fields'=>'name',				//只读取name
		'foreign_key'  	=>'cid',				//主表外键
		'as_fields'		=>'name:cate'			//防止字段重名修改name为cate并放入外层数组中
		)
	);

	public function getBlogs( $type=0 )
	{
		$field =array('del');
		$where =array('del'=> $type);
		// 返回当前关联模型对象的操作
		return $this->field($field,true)->where($where)->relation(true)->select();
	}
}?>