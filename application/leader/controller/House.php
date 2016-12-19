<?php
namespace app\leader\controller;
use think\View;
use think\Controller;
use app\leader\model\House;
use think\Session;
use think\Db;
use think\Request;
header('Access-Control-Allow-origin:*');
class House extends Controller
{
	//获取所有二手房信息
	public function exchange()
	{
		$keywords = input('keywords');
		
		
		if ($keywords) {
			$key = new House;
			$selecte = $key->sousuo($keywords);
			$this->assign('selecte',$selecte);
			$counts = $key->countExchanges($keywords);
			$count = count($counts);
			$this->assign('count',$count);
			return $this->fetch();
		}else{
		$exchange = new House;
		$selecte = $exchange->doExchange();
		$this->assign('selecte',$selecte);
		$count = $exchange->countExchange();
		$this->assign('count',$count);
		return $this->fetch();
		}
		
	}
	
	//增加房源信息页面解析
	public function addexchange()
	{
		$adex = new House;
		$seex = $adex->bigid();
		$this->assign('seex',$seex);
		return $this->fetch();
	}
	//增加房源信息
	public function addhouse()
	{
		$data['e_number'] = $_POST['e_number'];
		$data['e_title'] = $_POST['e_title'];
		$data['e_f_location'] = $_POST['e_f_location'];
		$data['e_s_location'] = $_POST['e_s_location'];
		$data['e_community_num'] = $_POST['e_community_num'];
		$data['e_type'] = $_POST['e_type'];
		$data['e_area'] = $_POST['e_area'];
		$data['e_floor'] = $_POST['e_floor'];
		$data['e_price'] = $_POST['e_price'];
		$data['e_unit'] = $_POST['e_unit'];
		$data['e_orientation'] = $_POST['e_orientation'];
		$data['e_year'] = $_POST['e_year'];
		$data['e_com_num'] = $_POST['e_com_num'];
		

		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('e_picture');


		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move('static/house');
		$b = $info->getSaveName();

		$data['e_picture'] = '__STATIC__/' . 'house/' . $b;
		
		$adde = new House;
		$inserthoust = $adde->insertExchange($data);
		if ($inserthoust) {
			$this->success('成功增加新房源','__SITE__/leader/house/exchange');
		}else{
			$this->error('增加失败');
		}
	}
	//删除已经成交的房子
	public function delExchange()
	{
		$id = $_POST['id'];
		if (empty($id)) {
			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
		}else{
			$del = new House;
 			$result = $del->delExchange($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
		}
	}
	//更新房子信息页面解析
	public function updataexchange()
	{
		$id = $_GET['id'];
		$ex = new House;
		$title = $ex->selectEx($_GET['id']);
		$this->assign('title',$title);
		return $this->fetch();
	}


	// 修改二手房信息
	public function updataex()
	{
		$id = $_POST['id'];
		$data['e_title'] = $_POST['e_title'];
		$data['e_price'] = $_POST['e_price'];
		$data['e_unit'] = $_POST['e_unit'];
		$upex = new House;
		$updaex  = $upex->upExchange($id,$data);
		if ($updaex) {
			$this->success('更改成功','__SITE__/leader/house/exchange');
		}else{
			$this->error('更改失败');
		}
	}
	//上传二手房子照片页面解析
	public function exchangepicture()
	{
		return $this->fetch();
	}
	//批量上传房子照片
	public function uploadExchange()
	{
				
		// 获取表单上传文件
		$files = request()->file('image');
		foreach($files as $file){
		// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move('static/house');
			$b = $info->getSaveName();
			$data['path'] = '__STATIC__/' . 'house/' . $b;

			$data['h_id'] = $_POST['id'];
		
			$inserte = new House;
			$numexchange = $inserte->numexchanges($data);
			if($numexchange){
				$this->success('上传成功','__SITE__/leader/house/exchange');
			}else{
				$this->error('上传失败');
			}
		}
	}
	//对客户预定的房子进行锁定
	public function lockExchange()
	{
		$id = $_GET['id'];
		$lock = new House;
		$lockexchange = $lock->exchangeLock($id);
		if ($lockexchange) {
			$this->success('成功锁定','__SITE__/leader/house/exchange');
		}else{
			$this->error('锁定失败，请重新操作');
		}
	}
	//对客户预定的房子进行解锁
	public function openExchange()
	{
		$id = $_GET['id'];
		$openr = new House;
		$openRent = $openr->exchangeOpen($id);
		if ($openRent) {
			$this->success('成功解锁','__SITE__/leader/house/exchange');
		}else{
			$this->error('解锁失败，请重新操作');
		}
	}


	//获取所有租房信息
	public function rent()
	{
		$keywords = input('keywords');
		if ($keywords) {
			$key = new House;
			$selectr = $key->sourent($keywords);
			$this->assign('selectr',$selectr);
			$count = $key->conutRents($keywords);
			$counts = count($count);
			$this->assign('counts',$counts);
			return $this->fetch();
		}else{
			$rent = new House;
			$selectr = $rent->doRent();
			$this->assign('selectr',$selectr);
			$counts = $rent->conutRent();
			$this->assign('counts',$counts);
			return $this->fetch();
		}
		
	}
	//增加租房房源页面解析
	public function addrent()
	{
		$adex = new House;
		$sere = $adex->bigrid();
		$this->assign('sere',$sere);
		return $this->fetch();
	}
	//增加出租房源信息
	public function addhouser()
	{
		$data['r_number'] = $_POST['r_number'];
		$data['r_title'] = $_POST['r_title'];
		$data['r_f_location'] = $_POST['r_f_location'];
		$data['r_s_location'] = $_POST['r_s_location'];
		$data['r_community_num'] = $_POST['r_community_num'];
		$data['r_type'] = $_POST['r_type'];
		$data['r_area'] = $_POST['r_area'];
		$data['r_floor'] = $_POST['r_floor'];
		$data['r_price'] = $_POST['r_price'];
		
		$data['r_orientation'] = $_POST['r_orientation'];
		$data['r_year'] = $_POST['r_year'];
		$data['r_fitment'] = $_POST['r_fitment'];
		$data['r_com_num'] = $_POST['r_com_num'];

		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('r_picture');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move('static/house');
		$b = $info->getSaveName();
		$data['r_picture'] = '__STATIC__/' . 'house/' . $b;	
		$adde = new House;
		$inserthoust = $adde->insertRent($data);
		if ($inserthoust) {
			$this->success('成功增加新房源','__SITE__/leader/house/rent');
		}else{
			$this->error('增加失败');
		}
	}

	//更新房子信息页面解析
	public function updatarent()
	{
		$id = $_GET['id'];

		$ex = new House;
		$title = $ex->selectRe($_GET['id']);
		$this->assign('title',$title);
		return $this->fetch();
	}


	// 修改出租房信息
	public function updatare()
	{
		$id = $_POST['id'];
		$data['r_title'] = $_POST['r_title'];
		$data['r_price'] = $_POST['r_price'];
		$upre = new House;
		$updare  = $upre->upRent($id,$data);
		if ($updare) {
			$this->success('更改成功','__SITE__/leader/house/rent');
		}else{
			$this->error('更改失败');
		}
	}

	//删除已经出租的房子
	public function delRent()
	{
		$id = $_POST['id'];
		if (empty($id)) {
			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
		}else{
			$del = new House;
 			$result = $del->delRent($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
		}
	}

	//上传出租房子照片页面解析
	public function rentpicture()
	{
		return $this->fetch();
	}
	//批量上传房子照片
	public function uploadRent()
	{
				
		// 获取表单上传文件
		$files = request()->file('image');
		foreach($files as $file){
		// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move('static/house');
			$b = $info->getSaveName();
			$data['path'] = '__STATIC__/' . 'house/' . $b;
			$data['h_id'] = $_POST['id'];
			$inserte = new House;
			$numexchange = $inserte->numexchanges($data);
			if($numexchange){
				$this->success('上传成功','__SITE__/leader/house/exchange');
			}else{
				$this->error('上传失败');
			}
		}
	}
	//对客户预定的房子进行锁定
	public function lockRent()
	{
		$id = $_GET['id'];
		$lock = new House;
		$lockrent = $lock->rentLock($id);
		if ($lockrent) {
			$this->success('成功锁定','__SITE__/leader/house/rent');
		}else{
			$this->error('锁定失败，请重新操作');
		}
	}
	//对客户预定的房子进行解锁
	public function openRent()
	{
		$id = $_GET['id'];
		$openr = new House;
		$openRent = $openr->rentOpen($id);
		if ($openRent) {
			$this->success('成功解锁','__SITE__/leader/house/rent');
		}else{
			$this->error('解锁失败，请重新操作');
		}
	}
}