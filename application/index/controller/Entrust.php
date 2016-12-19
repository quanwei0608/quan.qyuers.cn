<?php
/**
 * 处理委托信息控制器
 */
namespace app\index\controller;
use think\View;
use think\Controller;
use app\index\model\EntrustSell;
use app\index\model\EntrustBuy;
use app\index\model\EntrustHire;
use app\index\model\EntrustRent;
class Entrust extends Controller
{
	// 委托信息
	public function entrust()
	{	
		return $this->fetch();
	}
	//卖房信息
	public function sell()
	{	
	
		return $this->fetch();
	}
	//处理卖房信息
	public function doSell()
	{	
		if($_POST == null){
			echo '不能提交空白信息';
		}
	
		$sell = new EntrustSell;
		$data['c_name'] = $_POST['SellEntrust']['conmmunityname'];
		
        $data['f_num'] = $_POST['SellEntrust']['louhao'];
        $data['u_num'] = $_POST['SellEntrust']['danyuanhao'];
        $data['r_num'] = $_POST['SellEntrust']['fanghao'];
        $data['area'] = $_POST['SellEntrust']['buildarea'];
        $data['price'] = $_POST['SellEntrust']['price'];
        $data['u_name'] = $_POST['SellEntrust']['ownername'];
        $data['phone'] = $_POST['SellEntrust']['ownertel'];
  		// dump($data);die;
        $result = $sell->insertSell($data);

        if($result){
            $this->success('提交成功！');
        }else{
            $this->error('一边玩去<br>');
        }
	}

	//买房信息
	public function buy()
	{
		return $this->fetch();
	}
	//处理买房信息
	public function doBuy()
	{	
		$buy = new EntrustBuy;
		$data['location'] = $_POST['BuyEntrust']['conmmunityname'];
        $data['room'] = $_POST['BuyEntrust']['bedroom1'];
        $data['hall'] = $_POST['BuyEntrust']['livingroom'];
        $data['first_price'] = $_POST['BuyEntrust']['firstprice'];
        $data['end_price'] = $_POST['BuyEntrust']['endprice'];
        $data['u_name'] = $_POST['BuyEntrust']['customername'];
        $data['phone'] = $_POST['BuyEntrust']['customertel'];
  		
  		// dump($data);die;
        $result = $buy->insertBuy($data);

        if($result){
            $this->success('提交成功！');
        }else{
            $this->error('一边玩去<br>');
        }
	}
	//出租信息
	public function hire()
	{
		return $this->fetch();
	}
	//处理出租信息
	public function doHire()
	{	
		$hire = new EntrustHire;
		$data['c_name'] = $_POST['RentEntrust']['conmmunityname'];
        $data['f_num'] = $_POST['RentEntrust']['louhao'];
        $data['u_num'] = $_POST['RentEntrust']['danyuanhao'];
        $data['r_num'] = $_POST['RentEntrust']['fanghao'];
        $data['area'] = $_POST['RentEntrust']['buildarea'];
        $data['price'] = $_POST['RentEntrust']['price'];
        $data['faclity'] = $_POST['RentEntrust']['faclity'];
        $data['u_name'] = $_POST['RentEntrust']['ownername'];
        $data['phone'] = $_POST['RentEntrust']['ownertel'];
  		
  		// dump($data);die;
        $result = $hire->insertHire($data);

        if($result){
            $this->success('提交成功！');
        }else{
            $this->error('一边玩去<br>');
        }
	}
	//租房信息
	public function rent()
	{
		return $this->fetch();
	}
	//处理租房信息
	public function doRent()
	{	
		$rent = new EntrustRent;
		$data['location'] = $_POST['SaleEntrust']['conmmunityname'];
        $data['room'] = $_POST['SaleEntrust']['bedroom1'];
        $data['hall'] = $_POST['SaleEntrust']['livingroom'];
        $data['first_price'] = $_POST['SaleEntrust']['firstprice'];
        $data['end_price'] = $_POST['SaleEntrust']['endprice'];
        $data['u_name'] = $_POST['SaleEntrust']['customername'];
        $data['phone'] = $_POST['SaleEntrust']['customertel'];
  		
  		// dump($data);die;
        $result = $rent->insertRent($data);

        if($result){
            $this->success('提交成功！');
        }else{
            $this->error('一边玩去<br>');
        }
    }
}
