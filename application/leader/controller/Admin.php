<?php
namespace app\leader\controller;
use think\View;
use think\Controller;
use app\leader\model\Admin;
use app\leader\model\Reserve;
use app\leader\model\Broker;
use think\Session;
use think\Db;
use think\Request;
header('Access-Control-Allow-origin:*');
class Admin extends Controller
{
	public function login()
	{
		
		return $this->fetch();
	}
	// 登录验证
	public function doLogin()
	{


		if (!$this->authentication1($_POST['username'])) {
			echo json_encode(array('status'=>0,'msg'=>'不存在','data'=>[]));die();
		}
		$user =  new Admin();
		$sel = Db::name('admin')->where('username',$_POST['username'])->find();

		if ($sel['password'] == $_POST['password']) {
			//登录成功之后把信息保存到session
			session('user',[
				'uid'=>$sel['id'],
				'username'=>$sel['username']
				]);
			
			echo json_encode(array('status'=>1,'msg'=>'登录成功','data'=>[]));die();
		} else {
			echo json_encode(array('status'=>0,'msg'=>'密码错误','data'=>[]));die();
		}
	}
	//用户名验证
	public function authentication()
	{	
		$username = new Admin;
		$name = $username->doFind($_POST['username']);
		if ($name) {
			echo json_encode(array('status'=>1,'msg'=>'请输入密码','data'=>[]));
		} else{
			echo json_encode(array('status'=>0,'msg'=>'用户名不存在','data'=>[]));
		}
	}
	public function authentication1($username)
	{
		$sel = Db::name('admin')->where('username',$username)->find();

		if ($sel) {
			return true;
		} else {
			return false;
		}
	}
	//验证码验证
	public function verify()
	{
		if(!captcha_check($_POST['verify'])){
			//验证失败
			echo json_encode(array('status'=>0,'msg'=>'','data'=>[]));die();
		} else{
			echo json_encode(array('status'=>1,'msg'=>'','data'=>[]));die();
		}
	}
	//退出登录
	public function loginOut()
	{
		Session::clear();
		$this->success('退出成功','__SITE__/index/index/index');
	}
    public function index()
    {
    	
        return $this->fetch();
    }
 	public function info()
 	{
 		return $this->fetch();
 	}

 	public function pass()
 	{
 		return $this->fetch();
 	}
 	// 修改管理员密码
 	  //验证密码
 	public function yz()
 	{
 		$password = new Admin;
 		$pa = $password->doPa();
 		if($_REQUEST['password'] != $pa['password']) {
 			echo json_encode(array('status'=>0,'msg'=>'请输入正确密码','data'=>[]));die();
 		}else{
 			echo json_encode(array('status'=>1,'msg'=>'密码匹配成功','data'=>[]));die();
 		}
 	}
 	public function doPass()
 	{
 		$password = new Admin;
 		
 		$result = $password->updatePass($_REQUEST['renewpass']);
 		if ($result) {
 			
 			echo json_encode(array('status'=>1,'msg'=>'修改成功','data'=>[]));die();
 		}else{
 			echo json_encode(array('status'=>0,'msg'=>'修改失败','data'=>[]));die();
 		}

 		
 	}

 	public function add()
 	{
 		return $this->fetch();
 	}

 	//处理预约信息
 	public function reserve()
 	{
 		$a = new Admin;
 		$result = $a->doReserve();
 		$this->assign('result',$result);
 		return $this->fetch();
 	}
 	//删除当前选中的预约信息
 	public function del()
 	{
 		$id = $_POST['id'];
 		if (empty($id)) {
 			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
 		}else{
 			$a = new Admin;
 			$result = $a->Dreserve($_POST['id']);
 			// var_dump($result);die;
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
 		}
 		
 	}
 	public function delMore(Reserve $reserve)
    {
        $id = input('id');
        $id = explode(',',$id);
        $reserve->delAdmin($id);
        echo json_encode(['status'=> 1]);
    }



 	public function cate()
 	{
 		return $this->fetch();
 	}
 	public function catedit()
 	{
 		return $this->fetch();
 	}
 	public function column()
 	{
 		return $this->fetch();
 	}
 	public function page()
 	{
 		return $this->fetch();
 	}
 	public function tips()
 	{
 		return $this->fetch();
 	}
 	public function list1()
 	{
 		return $this->fetch();
 	}
 	//管理员信息
 	public function my()
 	{
 		return $this->fetch();
 	}
 	//修改管理员信息
 	public function doMy()
	{
		$date['name'] = $_POST['name'];
		$date['phone'] = $_POST['phone'];
		
		if (!empty($date)) {

			$a = new Broker;
			$result = $a->upNew($date);
			$this->success('修改成功','__SITE__/leader/admin/my');
		}else{
			$this->error('请输入内容,别瞎点');
		}	
		
		
	}
	//修改头像
	public function picture()
	{
		return $this->fetch();
	}
}
