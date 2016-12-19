<?php
namespace app\leader\model;
use think\Model;
use think\Db;

class Broker extends Model
{
	//更新经纪人信息
	public function upNew($data = array())
	{
		return Db::table('home_admin')->where('username',session('user')['username'])->update($data);
	}
	
	//更新头像
	public function upT($data)
	{
		return Db::table('home_admin')->where('username',session('user')['username'])->update($data);
	}
	//查询经纪人是否存在
	public function doFind($data)
	{
		return Db::name('admin')->where('username',$data)->find();
	}

	//查询经纪人所有信息
	public function seleceBorker()
	{
		return Db::table('home_company')->alias('c')
		->join('home_broker b','c.company_id = b.com_num')
		->paginate(5);
	}
	public function conutBroker()
	{
		return Db::table('home_broker')->count();
	}
	//注册经纪人账号
	public function doregister($data = array())
	{
		return Db::name('broker')->insert($data);
	}

	//删除经纪人
	public function delBroker($data)
	{
		return Db::name('broker')->where('id',$_POST['id'])->delete();
	
	}

	//查询
	public function seleceBorkers()
	{
		return Db::name('broker')->where('number',$_GET['id'])->select();
	}
	//更新经纪人工作年限
	public function changeBroker($data=array(),$id)
	{
		return Db::table('home_broker')->where('number', '=', $id)->update($data);
	}
}