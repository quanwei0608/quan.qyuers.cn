<?php
namespace app\admin\controller;
use think\View;
use think\Controller;
use app\admin\model\House;
use think\Session;
use think\Db;
use think\Request;
header('Access-Control-Allow-origin:*');
class House extends Controller
{
	//获取所有二手房信息
	public function exchange()
	{

		$data = session('user')['number'];
		$hou = new House;
		$select = $hou->doExchange($data);
		$this->assign('select',$select);
		$selects = $hou->desZj();
		// dump($selects);die;
		$this->assign('selects',$selects);
		return $this->fetch();
	}
	

	//获取所有租房信息
	public function rent()
	{
		$data = session('user')['number'];
		$ren = new House;
		$result = $ren->doRent();
		$this->assign('result',$result);
		return $this->fetch();
	}
	//插入最新注册房子的评价
	public function addExchan()
	{
		$data['d_broker_id'] = $_POST['d_broker_id'];
		$data['house_id'] = $_POST['house_id'];
		$data['house_description'] = $_POST['house_description'];
		$descri  = new House;
		$insert = $descri->descript($data);
		if ($insert) {
			$this->success('评论成功','__SITE__/admin/house/exchange');
		}else{
			$this->error('请重新评论');
		}
	}
}