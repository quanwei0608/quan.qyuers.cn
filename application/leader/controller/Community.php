<?php
namespace app\leader\controller;
use think\View;
use think\Controller;
use app\leader\model\Community;
use think\Session;
use think\Db;
use think\Request;
header('Access-Control-Allow-origin:*');
class Community extends Controller
{
	//查询小区
	public function community()
	{
		$xiaoqu = new Community;
		$selectc = $xiaoqu->seelctController();
		$this->assign('selectc',$selectc);
		return $this->fetch();
	}
	//删除小区
	public function del()
	{

		$id = $_POST['id'];

 		if (empty($id)) {
 			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
 		}else{
 			$del = new Community;
 			$result = $del->delCommunity($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
 		}
	}
	//增加新小区
	public function upCommunity()
	{
		$data['community_f_loc'] = $_POST['community_f_loc'];
		$data['community_s_loc'] = $_POST['community_s_loc'];
		$data['community_id'] = $_POST['community_id'];
		$data['community_name'] = $_POST['community_name'];
		$data['community_year'] = $_POST['community_year'];
		$data['community_unit'] = $_POST['community_unit'];

		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('picture');
		// dump($file);die;

		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move('static/house');
		$b = $info->getSaveName();

		$data['community_picture'] = '__STATIC__/' . 'house/' . $b;
		
		$addxq = new Community;
		$inserthoust = $addxq->insertCommunity($data);
		if ($inserthoust) {
			$this->success('成功增加新小区','__SITE__/leader/community/community');
		}else{
			$this->error('增加失败');
		}
	}
}