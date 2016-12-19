<?php
namespace app\leader\Model;
use think\Model;
use think\Db;
class User extends Model
{
	//查询用户信息
	public function selectUser()
	{
		return Db::name('user')->where('id>0')->paginate(5);
	}
	//查询数量
	public function userCount()
	{
		return Db::table('home_user')->count();
	}
	
	//删除用户信息
	public function userDel($id)
	{
		
		return Db::name('user')->where('id',$id)->delete();
	}
	//锁定用户
	public function lockUser($id)
	{	
		return Db::table('home_user')->where('id',$id)->update(['u_lock' => 1]);
	}
	//解锁用户
	public function openUser($id)
	{	
		return Db::table('home_user')->where('id',$id)->update(['u_lock' => 0]);
	}
}