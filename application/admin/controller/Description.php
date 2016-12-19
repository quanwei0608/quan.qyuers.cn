<?php
namespace app\admin\controller;
use think\View;
use think\Controller;
use app\admin\model\Description;
use think\Session;
use think\Db;
use think\Request;
header('Access-Control-Allow-origin:*');
class Description extends Controller
{
	//解析二手房信息描述页面
	public function edescription()
	{
		return $this->fetch();
	}
	//对二手房进行更新描述
	public function doE()
	{
		$data = $_POST['note'];
		 $id = $_POST['id'];
		
		$dos = new Description;
		$updata = $dos->upEdescription($data,$id);
		// var_dump($updata);die;
		if ($updata) {
			$this->success('感谢您对本房源的评价','__SITE__/admin/house/exchange');
		}else{
			$this->success('评论失败');
		}
	}

	public function edescriptionx()
	{
		return $this->fetch();
	}



	//解析租房信息页面
	public function rdescription()
	{
		return $this->fetch();
	}

	public function doR()
	{
		$data = $_POST['note'];
		 $id = $_POST['id'];
		
		$dos = new Description;
		$updata = $dos->upRdescription($data,$id);
		// var_dump($updata);die;
		if ($updata) {
			$this->success('感谢您对本房源的评价','__SITE__/admin/house/rent');
		}else{
			$this->success('评论失败');
		}
	}
}