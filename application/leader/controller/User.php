<?php
namespace app\leader\controller;
use think\Controller;
use think\View;
use think\Session;
use app\leader\model\User;
class User extends Controller
{
	//查询所有用户信息
	public function user()
	{
		$user  = new User;
		$select = $user->selectUser();
		$this->assign('select',$select);
		$count = $user->userCount();
		$this->assign('count',$count);

		return $this->fetch();
	}
	//删除用户
	public function del()
	{

		$id = $_POST['id'];
		$del = new User;
		$delUser = $del->userDel($id);
		if ($delUser) {
			echo json_encode(array('status' => 1, 'msg'=>'删除成功','data'=>[]));die();
		}else{
			echo json_encode(array('status' => 0, 'msg' =>'请重新操作','data'=>[]));die();
		}
	}
	//锁定用户
	public function userLock()
	{
		$id = $_GET['id'];
		$lock = new User;
		$userLock = $lock->lockUser($id);
		// dump($userLock);die;
		if ($userLock) {
			$this->success('成功锁定','__SITE__/leader/user/user');
		}else{
			$this->error('请重新操作');
		}
	}
	//解锁用户
	public function userOpen()
	{
		$id = $_GET['id'];
		$open = new User;
		$userOpen = $open->openUser($id);
		// dump($userLock);die;
		if ($userOpen) {
			$this->success('成功解锁','__SITE__/leader/user/user');
		}else{
			$this->error('请重新操作');
		}
	}
}