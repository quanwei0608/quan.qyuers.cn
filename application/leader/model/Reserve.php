<?php
namespace app\leader\model;
use think\Model;
use think\Db;
//软删除
use traits\model\SoftDelete;
class Reserve extends Model
{
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