<?php
/**
 * 处理小区信息模型
 */
namespace app\index\model;
use think\Model;
use think\Db;

class HouseCommunity extends Model
{
	/**
	 * 
	 */
	//查找小区
	public function findCommunity()
	{
		return Db::name('community')->where('id>0')->select();
	}
	
	//查找小区信息
	public function findCommunityMsg($num)
	{
		return Db::table('home_community')->alias('c')
		->join('home_broker b', 'c.community_s_loc = b.s_location AND c.community_id = \''.$num.'\'')
		->join('home_company y','b.com_num = y.company_id')
		->select();
	}
	//查找小区内二手房数量
	public function findExchangeNum($num)
	{
		return Db::query('select count(home_exchange.e_number) as num from home_exchange where home_exchange.e_community_num = \''.$num.'\' ');
	}
	//查找小区内租房数量
	public function findRentNum($num)
	{
		return Db::query('select count(home_rent.r_number) as num from home_rent where home_rent.r_community_num = \''.$num.'\' ');
	}
}