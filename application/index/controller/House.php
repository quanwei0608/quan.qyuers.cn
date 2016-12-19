<?php
/**
 * 处理二手房控制器
 */
namespace app\index\controller;
use think\View;
use think\Controller;
use app\index\model\HouseExchange;
use app\index\model\HouseRent;
use app\index\model\HouseCommunity;
use app\index\model\Picture;
use think\Request;
use think\Session;
class House extends Controller
{
	// 二手房
	public function exchange()
	{	
		$exchange = new HouseExchange;
		$request = Request::instance();
		$param = $request->param();
		

		if (array_key_exists('name', $request->param())) {
			$name = $request->param()['name'];
			$this->assign('name',$name);
			
			$msg = $exchange->findExchangeName($name);
			$this->assign('msg',$msg);

			if (array_key_exists('price', $request->param())) {
			$price = $request->param()['price'];
			$this->assign('price',$price);
			if ($price == 'p1') {
				$price = 350;
				
				$msg = $exchange->findExchangePrice1($price,$name);
				
				$this->assign('msg',$msg);
			}
			if ($price == 'p2') {
				$price1 = 350;
				$price2 = 450;
				$msg = $exchange->findExchangePrice2($price1,$price2,$name);
				$this->assign('msg',$msg);

			}
			if ($price == 'p3') {
				$price = 450;
				$msg = $exchange->findExchangePrice3($price,$name);
				$this->assign('msg',$msg);
			}
			};
		};
		
		
		$result = $exchange ->findExchange();
		
		$this->assign('result',$result);
		$page = $result->render();
		$this->assign('page',$page);
		 return $this->fetch();
		
	
	}
	// 二手房
	public function exchangeBig()
	{	
		$exchange = new HouseExchange;
	
		$result = $exchange ->findExchangeBig();
	
		$this->assign('result',$result);
		$page = $result->render();
		$this->assign('page',$page);
		 return $this->fetch();
	}
	// 二手房
	public function exchangeSmall()
	{	
		$exchange = new HouseExchange;
	
		$result = $exchange ->findExchangeSmall();
	
		$this->assign('result',$result);
		$page = $result->render();
		$this->assign('page',$page);
		 return $this->fetch();
	}
	//二手房信息
	public function exchangeMsg()
	{	
		$exchange = new HouseExchange;
		$picExchange = new Picture;
		$request = Request::instance();
		$id = $request->param()['id'];
		//查找二手房信息
		$res = $exchange->findExchangeMsg($id);
		$this->assign('res',$res);

		$result = $res[0];
		$this->assign('v',$result);

		//查找二手房图片
		$pic = $picExchange->findExchangePic($id);
		$this->assign('pic',$pic);
		//查找二手房图片5张
		$picFive = $picExchange->findExchangePicFive($id);
		$this->assign('picFive',$picFive);
		//查找二手房图片个数
		$picNum = $picExchange ->findExchangePicNum($id);

		$name = session('user')['username'];
		$this->assign('num',$picNum[0]);
		$this->assign('id',$id);
		$this->assign('name',$name);
		
		
		return $this->fetch();
	}
	// 租房
	public function rent()
	{
		$rent = new HouseRent;
		$request = Request::instance();
		if (array_key_exists('name', $request->param())) {
			$name = $request->param()['name'];
			$this->assign('name',$name);
			$msg = $rent->findRentName($name);
			$this->assign('msg',$msg);
		};
		$result = $rent ->findRent();
		$this->assign('result',$result);

		$page = $result->render();
		$this->assign('page',$page);
		return $this->fetch();
	}
	//租房信息
	public function rentMsg()
	{	
		$rent = new HouseRent;
		$picRent = new Picture;
		$request = Request::instance();
		$id = $request->param()['id'];
		//查找租房信息
		$res = $rent->findRentMsg($id);
		$this->assign('res',$res);

		$result = $res[0];
		$this->assign('v',$result); 
		//查找租房图片
		$pic = $picRent->findRentPic($id);
		$this->assign('pic',$pic);
		//查找租房图片5张
		$picFive = $picRent->findRentPicFive($id);
		$this->assign('picFive',$picFive);
		//查找租房图片个数
		$picNum = $picRent ->findRentPicNum($id);
		$this->assign('num',$picNum[0]);
		return $this->fetch();
	}
	//小区
	public function community()
	{	
		$community = new HouseCommunity;
		$result = $community->findCommunity();
		
		$this->assign('result',$result);
		return $this->fetch();
	}
	//小区信息
	public function communityMsg()
	{
		$community = new HouseCommunity;
		$request = Request::instance();
		$id = $request->param()['id']; 
		$res = $community->findCommunityMsg($id);
		$this->assign('res',$res);
		// 查找二手房数量
		$exchangeNumber = $community->findExchangeNum($id);
		$exchangeNum = $exchangeNumber[0];
		$this->assign('exchangeNum',$exchangeNum);
		// 查找租房数量
		$rentNumber = $community->findRentNum($id);
		$rentNum = $rentNumber[0];
		$this->assign('rentNum',$rentNum);

		$result = $res[0];
		$this->assign('v',$result);
		
		return $this->fetch();
	}
	public function doSearch()
	{

	}
}