<?php 
/**
 * 帖子管理控制器 注意继承Common 以方便检查是否登录
 */
	class MsgManageAction extends CommonAction{
	/**
	 * [index 方法]
	 * @return [type] [description]
	 */
		public function index()
		{
			// 映入分页类
			import('ORG.Util.Page');
			// 总共数据的条数
			$total = M('news')->count();
			// 实力化对象
			$page = new Page($total,10);
			// sql语句limit 子句
			$limit = $page->firstRow . ',' . $page->listRows;
			// 查询所有文章信息
			$result = M('news')->order('time DESC')->limit($limit)->select();
			$this->assign('article',$result);
			//分配页码
			$this->assign('page',$page->show());
			$this->display();
		}
	  	public function delete()
		{
			$id = I('id','','intval');
			if(M('news')->where(array('id'=>$id))->delete()) {
				$this->success('删除成功',U('Admin/MsgManage/index'));
			}else{
				$this->error('删除失败');
			}
			# code...
		}
}?>