<?php
/**
 * 定义一个后台登录模型，对应后台管理员表
 */
namespace app\admin\model;
use think\Model;
use think\Db;
//软删除
use traits\model\SoftDelete;
class Admin extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';

	// 查找用户
	public function doFind($data)
	{
		
		return Db::name('broker')->where('username',$data)->find();
	
	}
	//查看注册邮箱
	public function seMail($data)
	{
		return Db::table('home_broker')->where('email',$data['email'])->find();
	}
	
	//修改密码
		//进行比对
	public function doPa() 
	{
		return Db::name('broker')->where('username',session('user')['username'])->find();
	}
		//更新密码
	public function updatePass($date = array())
	{
		return Db::table('home_broker')->where('username',session('user')['username'])->setField('password',$_POST['renewpass']);
	}

	//查询预约信息
	public function doReserve($key)
	{
		return Db::name('reserve')->alias('r')
		->join('home_exchange e', 'r.house_id = e.e_number')
		->join('home_broker b', 'b.s_location = e.e_s_location AND b.number = \''.$key.'\'')
		->paginate(10);
	}
	//删除当前选中的预约信息
	public function Dreserve($data)
	{
		return Db::name('reserve')->where('r_id',$data)->delete();
	}
	//循环选中的所有信息
	public function delAdmin($id)
	{
		$allId = $id;
		 foreach ($allId as $val) {
			Reserve::destroy($val,true);
		}
		
	}

}