<?php  
	/**
	* 用户中心控制器
	*/
	class MemberAction extends CommonAction
	{
		/**
		 * 显示主视图
		 * @return [type] [description]
		 */
		public function index()
		{
			$where = array('uid'=>session('user_id'));
		 	$pic = M('user')->where($where)->getField('pic');
		 	// 使用自定义函数 组装地址
		 	$avatar = Ipic($pic);
			$this->assign('avatar',$avatar);
			$this->display();
		}
		/**
		 * 上传头像
		 * @return [type] [description]
		 */
		public function uploadImg()
		{
			import('ORG.Net.UploadFile');						//引入文件

			$upload = new UploadFile();						// 实例化上传类
			$upload->maxSize = 1*1024*1024;					//设置上传图片的大小
			$upload->allowExts = array('jpg','png','gif');	//设置上传图片的后缀
			$upload->uploadReplace = true;					//同名则替换
			$upload->saveRule = 'uniqid';					//设置上传头像命名规则(临时图片),修改了UploadFile上传类
			$upload->autoSub = true;	//生成子目录
			$upload->subType = 'date';//子目录穿件方式
			$upload->dateFormat = 'Ym'; //date 形式
			// 保存路径
			$path = './Uploads/avatar/';
			$upload->savePath = $path;

			if(!$upload->upload()) {						// 上传错误提示错误信息
				$this->ajaxReturn('',$upload->getErrorMsg(),0,'json');
			}else{											// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
				$picname = $info[0]['savename'];//获取上传后的文件名
				$temp_size = getimagesize($path.$picname);//path + 路径名

				if($temp_size[0] < 100 || $temp_size[1] < 100){//判断宽和高是否符合头像要求
					$this->ajaxReturn(0,'图片宽或高不得小于100px！',0,'json');
				}
				$this->ajaxReturn(__ROOT__.'/Uploads/avatar/'.$user_path.$picname,$info,1,'json');//要发送一个绝对地址
			}
		}
		/**
		 * 裁剪并保存图像
		 * @param  string $value [description]
		 * @return [type]        [description]
		 */
		public function cropImg()
		{
			//图片裁剪数据
			$params = $this->_post();//裁剪参数
			if(!isset($params) && empty($params)){
				return;
			}
			$path = I('src');//接受地址参数
			$pic = explode('/',$path);//分割为数组
			//头像目录地址
			$path = './Uploads/avatar/'.$pic[4].'/'.$pic[5];//注意是相对地址
			$thumb = explode('.',$pic[5]);
			$think_name = './Uploads/avatar/'.$pic[4].'/'.$thumb[0];//组装的一个地址

			import('ORG.Util.Image.ThinkImage');
			$img = new ThinkImage(THINKIMAGE_GD,$path); 
			$img->crop($params['w'],$params['h'],$params['x'],$params['y'])->save($path);//裁剪原图
			//生成缩略图
			$img->thumb(100,100, 1)->save($think_name.'_100.jpg');
			$img->thumb(60,60, 1)->save($think_name.'_60.jpg');
			$img->thumb(30,30, 1)->save($think_name.'_30.jpg');

			$where = array('uid'=>session('user_id'));//搜索条件
			// 保存前删除
			$old_pic = M('user')->where($where)->getField('pic');
			$avatar = Ipic( $old_pic , false , 1);
			@unlink($avatar['orign']);
			@unlink($avatar['small']);
			@unlink($avatar['middle']);
			@unlink($avatar['large']);
			// 保存新头像
			if(M('user')->where($where)->setField('pic',$path)){
				$this->success("上传头像成功");
			}else{
				$this->error("上传失败");
			}
		}
		/**
		 * 修改个人信息方法
		 * @return [type] [description]
		 */
		public function setting()
		{
			$this->display();
		}
	}
?>