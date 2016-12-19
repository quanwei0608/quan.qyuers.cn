<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Entrust extends Model
{
	//查询委托买房信息
	public function buyHouse()
	{
		return Db::table('home_entrust_buy')->where('id>0')->paginate(5);
	}
	//删除当前选中的预约信息
	public function Dbuy($data)
	{
		return Db::name('entrust_buy')->where('id',$data)->delete();
	}

	//查询委托卖房信息
	public function sellHouse()
	{
		return Db::table('home_entrust_sell')->where('id>0')->paginate(5);
	}
	//删除当前选中的预约信息
	public function Dsell($data)
	{
		return Db::name('entrust_sell')->where('id',$data)->delete();
	}


	//查询委托出租房屋信息
	public function hireHouse()
	{
		return Db::table('home_entrust_hire')->where('id>0')->paginate(5);
	}
	//删除当前选中的预约信息
	public function DHire($data)
	{
		return Db::name('entrust_hire')->where('id',$data)->delete();
	}

	//查询委托租房信息
	public function rentHouse()
	{
		return Db::table('home_entrust_rent')->where('id>0')->paginate(5);
	}
	//删除当前选中的预约信息
	public function DRent($data)
	{
		return Db::name('entrust_rent')->where('id',$data)->delete();
	}
}