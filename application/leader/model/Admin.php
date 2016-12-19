<?php
/**
 * 定义一个后台登录模型，对应后台管理员表
 */
namespace app\leader\model;
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
		
		return Db::name('admin')->where('username',$data)->find();
	
	}
	
	//修改密码
		//进行比对
	public function doPa() 
	{
		return Db::name('admin')->where('username',session('user')['username'])->find();
	}
		//更新密码
	public function updatePass($date = array())
	{
		return Db::table('home_admin')->where('username',session('user')['username'])->setField('password',$_POST['renewpass']);
	}

	//查询预约信息
	public function doReserve()
	{
		return Db::name('reserve')->where('id>0')->paginate(3);
	}
	//删除当前选中的预约信息
	public function Dreserve($data)
	{
		return Db('reserve')->where('id',$data)->delete();
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