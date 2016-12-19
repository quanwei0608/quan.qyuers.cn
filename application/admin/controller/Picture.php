<?php
namespace app\admin\controller;
use think\View;
use think\Controller;
use app\admin\model\Picture;
use think\Session;
use think\Db;
use think\Request;
header('Access-Control-Allow-origin:*');
class Picture extends Controller
{
	//修改头像
	public function picture()
	{
		return $this->fetch();
	}

	public function doPicture()
	{
	// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('image');
	// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move('static/broker');
		$b = $info->getSaveName();

		$data = '__STATIC__/' . 'broker/' . $b;
		$a = new Picture;
		$upload = $a->upT($data);
		if($upload){
			$this->success('上传成功','__SITE__/admin/admin/picture');
		}else{
	// 上传失败获取错误信息
				// echo $file->getError();
			$this->error($file->getError(),'__SITE__/admin/admin/picture');
		}
	}
	
}
