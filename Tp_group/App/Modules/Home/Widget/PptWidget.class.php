<?php  
	/**
	* 显示首页幻灯片工具
	*/
	class PptWidget extends Widget{
		
		public function render($data)
		{
			$limit = $data['limit'];
			$where = array();
			$result =M('ppt')->where($where)->limit($limit)->select();
			foreach ($result as $key => $value) {
				//转换pic为绝对地址
				$pic = Ipic($value['pic']);
				$result[$key]['pic'] = $pic['orign'];
			}
			$data['ppt'] = $result;
			$up = M('update')->select();
			for ($i=1; $i <8; $i++) { 
				foreach ($up as $key => $value) {
				if($value['time'] == $i)
					$result2[$i][] = $up[$key];
				}
			}
			
			$data['update'] = $result2;

			return $this->renderFile('',$data);
		}
	}
?>