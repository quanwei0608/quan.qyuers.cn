<?php
/**
 * 处理用户信息控制器
 */
namespace app\index\model;
use think\Model;
use think\Db;

class User extends Model
{
	//添加用户
	public function doAdd($data = array())
	{
		return Db::name('user')->insert($data);
	}
	//查找用户名
	public function nameCheck($username)
	{
		return Db::name('user')->where('username',$username)->find();
	}
	//查找手机号
	public function phoneCheck($phone)
	{
		return Db::name('user')->where('phone',$phone)->find();
	}
	//查找用户
	public function doFind($data = array())
	{
		return Db::name('user')->where('username=\''.$data['username'].'\' AND password=\''.$data['password'].'\' AND u_lock = 0')->find();
		
	}
	//跟新真实姓名和性别
	public function doUpdate($a,$data = array())
	{
		return Db::table('home_user')
		->where('id',  $a)
		->update($data);
	}
	//进行比对
	public function doPa() 
	{
		return Db::name('user')->where('username',session('user')['username'])->find();
	}
}
