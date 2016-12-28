<?php  
	/**
	* 热门博客工具类
	*/
	class HotWidget extends Widget{
		
		public function render($data)
		{
			$field=array('id','title','click');
			// 热门博文
			$data['blog'] = M('blog')->field($field)->order('click DESC')->limit(6)->select();
			// 渲染模板输出 传递参数数据
			return $this->renderFile('',$data);
			// 必须return
		}
}?>