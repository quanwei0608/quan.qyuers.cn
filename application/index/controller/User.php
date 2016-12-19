<?php
/**
 * 处理用户信息控制器
 */
namespace app\index\controller;
use think\View;
use think\Db;
use think\Controller;
use app\index\model\User;
use app\index\model\Reserve;
use app\index\model\Focus;
use think\Request;
use think\Session;
class User extends Controller
{   //显示登录页面
    public function login()
	{
		
        return $this->fetch();
	}
    //处理登录信息
    public function doLogin()
    {
        $user = new User;
        $data['username'] = $_POST['username'];
        $data['password'] = md5($_POST['password']);
        
        $result = $user->doFind($data);
        if($result['password'] == md5($_POST['password'])){
            session('user',[
                'id' => $result['id'],
                'username' => $result['username']
                ]);
           $this->success('登录成功！', '__SITE__/index/user/set');
        }else{
            $this->error('登录失败！');
        }
    }
    //退出登录
    public function outLogin()
    {
        Session::clear();
        $this->success('退出成功！','__SITE__/index/index/index');
    }
    //显示注册页面
     public function register()
    {
        return $this->fetch();
    }
    //处理注册信息
    public function doRegister()
    {
        $user = new User;
        $data['username'] = $_POST['username'];
        $data['password'] = md5($_POST['password']);
        $data['phone'] = $_POST['phone'];
              $result = $user->doAdd($data);

        if($result){
            echo json_encode(array('status'=>1,'msg'=>'注册成功','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'注册失败','data'=>[]));die();
        }
    }
    // 处理用户名
    public function doUser()
    {
         $username = $_REQUEST['username'];
         $user = new User;
         $result = $user ->nameCheck($username);
         if($result){
            echo json_encode(array('status'=>1,'msg'=>'已被注册','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'注册失败','data'=>[]));die();
        }
    }
    // 处理手机号
    public function doPhone()
    {
         $phone = $_REQUEST['phone'];
         $user = new User;
         $result = $user ->phoneCheck($phone);
         if($result){
            echo json_encode(array('status'=>1,'msg'=>'已被注册','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'注册失败','data'=>[]));die();
        }
       
    }
    //显示个人管理
    public function set()
    {
        return $this->fetch();
    }
    //修改真实姓名
    public function doRealname()
    {   
        $user = new User;
        $id = session('user')['id'];
        
        $data['sex'] = $_POST['sex'];
        $data['realname'] = $_POST['realname'];
        $result = $user ->doUpdate($id,$data);
        if($result){
            $this->success('恭喜您，修改成功！');
        }else{
            $this->error('一边玩去<br>');
        }
    }
    //显示关注
    public function setfocus()
    {   
        $focus = new focus;
        $name = session('user')['username'];
        // 
        $result = $focus->selectFocus($name);
        $this->assign('result',$result);
        $this->assign('name',$name);
        return $this->fetch();
    }
    //处理我的关注
     public function doFocus()
    {   
        $focus = new focus;
        $data['f_house_id'] = $_REQUEST['id'];
        $data['f_username'] = $_REQUEST['name'];
        
        $result = $focus ->insertFocus($data);
        if($result){
            echo json_encode(array('status'=>1,'msg'=>'修改成功','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'修改失败','data'=>[]));die();
        }
    }
    //取消关注
     public function delFocus()
    {   
        $focus = new focus;
        $name = $_REQUEST['name'];
        $house = $_REQUEST['house'];
        $result = $focus ->deleteFocus($name,$house);
        if($result){
            echo json_encode(array('status'=>1,'msg'=>'成功取消','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'取消失败','data'=>[]));die();
        }
        
    }
    //显示修改密码
    public function setpassword()
    {
        return $this->fetch();
    }
     //修改密码
    public function doPassword()
    {   
        $user = new User;
        $id = session('user')['id'];
        $data['password'] = md5($_REQUEST['newpass']);
        $result = $user ->doUpdate($id,$data);
        if($result){
            echo json_encode(array('status'=>1,'msg'=>'修改成功','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'修改失败','data'=>[]));die();
        }
    }
    //检查密码是否正确
     public function check()
    {
        $password = new User;
        $pa = $password->doPa();
        if(md5($_REQUEST['password']) != $pa['password']) {
            echo json_encode(array('status'=>0,'msg'=>'请输入正确密码','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>1,'msg'=>'密码匹配成功','data'=>[]));die();
        }
    }
    //显示预约信息页面
    public function reserve()
    {   
        $request = Request::instance();
        $id = $request->param()['id'];
        $this->assign('id',$id);
        // dump($id);
        return $this->fetch();
    }
    //处理预约信息
    public function doReserve()
    {   

        $resever = new Reserve;
        $data['early_time'] = $_REQUEST['earlyTime'];
        $data['late_time'] = $_REQUEST['lateTime'];
        $data['person'] = $_REQUEST['person'];
        $data['r_phone'] = $_REQUEST['phone'];
        $data['house_id'] = $_REQUEST['hidden'];
        // dump($data);die;
        $result = $resever->insertResever($data);
        if ($result) {
            echo json_encode(array('status'=>1,'msg'=>'提交成功','data'=>[]));die();
        }else{
            echo json_encode(array('status'=>0,'msg'=>'提交失败','data'=>[]));die();
        }
    }
    //邮箱
    // public function con()
    // {
    //     $subject="This is my house";
        
    //     $email="627894695@qq.com";
    //     // $email="718041217@qq.com";

    //     $con = '<style class="fox_global_style"> div.fox_html_content { line-height: 1.5;} /* 一些默认样式 */ blockquote { margin-Top: 0px; margin-Bottom: 0px; margin-Left: 0.5em } ol, ul { margin-Top: 0px; margin-Bottom: 0px; list-style-position: inside; } p { margin-Top: 0px; margin-Bottom: 0px } </style><table style="-webkit-font-smoothing: antialiased;font-family:"微软雅黑", "Helvetica Neue", sans-serif, SimHei;padding:35px 50px;margin: 25px auto; background:rgb(247,246, 242); border-radius:5px" border="0" cellspacing="0" cellpadding="0" width="640" align="center"> <tbody> <tr> <td style="color:#000;"> </td> </tr> <tr><td style="padding:0 20px"><hr style="border:none;border-top:1px solid #ccc;"></td></tr> <tr> <td style="padding: 20px 20px 20px 20px;"> Hi 你好 </td> </tr> <tr> <td valign="middle" style="line-height:24px;padding: 15px 20px;"> 感谢您注册phpbryant <br> 请点击以下链接修改您的密码： </td> </tr> <tr> <td style="height: 50px;color: white;" valign="middle"> <div style="padding:10px 20px;border-radius:5px;background: rgb(64, 69, 77);margin-left:20px;margin-right:20px"> <a style="word-break:break-all;line-height:23px;color:white;font-size:15px;text-decoration:none;" href="http://wwwphpbryant.com">http://wwwphpbryant.com</a> </div> </td> </tr> <tr> <td style="padding: 20px 20px 20px 20px"> 请勿回复此邮件，如果有疑问，请联系我们：<a style="color:#5083c0;text-decoration:none" href="mailto:liuhao@phpbryant.com">liuhao@phpbryant.com
    // </a> </td> </tr><tr> <td style="padding: 20px 20px 20px 20px"> 交流群：000000 </td> </tr> <tr> <td style="padding: 20px 20px 20px 20px"> - phpbryant 团队-帮助你更快的完成项目- phpbryant.com </td> </tr> </tbody> </table>';
    // $status = send($email,$subject,$con);
    //     if($status){
    //         echo 'success';
    //     }else{
    //      echo 'error';
    //     }
    // }
}
