<?php
/**
 * 处理二手房模型
 */
namespace app\index\model;
use think\Model;
use think\Db;



class HouseExchange extends Model
{
	
	//查找二手房
	public function findExchange()
	{
		return Db::table('home_exchange')->alias('e')
		->join('home_community c','e.e_community_num = c.community_id AND e.e_lock = 0')
		->paginate(5);
	}
	
	//查找价格从高到低
	public function findExchangeBig()
	{
		return Db::table('home_exchange')->alias('e')
		->join('home_community c','e.e_community_num = c.community_id AND e.e_lock = 0 order by e.e_price desc')
		->paginate(5);
	} 
	//查找价格从低到高
	public function findExchangeSmall()
	{
		return Db::table('home_exchange')->alias('e')
		->join('home_community c','e.e_community_num = c.community_id AND e.e_lock = 0 order by e.e_price asc')
		->paginate(5);
	} 
	//查找地区二手房
	public function findExchangeName($name)
	{	
		return Db::table('home_exchange')->alias('e')
		->join('home_community c','e.e_community_num = c.community_id AND \''.$name.'\' IN (e.e_f_location,e.e_s_location) AND e.e_lock = 0')
		->paginate(7);
	}
	//查找价格二手房
	public function findExchangePrice1($price,$name)
	{	
		return Db::table('home_exchange')->alias('e')
		->join('home_community c','e.e_community_num = c.community_id AND e.e_price <= \''.$price.'\' AND e.e_lock = 0 AND \''.$name.'\' IN (e.e_f_location,e.e_s_location)')
		->paginate(7);
	}
	public function findExchangePrice2($price1,$price2,$name)
	{	
		return Db::table('home_exchange')->alias('e')
		->join('home_community c','e.e_community_num = c.community_id AND \''.$price1.'\'< e.e_price AND e.e_price < \''.$price2.'\' AND e.e_lock = 0 AND \''.$name.'\' IN (e.e_f_location,e.e_s_location)')
		->paginate(7);
	}
	public function findExchangePrice3($price,$name)
	{	
		return Db::table('home_exchange')->alias('e')
		->join('home_community c','e.e_community_num = c.community_id AND e.e_price >= \''.$price.'\' AND e.e_lock = 0 AND \''.$name.'\' IN (e.e_f_location,e.e_s_location)')
		->paginate(7);
	}
	//查找二手房信息
	public function findExchangeMsg($num)
	{
		return Db::table('home_exchange')->alias('e')
		->join('home_company c','e.e_com_num = c.company_id AND e.e_number = \''.$num.'\'')
		->join('home_community a','e.e_community_num = a.community_id')
		->join('home_broker b','c.company_id = b.com_num')
		->join('home_description d','d.d_broker_id = b.number AND d.house_id = \''.$num.'\'')
		->select();
	}
}
