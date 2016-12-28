<?php  
	/**
	*博文控制器
	*/
	class BlogAction extends CommonAction{
		/**
		 * 博文列表
		 * @return [type] [description]
		 */
		public function index()
		{
			// 关联模型查询博客内容
			$this->blog = D('BlogRelation')->getBlogs();//内部方法
			$this->display();
		}
		/**
		 * 添加博文
		 */
		public function addBlog()
		{
			// 所属分类
			import('ExtendClass.Category',APP_PATH);
			$cate =M('cate')->order('sort asc')->select();
			$this->cate = Category::unlimitedForLevel($cate);
			// 所属属性
			$this->attr =M('attr')->select();
			$this->display();
		}
		/**
		 * 处理添加博文
		 */
		public function handelAddBlog()
		{
		// 封面图片的上传
		if($_FILES['pic']['error']!=4){
			// 一旦有封面图就制作目录
			import('ORG.Net.UploadFile');
			// 实力化
			$upload = new UploadFile();
			$upload->allowExts = array('jpg','jpeg','png','gif');//附件上传类型
			// 目录制作参数设置
			$upload->autoSub = true;
			$upload->subType = 'date';
			$upload->dateFormat='Ym';
			// 上传
			if($upload->upload('./Uploads/')){
				//成功获取上传文件的信息
				$info = $upload->getUploadFileinfo();
				$pic = __ROOT__. C('uploadpath').'/'.$info[0]['savename'];	//把上传的图片名封装起来，准备存数据库
			}else{
				// 上传失败
				$this->error($upload->getErrorMsg());
			}
			// 数据数组预定义
			$data = array(
				'title'  =>$_POST['title'],
				'content'=>$_POST['content'],
				'summary'=>$_POST['summary'],
				'pic'	 =>$pic,
				'time'   =>time(),
				'click'  =>(int)$_POST['click'],
				'cid'    =>(int)$_POST['cid']
				);
			
			// 转为相对地址
			$pic = Ipic($pic,true);
			// 引入处理
			import('ORG.Util.Image.ThinkImage');
			$img = new ThinkImage(THINKIMAGE_GD, $pic);
			//裁剪缩放 
			$img->thumb(800,600,THINKIMAGE_THUMB_SCALING)->save($pic);

			if($bid = M('blog')->add($data)){
				// 如果设置了aid
				if(isset($_POST['aid'])){
					$sql = 'INSERT INTO `'.C('DB_PREFIX').'blog_attr` (bid ,aid) VALUES';
					foreach ($_POST['aid'] as $v) {
						// 组合sql语句
						$sql .='('.$bid.','.$v.'),';
					}
					// 去掉末尾的逗号
					$sql = rtrim( $sql ,',');
					M('blog_attr')->query($sql);
				}
				$this->success('添加成功',U(GROUP_NAME.'/Blog/index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->error('没有选择封面图');
		}
			/**
			 * 关联模型存在问题
			 */
			// if(isset($_POST['aid'])){
			// 	// 数组数据
			// 	foreach ($_POST['aid'] as $v) {
			// 		$data['attr'][] = $v;
			// 	}
			// }
			// // 实例化关联模型
			// D('BlogRelation')->relation(true)->add($data);//关联模型存在问题
		}
		/**
		 * 图片处理
		 * @return [type] [description]
		 */
		public function upload()
		{
			// 设置路径
			$url = __ROOT__. C('uploadpath').'/';

			$dir = I("get.dir",'image','htmlspecialchars,trim');
			//定义允许上传的文件扩展名
			$ext_arr = array(
				'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
				'flash' => array('swf', 'flv'),
				'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
				'file'  => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
			);
			// 判断上传的是什么
	   		if (empty ( $ext_arr[$dir] )) {
	            $this->ajaxReturn (array('error' => 1, 'message' => '未知错误'));
	            exit ();
	        }
			//引入think 文件扩展
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			// 参数设置
			$upload->autoSub = true;
			$upload->subType = 'date';
			$upload->dateFormat='Ym';
			//上传成功或失败 
			if($upload->upload('./Uploads/')){
				$info = $upload->getUploadFileInfo();
				//上传后的图片地址
				$img = $url.$info[0]['savename'];
				// 图片添加水印
				// import('ORG.Util.Image');//引入think类文件
				// //水印图片位置
				// $water = $url.'water.png';
				// 生成水印图片
				/**
				 * 对于PNG格式的水印s使用think里的image类需要修改image类中的water方法 使用了imagecopy 
				 * 去掉了$alpha 参数
				 */
				// Image::water( $img , $water );
				
				import('ExtendClass.Image',APP_PATH);//引入自定义类文件
				Image::water('./Uploads/'.$info[0]['savename']);//水印图片位置在配置文件中定义 注意不能使用$img

				//返回信息
				$this->ajaxReturn(array(
					'url'  		=> 	 $img,
					'error'		=>	0
					));
			}else{
				//失败则原样输出
				$this->ajaxReturn(array(
					'error'		=>1,
					'message'	=>	$upload->getErrorMsg(),
					));
			}
			
		}
		/**
		 * 删除到回收站或还原
		 * @return [type] [description]
		 */
		public function toTrach()
		{
			$update = array(
				'id' =>	I('id','','intval'), 
				'del'=>	I('type','','intval'),
			);
			//del 0 还原 1 删除
			$msg = I('type','','intval')?'删除':'还原';

			if(M('blog')->save($update)){
				$this->success($msg.'成功',U(GROUP_NAME.'/Blog/index'));
			}else{
				$this->error($msg.'失败');
			}
		}
		/**
		 * 彻底删除
		 * @return [type] [description]
		 */
		public function delete()
		{
			// 手动删除
			$id =	I('id','','intval');
			if(M('blog')->delete($id)){
				M('blog_attr')->where(array('bid'=>$id))->delete();
				$this->success('删除成功',U(GROUP_NAME.'/Blog/trach'));
			}else{
				$this->error('删除失败');
			}
		}
		/**
		 * 回收站方法
		 * @return [type] [description]
		 */
		public function trach()
		{
			$this->blog = D('BlogRelation')->getBlogs(1);//内部方法
			$this->display('index');
		}
	
}?>