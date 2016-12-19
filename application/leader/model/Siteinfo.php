<?php
namespace app\leader\model;
use think\Model;
use think\Db;
class Siteinfo extends Model
{
	//查询站点信息
	public function selectInfo()
	{
		return Db::name('siteinfo')->where('id>0')->select();
	}
	//更新站点信息
	public function updateInfos($data=array())
	{
	
		return Db::table('home_siteinfo')->where('id',1)->update($data);
	}
	
}