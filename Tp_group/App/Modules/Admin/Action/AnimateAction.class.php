<?php  
/**
* 动漫 控制器
*/
class AnimateAction extends CommonAction
{
	/**
	 * 首页
	 * @return [type] [description]
	 */
	public function index()
	{
		// 分页
		import('ORG.Util.Page');
		$count = M('animate')->count('id');
		$page = new Page($count , 5);
		$limit = $page->firstRow.','.$page->listRows;

		// 关联模型 要把分类传过去
		$animate = D('AnimateRelation')->relation(true)->limit($limit)->select();

		$this->assign('animate',$animate);
		$this->assign('page', $page->show());
		$this->display();
	}
	/**
	 * 添加动漫
	 */
	public function addAnimate()
	{
		// 分配标签
		import('ExtendClass.Category',APP_PATH);
		$tag =M('tag')->order('sort asc')->select();
		$this->tag = Category::unlimitedForLevel($tag);
		// 分配所属栏目
		$arr =array();
		$type = M('type')->order('sort ASC')->select();
		// 重组为一个数组
		foreach ($type as $key => $value) {
			$k = $value['id'];
			$arr[$k] = $value['name'];
		}
		$this->assign('type',$arr);

		$this->display();
	}
	/**
	 * 处理添加动漫表单
	 * @return [type] [description]
	 */
	public function handelAddAnimate()
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
			//组合数据 
			$data = array(
				'name'		=>$_POST['name'],
				'vactor'	=>$_POST['vactor'],
				'company'	=>$_POST['company'],
				'tid'		=>(int)$_POST['type'],
				'pic'		=>$pic,
				'rate'		=>(int)$_POST['rate'],
				'content'	=>$_POST['content'],
				'time'		=>time(),
				'state'		=>$_POST['state']
				);
			// 转为相对地址
			$pic = Ipic($pic,true);
			// 引入处理
			import('ORG.Util.Image.ThinkImage');
			$img = new ThinkImage(THINKIMAGE_GD, $pic);
			//裁剪缩放 
			$img->thumb(800,600,THINKIMAGE_THUMB_SCALING)->save($pic);

			// 对标签的处理
			if($aid = M('animate')->add($data)){
				// 如果设置了tid
				if(isset($_POST['tid'])){
					$sql = 'INSERT INTO `'.C('DB_PREFIX').'animate_tag` (aid ,tid) VALUES';
					foreach ($_POST['tid'] as $v) {
						// 组合sql语句
						$sql .='('.$aid.','.$v.'),';
					}
					// 去掉末尾的逗号
					$sql = rtrim( $sql ,',');
					M('animate_tag')->query($sql);
				}
				//如果设置了周几
				if(isset($_POST['update'])){
					$update = array(
						'title'=>$_POST['name'],
						'aid'  =>$aid,
						'time' =>$_POST['update']
						);
					M('update')->add($update);
				}
				$this->success('添加成功',U(GROUP_NAME.'/Animate/index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->error('没有选择封面图');
		}
	}
	/**
	 * 修改动漫方法
	 * @return [type] [description]
	 */
	public function edit()
	{
		
		$id = I('id','','intval');
		// 关联模型 要把分类tid传过去
		$info = D('AnimateRelation')->relation(true)->find($id);
		// 组装tag为一位数组
		$tarr =array();//空数组
		foreach ($info['tag'] as $key => $value) {
			$tarr[] = $value['name'];
		}
		// 分标签
		import('ExtendClass.Category',APP_PATH);
		$tag =M('tag')->order('sort asc')->select();
		$tag = Category::unlimitedForLevel($tag);
		// 分配所属栏目
		$arr =array();
		$type = M('type')->order('sort ASC')->select();
		// 重组为一个数组
		foreach ($type as $key => $value) {
			$k = $value['id'];
			$arr[$k] = $value['name'];
		}
		// assign
		$this->assign('animate'	,$info);
		$this->assign('tag'		,$tag);
		$this->assign('checktag',$tarr);
		$this->assign('type'	,$arr);

		$this->display('editAnimate');
	}
	/**
	 * 处理修改表单
	 * @return [type] [description]
	 */
	public function handelEdit()
	{
		$id = (int)$_POST['id'];
		$pic = I('pic');
		// 封面图片的上传
		if($_FILES['new']['error']!=4){
			// 栓出原来的
			$pa = Ipic($pic,true);
			@unlink($pa);
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
		}
		// 组装数据
		$data = array(
				'id' 		=>$id,
				'name'		=>$_POST['name'],
				'vactor'	=>$_POST['vactor'],
				'company'	=>$_POST['company'],
				'tid'		=>(int)$_POST['type'],
				'pic'		=>$pic,
				'rate'		=>(int)$_POST['rate'],
				'content'	=>$_POST['content'],
				'time'		=>time(),
				);

		// 转为相对地址
		$pic = Ipic($pic,true);
		// 引入处理
		import('ORG.Util.Image.ThinkImage');
		$img = new ThinkImage(THINKIMAGE_GD, $pic);
		//裁剪缩放 
		$img->thumb(800,600,THINKIMAGE_THUMB_SCALING)->save($pic);

		// 对标签的处理
		if(M('animate')->save($data)){
			// 删除
			$sql= 'DELETE FROM`'.C('DB_PREFIX').'animate_tag` where(aid ='.$id.')';
			M('animate_tag')->query($sql);
			// 如果设置了tid
			if(isset($_POST['tid'])){
				$sql = 'INSERT INTO `'.C('DB_PREFIX').'animate_tag` (aid ,tid) VALUES';
				foreach ($_POST['tid'] as $v) {
					// 组合sql语句
					$sql .='('.$id.','.$v.'),';
				}
				// 去掉末尾的逗号
				$sql = rtrim( $sql ,',');
				M('animate_tag')->query($sql);
			}
			//如果设置了周几
				if(isset($_POST['update'])){
					$uid = M('update')->where(array('aid'=>$id))->getField('id');
					if($uid){
					$update = array(
						'id' 	=>$uid,
						'title'	=>$_POST['name'],
						'aid'  	=>$id,
						'time' 	=>$_POST['update']
						);
					M('update')->save($update);
					}else{
						$update = array(
						'title'	=>$_POST['name'],
						'aid'  	=>$id,
						'time' 	=>$_POST['update']
						);
					M('update')->add($update);
					}
				}
			$this->success('修该成功',U(GROUP_NAME.'/Animate/index'));
		}else{
			$this->error('修改失败');
		}
	}
	/**
	 * 首页幻灯片控制
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function ppt()
	{
		$ppt = M('ppt')->field('aid',true)->select();
		foreach ($ppt as $key => $value) {
			$pic =Ipic($value['pic']);
			$ppt[$key]['pic'] = $pic['orign'];
		}

		$this->assign('ppt',$ppt);
		$this->display();
	}
	/**
	 * 添加幻灯片
	 */
	public function addPpt()
	{
		$this->id = I('get.id','','intval');
		$this->name = I('get.name');

		$this->display();
	}
	/**
	 * 新增幻灯片表单处理
	 */
	public function handelAddPpt()
	{
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->allowExts  = array('jpg', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Uploads/Ppt/';// 设置附件上传目录
		
		if($upload->upload()) {// 上传成功 获取上传文件信息
			$info = $upload->getUploadFileInfo();
			$name = $info[0]['savename'];//获取文件名
		}else{// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}
		// 数据组合
		$data = $_POST;
		$data['pic'] = './Uploads/Ppt/'.$name;//相对路径
		if(M('ppt')->add($data)){
			$this->success('添加成功',U(GROUP_NAME.'/Animate/ppt'));
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * 添加分集方法
	 */
	public function diversity()
	{
		$this->id = $_GET['id'];
		$this->name = $_GET['name'];
		$this->display();
	}
	/**
	 * 添加分集处理表单
	 */
	public function addDiver()
	{
		if($_FILES['pic']['name']){//如过上传了文件
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->allowExts  = array('jpg', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Uploads/Sid/';// 设置附件上传目录
			// 裁剪
		}else{
			$where = array('id' => (int)$_POST['id']);
			$pic = M('animate')->where($where)->getField('pic');
		}
		$data = array(
			'pid'	=>(int)$_POST['id'],
			'order' => (int)$_POST['order'],
			'sid'	=>$_POST['sid'],
			'title'	=>$_POST['title'],
			'pic'	=>$pic,
			'time'	=>(int)$_POST['time'],
			'click'	=>$_POST['click'],
			'type'	=>$_POST['type'],
			);
		if(M('diversity')->add($data)){
			$this->success('添加分集成功',U(GROUP_NAME.'/Animate/index'));
		}else{
			$this->error('添加分集失败');
		}
	}
}?>