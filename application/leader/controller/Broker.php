<?php
namespace app\leader\controller;
use think\View;
use think\Controller;
use app\leader\model\Broker;
use think\Session;
use think\Db;
use think\Request;
class Broker extends Controller
{

	//查询出所有的经纪人信息
	public function broker()
	{
		$borker = new Broker;
		$select = $borker->seleceBorker();
		$this->assign('select',$select);
		$count = $borker->conutBroker();
		$this->assign('count',$count);
		return $this->fetch();
	}

	public function adds()
	{
		return $this->fetch();
	}
	//用户名验证
	public function authentication()
	{
		$username = new Broker;
		$name = $username->doFind($_POST['username']);

		if ($name) {
			echo json_encode(array('status'=>0,'msg'=>'用户名已经存在','data'=>[]));
		} else{
			echo json_encode(array('status'=>1,'msg'=>'','data'=>[]));
		}
	}
	//新增经纪人
	public function register()
	{
		//获取前台传过来的信息
		$data['name'] = $_POST['name'];
		$data['number'] = $_POST['number'];
		$data['sex'] = $_POST['sex'];
		$data['phone'] = $_POST['phone'];
		$data['email'] = $_POST['email'];
		$data['b_location'] = $_POST['b_location'];
		$data['s_location'] = $_POST['s_location'];
		$data['com_num'] = $_POST['com_num'];
		$data['username'] = $_POST['username'];
		$data['password'] = $_POST['password'];
		
		$broker = new Broker;
		//讲信息插入数据库
		$reg = $broker->doregister($data);
		
		if ($reg) {
			$this->success('注册成功','__SITE__/leader/broker/adds');
		}else{
			$this->error('注册失败');
		}
	}
	//删除已经辞职的经纪人
	public function del()
	{

		$id = $_POST['id'];

 		if (empty($id)) {
 			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
 		}else{
 			$del = new Broker;
 			$result = $del->delBroker($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
 		}
	}

	//修改经纪人信息
	public function change()
	{
		$id = $_GET['id'];
		$borker = new Broker;
		$select = $borker->seleceBorkers($id);
		// dump($select[0]);die;
		$this->assign('select',$select);
		return $this->fetch();
	}

	public function changes()
	{
		$id = $_POST['id'];
		$data['r_num'] = $_POST['r_num'];
		$data['e_num'] = $_POST['e_num'];
		$data['w_year'] = $_POST['w_year'];

		$change = new Broker;
		$updata = $change->changeBroker($data,$id);
		if ($updata) {
			$this->success('修改成功','__SITE__/leader/broker/broker');
		}else{
			$this->success('修改失败');
		}
	}
	
}
