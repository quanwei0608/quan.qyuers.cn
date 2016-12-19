<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Broker extends Model
{
	//更新经纪人信息
	public function upNew($data = array())
	{
		return Db::table('home_broker')->where('username',session('user')['username'])->update($data);
	}
	
	//更新头像
	public function upT($data)
	{
		return Db::table('home_broker')->where('username',session('user')['username'])->update($data);
	}
}