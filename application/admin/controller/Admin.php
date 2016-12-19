<?php
namespace app\admin\controller;
use think\View;
use think\Controller;
use app\admin\model\Admin;
use app\admin\model\Reserve;
use app\admin\model\Broker;
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
	public function findp()
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
		$sel = Db::name('broker')->where('username',$_POST['username'])->find();
		if ($sel['password'] == $_POST['password']) {
			//登录成功之后把信息保存到session
			session('user',[
				'uid'=>$sel['id'],
				'username'=>$sel['username'],
				'number'=>$sel['number']
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
		$sel = Db::name('broker')->where('username',$username)->find();

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
 	//修改密码
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
 		$key = session('user')['number'];
 		$a = new Admin;
 		$result = $a->doReserve($key);
 		// dump($result);die;
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
 	//联动全选删除
 	public function delMore(Reserve $reserve)
    {
        $id = input('id');
        $id = explode(',',$id);
        $reserve->delAdmin($id);
        echo json_encode(['status'=> 1]);
    }
 	//经纪人信息
 	public function my()
 	{
 		return $this->fetch();
 	}
 	//修改经纪人信息
 	public function doMy()
	{
		$date['name'] = $_POST['name'];
		$date['phone'] = $_POST['phone'];
		
		if (!empty($date)) {

			$a = new Broker;
			$result = $a->upNew($date);
			$this->success('修改成功','__SITE__/admin/admin/my');
		}else{
			$this->error('请输入内容,别瞎点');
		}	
		
		
	}
	//修改头像
	public function picture()
	{
		return $this->fetch();
	}

	//找回密码页面解析并获取key值
	public function findmail()
	{
		$request = Request::instance();
		$key = $request->param()['key'];
		$this->assign('key',$key);
		return $this->fetch();
	}
	// 邮箱发送
		public function con()
	{
		$subject="我爱我家经纪人密码找回";
		$data['k_b_username'] = input("post.username");
		$email=input("post.email");
		// 随机生成一个key进行加密
		$key = md5(time());
		$data['k_key'] = $key;
		Db::name('keys')->insert($data);
		// $email="718041217@qq.com";

		$con = '<style class="fox_global_style"> div.fox_html_content { line-height: 1.5;} /* 一些默认样式 */ blockquote { margin-Top: 0px; margin-Bottom: 0px; margin-Left: 0.5em } ol, ul { margin-Top: 0px; margin-Bottom: 0px; list-style-position: inside; } p { margin-Top: 0px; margin-Bottom: 0px } </style><table style="-webkit-font-smoothing: antialiased;font-family:"微软雅黑", "Helvetica Neue", sans-serif, SimHei;padding:35px 50px;margin: 25px auto; background:rgb(247,246, 242); border-radius:5px" border="0" cellspacing="0" cellpadding="0" width="640" align="center"> <tbody> <tr> <td style="color:#000;"> </td> </tr> <tr><td style="padding:0 20px"><hr style="border:none;border-top:1px solid #ccc;"></td></tr> <tr> <td style="padding: 20px 20px 20px 20px;"> Hi 你好 </td> </tr> <tr> <td valign="middle" style="line-height:24px;padding: 15px 20px;"> <br> 请点击以下链接修改您的密码： </td> </tr> <tr> <td style="height: 50px;color: white;" valign="middle"> <div style="padding:10px 20px;border-radius:5px;background: rgb(64, 69, 77);margin-left:20px;margin-right:20px"> <a style="word-break:break-all;line-height:23px;color:white;font-size:15px;text-decoration:none;" href="http://www.home.com/admin/admin/findmail?key='.$key.'">http://www.home.com/admin/admin/findmail?key='.$key.'</a> </div> </td> </tr> <tr> <td style="padding: 20px 20px 20px 20px"> 请勿回复此邮件，如果有疑问，请联系我们：<a style="color:#5083c0;text-decoration:none" href="mailto:hutianqi@qyuers.cn">hutianqi@qyuers.cn
	</a> </td> </tr><tr> <td style="padding: 20px 20px 20px 20px"> 交流群：000000 </td> </tr> <tr> <td style="padding: 20px 20px 20px 20px">帮助你更快的完成项目- hutianqi@qyuers.cn </td> </tr> </tbody> </table>';
	$status = send($email,$subject,$con);
	if($status){
		echo json_encode(array('status'=>1,'msg'=>'','data'=>[]));die();
	}else{
		echo json_encode(array('status'=>0,'msg'=>'请输入注册时的邮箱地址','data'=>[]));die();
	}

	}
	//通过邮箱找回密码
	public function back()
	{
			$key = $_POST['key'];
			$name = $_POST['username'];
			$password = $_POST['password'];
			$a = Db::name('broker')->alias('b')
			->join('home_keys k','b.username = k.k_b_username AND k_key = \''.$key.'\'')->select();
			$names = $a[0]['username'];
			$result = Db::table('home_broker')->where('username',$names)->update(['password' => $password]);
			if ($result) {
				$this->success('成功找回','__SITE__/admin/admin/login');
			}else{
				$this->error('请输入有效的用户名');
			}
	}
	//经纪人找回密码验证邮箱
	public function email()
	{
		$data['email'] = $_POST['email'];
		$ml = new Admin();
		$mail = $ml->seMail($data);
		if ($mail) {
			echo json_encode(array('status'=>1,'msg'=>'','data'=>[]));die();
		} else{
			echo json_encode(array('status'=>0,'msg'=>'请输入注册时的邮箱地址','data'=>[]));die();
		}
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
}
