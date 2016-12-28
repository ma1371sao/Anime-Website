<?php  
/**
* 播放页控制器
*/
class PlayAction extends PageAction
{
	/**
	 * 主视图
	 * @return [type] [description]
	 */
	public function index()
	{
		// 播放器配置
		$this->playSid();
		
		// 评论模块
		$this->comment();
		$this->display();
	}
	/**
	 * 加载评论
	 */
	public function comment()
	{
		import('ExtendClass.Page',APP_PATH);   //导入分页类
		// 要分页的结果集
		$comment = M('comment')->order('time DESC')->select();
		foreach ($comment as $key => $value) {
			$id = $value['uid'];
			$user = M('user')->where(array('uid'=>$id))->select();
			$avatar= Ipic($user[0]['pic']);
			$comment[$key]['uname'] = $user[0]['uname'];
			$comment[$key]['pic'] = $avatar['middle'];
		}
		// 配置参数
		$param = array(
			'result'	=>$comment,			//分页用的数组或sql
			'listvar'	=>'comment',		//分页循环变量
			'listRows'	=>7,				//每页记录数
			'parameter'	=>'search=key&name=thinkphp',//url分页后继续带的参数
			'target'	=>'content',		//ajax更新内容的容器id，不带#
			'pagesId'	=>'page',			//分页后页的容器id不带# target和pagesId同时定义才Ajax分页
			'template'	=>'Play:ajaxCL',	//ajax更新模板
		);
		// 调用方法
		$this->page($param);
	}
	
	/**
	 * 添加评论
	 * @return [type] [description]
	 */
	public function addComment()
	{
		if(!IS_AJAX) halt('页面不存在');
		$data = array(
			'aid'=>I('id','','intval'),
			'uid'=>1,//模拟。用户中心完成后请用session id 填充
			'content'=>I('content'),
			'time'=>time(),
			'status'=>0
			);
		
		if(M('comment')->add($data)){
			$info = '';
			$this->ajaxReturn($data,$info,1);
		}else{
			$info = '添加失败';
			$this->ajaxReturn($data,$info,0);
		}
	}
	public function playSid()
	{
		// 当前需要播放的id
		$id = I('id','','intval');
		// 本集
		$cid = M('diversity')->find($id);
		$pid =$cid['pid'];
		$this->fname= M('animate')->field(array('id','name'))->find($pid);
		// 同剧集的sid
		$sid = M('diversity')->where(array('pid'=>$pid))->select();

		// 分配参数
		$this->assign('cid',$cid);
		$this->assign('svideo',$sid);//sid不行 我去
	}
}
?>