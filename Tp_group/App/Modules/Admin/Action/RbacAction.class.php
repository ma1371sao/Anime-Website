<?php 
/**
 * rbac角色访问控制器
 */
Class RbacAction extends CommonAction{
/**  
 * 用户列表控制器
 * @return [type] [description]
 */
 public function index(){
  // 实力化模型类 并连贯操作
    $this->user = D('UserRelation')->field(array('upass','email') , true)->relation(true)->select();
    $this->display();
 }
 /**
  * 锁定用户操作
  * @return [type] [description]
  */
 public function lock()
 {
  $uid= I('uid','','intval');
  $data['uid']= $uid;
  $data['active']= 1;
  if($user = M('user')->save($data)){
    $this->success('锁定成功',U('Admin/Rbac/index'));
  }else{
    $this->error('锁定失败');
  }
 }
  /**
  * 解除锁定用户操作
  * @return [type] [description]
  */
 public function unlock()
 {
  $uid= I('uid','','intval');
  $data['uid']= $uid;
  $data['active']= 0;
  if($user = M('user')->save($data)){
    $this->success('解除锁定成功',U('Admin/Rbac/index'));
  }else{
    $this->error('解除锁定失败');
  }
 }
 /**
  * 角色列表控制器
  * @return [type] [description]
  */
 public function role(){
 	// 查询所有角色
 	$this->role = M('role')->select();
 	$this->display();
 }
 /**
  * 结点列表控制器
  * @return [type] [description]
  */
 public function node(){
  // 提取有用的字段
  $field = array('id','name','title','pid' );
 	$node = M('node')->field($field)->order('sort')->select();
  $node = Nmerge($node); 
  $this->assign('node',$node);
 	$this->display();
 }
 
 /**
  * 添加用户控制器
  * @return [type] [description]
  */
 public function addUser(){
    $this->role =M('role')->select();
    $this->display();
 }
  /**
  * 添加用户表单控制器
  * @return [type] [description]
  */
 public function addUserHandel(){
  // 用户信息
    $user = array(
      'uname' => I('username'),
      'upass' => I('password','','md5'),
      'date' => time(),
      'ip' => get_client_ip()
      );
  // 所属角色
    $role = array();
    if($uid =M('user')->add($user)){
      foreach ($_POST['role_id'] as $v) {
        $role[] =array(
          'role_id' => $v,
          'user_id' => $uid,
          );
      }
      // 添加角色
      M('role_user')->addAll($role);
      $this->success('添加成功',U("Admin/Rbac/index"));
    }else{
      $this->error('添加失败');
    }
 }
 /**
  * 添加角色控制器
  * @return [type] [description]
  */
 public function addRole(){
 	// 显示模板
 	$this->display();
 }
 /**
  * 添加角色表单处理控制器
  * @return [type] [description]
  */
 public function addRoleHandel(){
 	// 插入数据库
 	if( M('role')->add($_POST) ){
 		$this->success('添加成功',U('Admin/Rbac/role'));
 	}else{
 		$this->error('添加失败');
 	}
 }
 /**
  * 修改用户
  * @return [type] [description]
  */
public function editRole(){
  // 接受id
  $id = I('id','','intval');
  // 数据库
  $role = M('role')->find($id);
  $this->assign('role',$role);
  $this->display();
}
/**
 * 修改角色处理表单
 * @return [type] [description]
 */ 
public function editRoleHandel(){
  // 数组
  $data = $_POST;
  // 修改
  if(M('role')->save($data)){
    $this->success('修改成功',U(GROUP_NAME.'/Rbac/role'));
  }else{
    $this->error('修改失败');
  }
}
 /**
  * 删除角色
  * @return [type] [description]
  */
 public function deleteRole(){
  
   if(M('role')->delete($_GET['id'])){
        $this->success('删除成功');
      }else{
        $this->error('删除失败');
      }
 }
 /**
  * 添加结点控制器
  * @return [type] [description]
  */
 public function addNode(){
  	// 获取pid
    $this->pid = I('pid',0,'intval');
    // 获取level
    $this->level=I('level',1,'intval');
     //判断是控制器还是应用 
    switch ($this->level) {
    		case 1:
    			$this->type="应用";
    			break;
    		case 2:
    			$this->type="控制器";
    			break;
    		case 3:
    			$this->type="动作方法";
    			break;
    		default:
    			$this->type="";
    			break;
    }
 	$this->display();
 }
 /**
  * 添加结点处理控制器
  * @return [type] [description]
  */
 public function addNodeHandel(){
    if( M('node')->add($_POST) ){
    	$this->success('插入成功',U('Admin/Rbac/node'));
    }else{
    	$this->error('插入失败');
    }
 }

 /**
  * 配置用户权限
  * @param string $value [description]
  */
 public function access()
    {
      $rid = I( 'rid' ,0,'intval');
      $field = $field = array('id' ,'name' ,'title' ,'pid');
      $node = M('node')->order('sort')->field($field)->select();
      // 原有权限 只读取一个字段
      $access = M('access')->where(array('role_id' => $rid ))->getField('node_id',true);
      // 合并斌判断数组
      $this->node = Nmerge($node,$access);
      $this->rid =$rid;
      $this->display();
    } 
  /**
  * 修改用户权限
  * @param string $value [description]
  */
 public function setAccess()
    {
     // 用户id
     $rid = I('rid', 0 ,'intval');
     $db = M('access');
     //旧权限删除
     $db->where(array('role_id' => $rid ))->delete();

     $data =array();//用于存放数据
     // 重组数据
     foreach ($_POST['access'] as $v) {
       $temp = explode('_', $v);
       $data[]= array(
        'role_id' =>$rid,//用户id
        'node_id' =>$temp[0],//节点id
        'level' =>$temp[1],//等级
        );
    }

    if( $db->addAll($data) ){
      $this->success('修改成功',U('Admin/Rbac/role'));
     }else{
      $this->error('修改失败');
     }
    
   }
}?>
