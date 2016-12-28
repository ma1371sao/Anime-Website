<?php  
	/**
	* 	动漫关联模型
	*/
	class AnimateRelationModel extends RelationModel
	{
		// 定义主表名称
		protected $tableName = 'animate';
		// 定义关联关系
		protected $_link = array(
			// tag 副表名称 新增字段tag 并返回数组
			'tag' =>array(
				'mapping_type'		=> MANY_TO_MANY,	//关联关系 多对多
				'mapping_fields' 	=>'name',			//要读取的字段名
				'mapping_name' 		=>'tag',			//关联的映射名称，用于获取数据用
				//该名称不要和当前模型的字段有重复，否则会导致关联数据获取的冲突。
				'foreign_key' 		=>'aid',			//主表外键
				'relation_foreign_key' =>'tid',			//关联表外键
				'relation_table'	=> 'think_animate_tag'	//制定中间表的名称
				),
			'type' =>array(
				'mapping_type' 		=>BELONGS_TO,
				'mapping_fields'	=>'name',	
				'foreign_key' 		=>'tid',			//主表外键
				'as_fields'			=>'name:type'		//防止字段重名修改name为type并放入外层数组中
				)
			);

		public function getAllAnimate($where , $limit)
		{
			return $this->where($where)->relation(true)->limit($limit)->select();
		}
	}
?>