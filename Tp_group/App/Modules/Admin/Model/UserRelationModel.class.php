<?php  
	/**
	* 用户 与 角色关联模型model
	* @param Relation 多表操作
	*/
	class UserRelationModel extends RelationModel{
		// 定义主表名称
		protected $tableName = 'user';
		// 定义关联关系
		protected $_link = array(
			// role 副表名称 新增字段role 并返回数组
			'role' =>array(
				'mapping_type'		=> MANY_TO_MANY,		//关联关系 多对多
				'mapping_fields' 	=>'id,name,remark',		//要读取的字段名
				'mapping_name' 		=>'user_role',			//关联的映射名称，用于获取数据用
				//该名称不要和当前模型的字段有重复，否则会导致关联数据获取的冲突。
				'foreign_key' 		=>'user_id',			//主表外键
				'relation_foreign_key' =>'role_id',			//关联表外键
				'relation_table'	=> 'think_role_user'	//制定中间表的名称
				)
			);
		
	}
?>