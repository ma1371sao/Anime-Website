<?php  
	/**
	* 搜索控制器
	*/
	class SearchAction extends Action
	{
		/**
		 * 搜索首页
		 * @return [type] [description]
		 */
		public function index(){
			$k = $this->_getK();
			if( $k ){//******使用key命名会 有bug *********//
				//检索 组合条件
				$where = array(
					'uname'=>array('LIKE' , '%'.$k.'%' ),
					'uid' =>array('NEQ' , 0/*一个当前用户的id 可以从session中获取*/ )
					);
				$field= array('uid','uname','pic');
				// 导入分页类
				import('ORG.Util.Page');
				$count = M('user')->where($where)->count('uid');
				$page = new Page($count , 2);
				$limit = $page->firstRow.','.$page->listRows;
				// 查询语句
				$user = M('user')->where($where)->field($field)->limit($limit)->select();

				// 转换头像
				foreach ($user as $key => $value) {
					$avatar = Ipic($value['pic']);
					$user[$key]['pic'] = $avatar['middle'];
				}
				// 是否已互相关注...未开发
			}
			// 分配参数
			$this->assign('user',$user ? $user:false);
			$this->assign('k'	,$k ? $k:false);
			$this->assign('page',$k ? $page->show():false);
			$this->display();
		}
		/**
		 * 私有方法 取得关键字
		 * @param  string $value [description]
		 * @return [type]        [description]
		 */
		protected function _getK(){
			return  $_GET['k'] == '搜索'? NULL : $this->_get('k') ;
		}
	}
?>