<?php
namespace app\admin\controller;
use think\View;
use think\Controller;
use app\admin\model\Entrust;
use think\Session;
use think\Db;
use think\Request;
header('Access-Control-Allow-origin:*');
class Entrust extends Controller
{
	//买房委托信息页面
	public function buy()
	{
		$buy = new Entrust;
		$selectb = $buy->buyHouse();
		// var_dump($selectb);die;
		$this->assign('selectb',$selectb);
		return $this->fetch();
	}

	//删除当前选中的信息
 	public function del()
 	{
 		$id = $_POST['id'];

 		if (empty($id)) {
 			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
 		}else{
 			$a = new Entrust;
 			$result = $a->Dbuy($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
 		}
 		
 	}

	//卖房委托信息页面
	public function sell()
	{
		$sell = new Entrust;
		$selects = $sell->sellHouse();
		$this->assign('selects',$selects);
		return $this->fetch(); 
	}
	//删除当前选中的信息
 	public function delSell()
 	{
 		$id = $_POST['id'];

 		if (empty($id)) {
 			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
 		}else{
 			$a = new Entrust;
 			$result = $a->Dsell($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
 		}
 		
 	}

	//委托出租信息页面
	public function hire()
	{
		$hire = new Entrust;
		$selecth = $hire->hireHouse();
		$this->assign('selecth',$selecth);
		return $this->fetch(); 
	}
	//删除当前选中的信息
 	public function delh()
 	{
 		$id = $_POST['id'];

 		if (empty($id)) {
 			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
 		}else{
 			$a = new Entrust;
 			$result = $a->DHire($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
 		}
 		
 	}


	//委托租房信息页面
	public function rent()
	{
		$rent = new Entrust;
		$selectr = $rent->rentHouse();
		$this->assign('selectr',$selectr);
		return $this->fetch(); 
	}
	//删除当前选中的信息
 	public function delRent()
 	{
 		$id = $_POST['id'];

 		if (empty($id)) {
 			echo json_encode(array('status'=>0,'msg'=>'请选择需要删除的','data'=>[]));die();
 		}else{
 			$a = new Entrust;
 			$result = $a->DRent($_POST['id']);
 			
 			if ($result) {
 				echo json_encode(array('status'=>1,'msg'=>'删除成功','data'=>[]));die();
 			}else{
 				echo json_encode(array('status'=>0,'msg'=>'删除失败','data'=>[]));die();
 			}
 		}
 		
 	}


}