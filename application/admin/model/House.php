<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class House extends Model
{
	//查询二手房信息
	public function doExchange($data)
	{


		//需要所有二手房的信息以及房评价
		return Db::table('home_exchange')->alias('e')
		->join('home_broker b', ' b.number = \''.$data.'\'')
		->join('home_description d','d.house_id = e.e_number')
		->paginate(5);

		// return Db::table('home_description')->alias('d')
		// //经纪人编号等于房评里经纪人的编号
		// ->join('home_broker b', ' b.number = \''.$data.'\'')
		// //房评里房子编号与房子编号相等
		// ->join('home_exchange e', 'e.e_number=d.house_id')
		// ->paginate(5);
	}

	//查询租房信息
	public function doRent()
	{
		return Db::table('home_rent')->where('id>0')->paginate(5);
	}
	//最新插入房子的编号
	public function desZj()
	{
		return Db::name('exchange')->where('id>0')->order('id','desc')->find();
	}
	//插入最新评论
	public function descript($data = array())
	{

		return Db::name('description')->insert($data);
	}
}