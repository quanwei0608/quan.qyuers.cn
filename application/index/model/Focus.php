<?php
/**
 * 处理预约信息模型
 */
namespace app\index\model;
use think\Model;
use think\Db;
class Focus extends Model
{	
	//添加关注
	public function insertFocus($data)
	{
		return Db::name('focus')->insert($data);
	}
	//查找关注
	public function selectFocus($name)
	{
		return Db::table('home_exchange')->alias('e')
		->join('home_focus f','f_username = \''.$name.'\' AND f_house_id = e.e_number AND f.yes = 1')
		->join('home_community c','e.e_community_num = c.community_id AND e.e_lock = 0')
		->paginate(3);
	}
	//取消关注
	public function deleteFocus($name,$house)
	{
		return Db::table('home_focus')
		->where('f_username',$name)
		->where('f_house_id',$house)
		->update(['yes' => '0']);
	}
}