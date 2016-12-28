<?php  
	/**
	* 用户个人中心控制器
	*/
	class UserAction extends Action{
		/**
		 * 个人中心首页
		 * @return [type] [description]
		 */
		public function index()
		{
			$this->display();
		}
		/**
		 * 私信方法 注意数据表名称为news
		 * @return [type] [description]
		 */		
		public function letter()
		{
			$uid = 1;//请从session中取出
			// 分页显示
			import('ORG.Util.Page');
			$count = M('news')->where(array('to_id' => $uid))->count();
			$page = new Page($count ,20);
			$limit = $page->firstRow.','.$page->listRows;
			// 发送给当前用户的
			$where = array('news.to_id' => $uid);
			$letter = D('LetterView')->where($where)->order('time DESC')->limit($limit)->select();
			// 修改pic
			foreach ($letter as $key => $value) {
				$pic = Ipic($value['pic']);
				$letter[$key]['pic'] = $pic['middle'];
			}
			// 分配参数
			$this->assign('letter',$letter);//私信视图数据
			$this->assign('count' ,$count);//总共私信条数
			$this->assign('page'  ,$page->show());//页码
 			$this->display();
		}
		/**
		 * 私信发送方法
		 * @return [type] [description]
		 */
		public function letterSend()
		{
			// 防止访问
			if (!IS_POST) {
				halt('页面不存在');
			}
			// 根据信命查询
			$name = I('name','','htmlspecialchars');
			$where= array('uname'=>$name);
			$id = M('user')->where($where)->getField('uid');

			if(!$id){
				$this->error('用户不存在');
			}
			$data = array(
				'form_id' => 56,//请改成用户session内保存的id
				'content' =>I('content'),
				'time'=>time(),
				'to_id' =>$id 
				);

			if(M('news')->data($data)->add()){
				$this->success('私信已发送',U(GROUP_NAME.'/User/letter'));
			}else{
				$this->error('发送失败');
			}
		}
		/**
		 * ajax异步删除私信
		 */
		public function letterDel()
		{
			if(!IS_AJAX){
				halt('页面不存在');
			}
			$id = I('id','','intval');
			if(M('news')->delete($id)){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}
		}
}?>