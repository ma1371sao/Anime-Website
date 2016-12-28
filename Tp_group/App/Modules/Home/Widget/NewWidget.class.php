<?php  
	/**
	* 最新发布
	*/
	class NewWidget extends Widget{
		
		public function render($data)
		{
			$limit = $data['limit'];
			$field=array('id','title','click');
			$data['news'] =M('blog')->field($field)->order('time DESC')->limit($limit)->select();
			return $this->renderFile('',$data);
		}
	}
?>