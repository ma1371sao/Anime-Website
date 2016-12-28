<?php  
	/**
	 * 图片裁剪控制器
	 * 保存到thumb文件夹中
	 */
	Class ThinkImgAction extends Action{
	/**
	 * 裁剪首页
	 * @return [type] [description]
	 */
	public function index(){
		$field = array('id','name','pic');
		$pic = M('animate')->field($field)->select();
		foreach ($pic as $key => $value) {
			$yu= $this->_server('HTTP_HOST');
			$img ="http://".$yu.$value['pic'];
			list($width, $height, $type, $attr) = getimagesize($img);
			$pic[$key]['w']=$width;
			$pic[$key]['h']=$height;
		}

		$this->assign('pic',$pic);
	    $this->display();
	}
	/**
	 * 裁减函数
	 * @return [type] [description]
	 */
	public function crop()
	{
		$id = I('id','','intval');
		$field = array('id','name','pic');
		$this->pic = M('animate')->field($field)->find($id);
		
		$this->display();
	}
	/**
	 * 裁剪方法
	 * @return [type] [description]
	 */
	public function cropImage()
	{
		// 图片裁剪数据
		$params = $this->_post();//裁剪参数
		if(!isset($params) && empty($params)){
			return;
		}
		// 新地址
		$path = $params['img'];
		$pic  = explode('/',$path);//分割为数组
		// 处理数组前缀
		switch ($params['type']) {
			case '1':
				$width = 260;
				$height= 260;
				$thumb = "Thumb/260x260";
				break;
			case '2':
				$width = 220;
				$height= 80;
				$thumb = "Thumb/220x80";
				break;
			case '3':
				$width = 150;
				$height= 100;
				$thumb = "Thumb/150x100";
				break;
			case '4':
				$width = 150;
				$height= 200;
				$thumb = "Thumb/150x200";
				break;
			case '5':
				$width = 200;
				$height= 250;
				$thumb = "Thumb/200x250";
				break;
			default:
				$thumb = "Thumb";
				break;
		}
		$pic[2] = $thumb; 
		$thumb_name = implode('/',$pic);//组装的一个地址
		// 转化绝对地址为相对地址
		$thumb_name_t= Ipic($thumb_name,true);
		$path_t = Ipic($path,true);
		
	 	import('ORG.Util.Image.ThinkImage');
		$img = new ThinkImage(THINKIMAGE_GD,$path_t);
		// 创建目录
		mkdir(dirname($thumb_name_t),0777,true);
		// 执行裁剪
		$img->crop($params['w'],$params['h'],$params['x'],$params['y'])->thumb($width,$height, 1)->save($thumb_name_t);//裁剪原图

		$data =array('img'=>$thumb_name);

		$this->ajaxReturn($data,$info,1);
	}
}
?>