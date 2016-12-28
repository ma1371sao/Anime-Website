<?php  
/**
* 无限极分类子项目类
* @param [type] [varname] [description]
*/
Class Category {
	/**
	 * 无限极分类静态方法 level级
	 * @param  array   $cate  需传入的模型数据
	 * @param  string  $html  标示符
	 * @param  integer $pid   父级id
	 * @param  integer $level 层级id
	 * @return array         处理后的数据
	 */
	Static public function unlimitedForLevel( $cate , $html = '--' , $pid = 0, $level = 0 ){
		// 预定义返回数据数组
		$array= array();
		// 拆分数组数据
		foreach ($cate as $k => $v) {
			if ($v['pid'] == $pid) {//初始 默认0
				//设定level级
				$v['level'] =  $level+1;
				//标示符处理
				$v['html'] 	= str_repeat($html, $level);
				//存入数组
				$array[] 	= $v;
				// 递归开始
				$array   	= array_merge( $array, self::unlimitedForLevel($cate , $html ,$v['id'] ,$level+1));
			}
		}
// 返回
		return $array;
	}


	/**
	 * 无限极分类静态方法 多维数组
	 * @param  array   $cate 数据数组
	 * @param  string  $name [description]
	 * @param  integer $pid  [description]
	 * @return array         [description]
	 */
	Static public function unlimitedForLayer( $cate , $name = "child" ,$pid = 0  ){
		$array =array();
		foreach ($cate as $key => $value) {
			if($value['pid'] == $pid){
				// 压入子字段
				$value[$name] = self::unlimitedForLayer($cate , $name , $value['id']);
				// 压入返回数组
				$array[] = $value;
			}
		}
		return $array;
	}

/**
 * 多级id查询
 * @param  [type]  $cate [description]
 * @param  [type]  $id   [description]
 * @param  boolean $mode [description]
 * @return [type]        [description]
 */
	Static public function getParents( $cate , $id , $mode = false ){
		$array = array();
		foreach ($cate as $v) {
			if ($v['id'] == $id) {
				$array[] = $v ;
				// 递归调用
				if($mode == false){	//逆序  子项目 << 子项目 << 子项目 << 总项目
					$array =array_merge($array, self::getParents($cate, $v['pid'] , $mode ));
				}else{ 			//顺序 	总项目 >> 子项目 >> 子项目 >> ...
					$array =array_merge(self::getParents($cate, $v['pid'], $mode ), $array);
				}
			}
		}
		return $array;
	}


/**
 * 得到子项目id
 * @param  [type] $cate [description]
 * @param  [type] $pid  [description]
 * @return [type]       [description]
 */
	Static public function getChildrenId( $cate , $pid ,$mode = false , $field=''){
		$array = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				if($mode == false){
					$array[] = $v;
				}elseif($mode==true && $field != ''){
					$array[] = $v[$field];
				}
				// 递归调用
				$array =array_merge($array ,self::getChildrenId($cate, $v['id'], $mode , $field));
			}
		}
		return $array;
	}
}
?>