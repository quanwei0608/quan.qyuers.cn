<?php
/**
 * 处理经纪人信息模型
 */
namespace app\index\model;
use think\Model;
use think\Db;

class Broker extends Model
{
	//查找经纪人
	public function findBroker()
	{
		return Db::name('broker')->where('id>0')->select();
	}
	//查找经纪人数量
	public function findBrokerNum()
	{
		return 	Db::query('select count(id) as num from home_broker');
	}
	//查找地区经纪人
	public function findBrokerName($name)
	{
		return Db::name('broker')->where('b_location = \''.$name.'\'')->select();
	}
	//查找经纪人所掌握二手房信息
	public function findBrokerExchange($num)
	{
		return Db::table('home_broker')->alias('b')
		->join('home_company c','b.com_num = c.company_id AND b.number = \''.$num.'\'')
		->join('home_exchange e','e.e_s_location = b.s_location')
		->join('home_community co','e.e_community_num = co.community_id')
		->limit(6)
		->select();
	}
	//查找经纪人所掌握二手房个数
	public function findExchangeNum($num)
	{
		return Db::table('home_broker')->alias('b')
		->join('home_company c','b.com_num = c.company_id AND b.number = \''.$num.'\'')
		->join('home_exchange e','e.e_s_location = b.s_location')
		->join('home_community co','e.e_community_num = co.community_id')
		->count('e.e_title');
	}
	//查找经纪人所掌握租房信息
	public function findBrokerRent($num)
	{
		return Db::table('home_broker')->alias('b')
		->join('home_company c','b.com_num = c.company_id AND b.number = \''.$num.'\'')
		->join('home_rent r','r.r_s_location = b.s_location')
		->join('home_community co','r.r_community_num = co.community_id')
		->limit(6)
		->select();
	}
	//查找经纪人所掌握租房信息
	public function findRentNum($num)
	{
		return Db::table('home_broker')->alias('b')
		->join('home_company c','b.com_num = c.company_id AND b.number = \''.$num.'\'')
		->join('home_rent r','r.r_s_location = b.s_location')
		->join('home_community co','r.r_community_num = co.community_id')
		->count('r.r_title');
	}
	//查找小区	
	public function findCommunity($num)
	{
		return Db::table('home_broker')->alias('b')
		->join('home_community co','b.s_location = co.community_s_loc AND b.number = \''.$num.'\'')
		->limit(3)
		->select();
	}
}