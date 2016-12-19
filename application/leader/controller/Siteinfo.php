<?php
namespace app\leader\controller;
use think\View;
use think\Controller;
use think\Session;
use app\leader\model\Siteinfo;
use app\leader\model\Blogroll;
class Siteinfo extends Controller
{
	//查询站点所有信息
	public function siteinfo()
	{
		$info = new Siteinfo;
		$select = $info->selectInfo();

		$this->assign('select',$select);

		return $this->fetch();
	}
	//更改站点信息
	public function updateInfo()
	{
		//获取表单提交过来的信息更新到数据表
		$data['s_title'] = $_POST['s_title'];
		$data['s_domain'] = $_POST['s_domain'];
		$data['s_keyword'] = $_POST['s_keywords'];
		$data['s_describe'] = $_POST['s_describe'];
		$data['s_name'] = $_POST['s_name'];
		$data['s_phone'] = $_POST['s_phone'];
		$data['s_bottom'] = $_POST['s_bottom'];
		$data['s_type'] = $_POST['s_type'];
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('image');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move('static/broker');
		$bg = $info->getSaveName();
		$data['s_logo'] = '__STATIC__/' . 'broker/' . $bg;
		$sum = new Siteinfo;
		$updateInfo = $sum->updateInfos($data);
		if ($updateInfo) {
			$this->success('提交成功','__SITE__/leader/siteinfo/siteinfo');
		}else{
			$this->error('请重新提交');
		}
	}
	//友情链接
	public function blogroll()
	{
		$link = new Blogroll;
		$blogroll = $link->selectLink();
		// dump($blogroll);die;
		$this->assign('blogroll',$blogroll);
		return $this->fetch();
	}
	//删除友情链接
	public function delLink()
	{
		$id = $_POST['id'];
		$links = new Blogroll;
		$del = $links->delLinks($id);
		if ($del) {
			echo json_encode(array('status' => 1,'msg' => '删除成功', 'data' => []));die();
		}else{
			echo json_enxode(array('status' => 0, 'msg' => '操作失败', 'data' => []));die();
		}
	}
	//修改友情链接
	public function updateLink()
	{
		
		$data['dispalyorder'] = $_POST['dispalyorder'];
		$data['link_name'] = $_POST['link_name'];
		$data['address'] = $_POST['address'];
		$id = $_POST['id'];
		$links = new Blogroll;
		$update = $links->upLinks($id,$data);
		
		if ($update) {
			echo json_encode(array('status' => 1,'msg' => '修改成功', 'data' => []));die();
		}else{
			echo json_encode(array('status' => 0, 'msg' => '操作失败', 'data' => []));die();
		}
	}
	//增加友情链接
	public function addLinks()
	{
		if (empty($_POST['dispalyorder'] && $_POST['link_name'] && $_POST['link_name'])) {
			echo json_encode(array('status'=>0, 'msg'=>'请填写添加的内容','data'=>[]));die;
		}else{
			$data['dispalyorder'] = $_POST['dispalyorder'];
			$data['link_name'] = $_POST['link_name'];
			$data['address'] = $_POST['address'];
			$add = new Blogroll;
			$addLink = $add->addLink($data);
			if ($addLink) {
				echo json_encode(array('status' => 1, 'msg'=>'增加成功','data'=>[]));die();
			}else{
				echo json_encode(array('status' => 0, 'msg'=>'操作失败，请重新操作','data'=>[]));die();
			}
		}
		
	}
}