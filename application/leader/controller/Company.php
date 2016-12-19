<?php
namespace app\leader\controller;
use think\View;
use think\Controller;
use app\leader\model\Company;
use think\Session;
use think\Db;
use think\Request;
class Company extends Controller
{
	//获取所有门店
	public function company()
	{
		$men = new Company;
		$selects = $men->selCompany();
		$this->assign('selects',$selects);
		$count = count($selects);
		$this->assign('count',$count);
		return $this->fetch();
	}
	//增加门店
	public function upCompany()
	{
		if (empty($_POST['company_id'] && $_POST['company_name'])) {
			echo json_encode(array('status'=>0, 'msg'=>'请填写添加的内容','data'=>[]));die;
		}else{
			
			$data['company_id'] = $_POST['company_id'];
			$data['company_name'] = $_POST['company_name'];
			$add = new Company;
			$addLink = $add->addCompany($data);
			if ($addLink) {
				echo json_encode(array('status' => 1, 'msg'=>'增加成功','data'=>[]));die();
			}else{
				echo json_encode(array('status' => 0, 'msg'=>'操作失败，请重新操作','data'=>[]));die();
			}
		}
	}
	//删除门店
	public function delCompany()
	{
		$id = $_POST['id'];
		$links = new Company;
		$del = $links->delCompanys($id);
		if ($del) {
			echo json_encode(array('status' => 1,'msg' => '删除成功', 'data' => []));die();
		}else{
			echo json_enxode(array('status' => 0, 'msg' => '操作失败', 'data' => []));die();
		}
	}
}