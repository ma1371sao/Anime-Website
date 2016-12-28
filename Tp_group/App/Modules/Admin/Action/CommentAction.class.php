<?php  
	/**
	 * 评论控制器
	 */
Class CommentAction extends CommonAction{
	/**
	 * 主视图
	 * @return [type] [description]
	 */
	public function index(){
		// 映入分页类
		import('ORG.Util.Page');
		// 总共数据的条数
		$total = M('comment')->count();
		// 实力化对象
		$page = new Page($total,10);
		// sql语句limit 子句
		$limit = $page->firstRow . ',' . $page->listRows;
		// 查询所有文章信息
		$result = M('comment')->order('time DESC')->limit($limit)->select();
		$this->assign('comment',$result);
		//分配页码
		$this->assign('page',$page->show());
		$this->display();	 
	}
	/**
	 * 删除评论
	 * @return [type] [description]
	 */
	public function del()
	{
		# code...
	}
}
?>