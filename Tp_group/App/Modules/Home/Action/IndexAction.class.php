<?php
	/**
	* index控制器
	*/
	class IndexAction extends Action{
	/**
	 * 首页显示方法
	 * @return [type] [description]
	 */
	public function index()
	{
		// 头部
		// $this->cate();//生成顶级博文目录
		$this->type();//类型
		// <area#a>
		$this->newAnimate();//新增动漫
		// <area#b>
		$this->recommend();//热播推荐
		$this->animateShow();//分配动漫数据视图
		// $this->update();//最近一周更新
		
		
		
		// $this->trailer()//新番预告
		// $this->log();//登陆状态判断以及自动登录
		// $this->topic();//专题
		// $this->ad();//广告
		// $this->rank();//排行榜
		$this->display();
	}
	// 	/**
	//  * 走缓存的顶级分类cate方法
	//  * @return [type] [description]
	//  */
	// public function cate(){
	// 	// 先走缓存
	// 	if ( !$topCate = S('index_cate') ) {//如果没有这个缓存
	// 	$db =M('blog');//所要的主数据库
	// 	// 顶级分类
	// 	$topCate = M('cate')->where('pid = 0')->order('sort')->select();
	// 	// 返回子集
	// 	import('ExtendClass.Category',APP_PATH);
	// 	// 查询所有cate
	// 	$cate  = M('cate')->order('sort')->select();
	// 	// 要读取的字段
	// 	$field = array('id','title','time');
	// 	foreach ($topCate as $k => $v) {
	// 		// 组合成一个数组
	// 		$cids = Category::getChildrenId($cate ,$v['id'],true,'id');
	// 		// 并且压入原来的父级id
	// 		$cids[] =$v['id'];
	// 		// 组合in语句
	// 		$where=array('cid'=>array('IN',$cids));
	// 		// 压入返回数组
	// 		$topCate[$k]['blog'] = $db->field($field)->where($where)->order('time DESC')->select(); 
	// 	}
	// 	// 数据缓存 减轻数据库负担
	// 	// 参数 : 缓存名称 缓存数据 缓存时间
	// 	S('index_cate',$topCate,10);//10 缓存有效期限
	// 	}
	// 	// 分配参数
	// 	$this->assign('cate', $topCate);
	// }
	/**
	 * 类型筛选小工具
	 * @return [type] [description]
	 */
	public function type()
	{
		// 先走缓存
		if ( !$tag = S('index_tag') ) {//如果没有这个缓存
			// 分配标签
			import('ExtendClass.Category',APP_PATH);
			$tag =M('tag')->order('sort asc')->select();
			$tag = Category::unlimitedForLevel($tag);
			//缓存有效期限
			S('index_tag',$tag,1000);
		}
		// 分配
		$this->assign('tag',$tag);
	}
	/**
	 * 新增的动漫
	 * @return [type] [description]
	 */
	public function newAnimate()
	{
		import('ORG.Util.Page');
		$db = D('BlogRelation');
		$where = array('del'=>0);
		$count = $db->where($where)->count();
		
		$page = new Page($count , 6);
		$limit = $page->firstRow.','.$page->listRows;
		$new = $db->order('time DESC')->limit($limit)->getBlogs();
		foreach ($new as $key => $value) {
			$path  = $value['pic'];
			$new[$key]['pic'] = $path;
			//to260X260($path);//组装的一个地址
		}
		$this->assign('new',$new);
		$this->assign('page', $page->show());
	}
	/**
	 * 带数据缓存的热播推荐top 10
	 * @return [type] [description]
	 */
	public function recommend()
	{
		// 先走缓存
		if ( !$recommend = S('index_recommend') ) {//如果没有这个缓存
			$db = M('animate');
			$field = array('id','name','pic','rate','content');
			// 限定个数
			$limit = 9;//个数
			$recommend = $db->field($field)->order('rate DESC')->limit($limit)->select();
			foreach ($recommend as $key => $value) {
				$path  = $value['pic'];	
				$recommend[$key]['pic'] = ($key==0?to200X250($path):to150X100($path));//组装的一个地址
			}
			// 数据缓存 减轻数据库负担
			// 参数 : 缓存名称 缓存数据 缓存时间
			S('index_recommend',$recommend,1000);//10 缓存有效期限
		}
		if(!$remore = S('recommend_more')){
			$db = M('animate');
			// 随机查询3条数据
			$arr= array();
			$rand = rand(0,26);
			$temp = $db->field(array('id','name'))->order('rate DESC')->limit(30)->select();
			for ($i=$rand; $i<$rand+4 ; $i++) { 
				$arr[] = $temp[$i];
			}
			$remore = $arr;
			S('recommend_more',$remore,1000);
		}
		// 分配
		$this->assign('recommend_more',$remore);
		$this->assign('recommend',$recommend);
	}
	/**
	 * 显示动漫实体信息
	 * 不缓存
	 * @return [type] [description]
	 */
	public function animateShow()
	{
		$AnimateType = M('type')->order('sort')->select();//生成顶级动漫目录
		// 查询并压入数组
		foreach ($AnimateType as $k => $v) {
			// 动漫查询字段
			$field = array();
			// 动漫查询条件
			$where = array('tid'=>$v['id']);
			$limit = 9;
			$AnimateType[$k]['animate'] = D('AnimateRelation')->getAllAnimate($where,$limit);
			
			// $arra = array();
			// $rand = rand(0,26); 
			$temp = M('Animate')->field(array('id','tid','name'))->where($where)->order('rate DESC')->limit(4)->select();
			// for ($i=$rand; $i<$rand+4 ; $i++) { 
			// 	$arra[] = $temp[$i];
			// }
			$AnimateType[$k]['more'] = $temp;
		}
		// 分配参数阶段
		$this->assign('AT',$AnimateType);
	}
	// /**
	//  * 带数据缓存的最近一周更新列表
	//  * @param  string $value [description]
	//  * @return [type]        [description]
	//  */
	// public function update()
	// {
	// 	// 先走缓存
	// 	if ( !$update = S('index_update') ) {//如果没有这个缓存
	// 		$db = M('animate');
	// 		$field = array('id','name','time');
	// 		// 时间设置
	// 		$now = time();
	// 		$lastweek = $now - 7*3600*12;
	// 		// where查询条件
	// 		$where['time'] = array('between', array($lastweek,$now));
	// 		// 限定个数
			
	// 		$update = $db->field($field)->where($where)->select();
	// 		// 重组数据
	// 		$arr = array();
	//  		foreach ($update as $key => $value) {
	// 			$weekday = date('w',$value['time']);
	// 			$arr[$weekday][] = $update[$key];
	// 		}
	// 		$update = $arr;
	// 		// 数据缓存 减轻数据库负担
	// 		// 参数 : 缓存名称 缓存数据 缓存时间
	// 		S('index_update',$update,10);//10 缓存有效期限
	// 	}
	// 	// 分配
	// 	$this->assign('update',$update);
	// }
	
	
}?>