<?php
/**
 * 处理出租房信息模型
 */
namespace app\index\model;
use think\Model;
use think\Db;

class HouseRent extends Model
{
	/**
	 * 
	 */
	//查找出租房
	public function findRent()
	{
	
		return Db::table('home_rent')->alias('r')
		->join('home_community c','r.r_community_num = c.community_id AND r.r_lock = 0')
		->paginate(7);
	}
	//查找地区出租
	public function findRentName($name)
	{	
		return Db::table('home_rent')->alias('r')
		->join('home_community c','r.r_community_num = c.community_id AND r.r_lock = 0 AND \''.$name.'\' IN (r.r_f_location,r.r_s_location)')
		->paginate(7);
	}
	//查找出租房信息
	public function findRentMsg($num)
	{
	
		return Db::table('home_rent')->alias('r')
		->join('home_company c','r.r_com_num = c.company_id AND r.r_number = \''.$num.'\'')
		->join('home_community a','r.r_community_num = a.community_id')
		->join('home_broker b','c.company_id = b.com_num')
		->select();
	}

}