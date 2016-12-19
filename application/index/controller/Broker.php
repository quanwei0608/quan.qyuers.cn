<?php
/**
 * 处理经纪人信息控制器
 */
namespace app\index\controller;
use think\View;
use think\Controller;
use app\index\model\Broker;
use think\Request;
class Broker extends Controller
{
	// 经纪人
	public function broker()
	{	
		$broker = new Broker;
		$result = $broker ->findBroker();
		$request = Request::instance();
		if (array_key_exists('name', $request->param())) {
			$name = $request->param()['name'];
			$this->assign('name',$name);
			$msg = $broker->findBrokerName($name);
			$this->assign('msg',$msg);
		};
		$this->assign('result',$result);
		$number = $broker ->findBrokerNum();
		$num = $number[0];
		$this->assign('num',$num);
		return $this->fetch();
	}
	//经纪人店铺
	public function brokerMsg()
	{	
		$broker = new Broker;
		$request = Request::instance();
		$id = $request->param()['id'];
		//主页二手房显示
		$exchange = $broker->findBrokerExchange($id);
		$this->assign('exchange',$exchange);
		$res = $exchange[0];
		$this->assign('res',$res);
		//查找经纪人负责小区
		$community = $broker->findCommunity($id);
		$this->assign('community',$community);
		//所掌握二手房数量
		$exNum= $broker->findExchangeNum($id);
		$this->assign('exNum',$exNum);
		//所掌握租房数量
		$reNum= $broker->findRentNum($id);
		$this->assign('reNum',$reNum);
		//主页租房显示
		$rent = $broker -> findBrokerRent($id);
		$this ->assign('rent',$rent);
		// dump($rent);die;
		
		return $this->fetch();
	}
	//经纪人掌握二手房信息
	public function brokerExchange()
	{	
		$broker = new Broker;
		$request = Request::instance();
		$id = $request->param()['id'];
		//主页二手房显示
		$exchange = $broker->findBrokerExchange($id);
		$this->assign('exchange',$exchange);
		$res = $exchange[0];
		$this->assign('res',$res);
		//所负责小区
		$community = $broker->findCommunity($id);
		$this->assign('community',$community);
		//所掌握二手房数量
		$exNum= $broker->findExchangeNum($id);
		$this->assign('exNum',$exNum);
		//所掌握租房数量
		$reNum= $broker->findRentNum($id);
		$this->assign('reNum',$reNum);
		
		return $this->fetch();
	}
	//经纪人掌握租房信息
	public function brokerRent()
	{	
		$broker = new Broker;
		$request = Request::instance();
		$id = $request->param()['id'];
		//主页二手房显示
		$exchange = $broker->findBrokerExchange($id);
		$this->assign('exchange',$exchange);
		$res = $exchange[0];
		$this->assign('res',$res);
		//所负责小区
		$community = $broker->findCommunity($id);
		$this->assign('community',$community);
		//所掌握二手房数量
		$exNum= $broker->findExchangeNum($id);
		$this->assign('exNum',$exNum);
		//所掌握租房数量
		$reNum= $broker->findRentNum($id);
		$this->assign('reNum',$reNum);
		
		//主页租房显示
		$rent = $broker -> findBrokerRent($id);
		$this ->assign('rent',$rent);
		
		return $this->fetch();
	}
	
}