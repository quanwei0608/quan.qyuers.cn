<?php
/**
 * 
 */
namespace app\leader\model;
use think\Model;
use think\Db;
//软删除
use traits\model\SoftDelete;
class Community extends Model
{
	//查询小区
	public function seelctController()
	{
		return Db::name('community')->where('id>0')->paginate(10);
	}
	//增加新小区
	public function insertCommunity($data = array())
	{
		return Db::table('home_community')->insert($data);
	}
	//删除经纪人
	public function delCommunity($data)
	{
		return Db::name('community')->where('id',$_POST['id'])->delete();
	
	}
}