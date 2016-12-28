<?php  
	/**
	 * 重组结点信息
	 * @param integer $pid [父级id]
	 * @param $node [结点参数]
	 */
	function Nmerge($node ,$access=null ,$pid = 0)
	{
		// 返回的数组
		$array = array();
		foreach ($node as $v) {
			if ($v['pid'] == $pid) {
				// 权限
				if (is_array($access)) {
						$v['access']=in_array($v['id'], $access)? 1 : 0 ;
				}
				// 递归调用
				$v['child'] = Nmerge($node ,$access,$v['id']);
				$array[] = $v ;
			}
		}
		// return
		return $array;
	}
	
?>