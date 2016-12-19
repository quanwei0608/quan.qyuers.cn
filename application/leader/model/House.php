<?php
namespace app\leader\model;
use think\Model;
use think\Db;

class House extends Model
{
	//查询二手房信息
	public function doExchange()
	{

		return Db::table('home_exchange')->where('id>0')->paginate(5);

		// //需要所有二手房的信息以及房评价
		// return Db::table('home_exchange')->alias('e')
		// ->join('home_broker b', ' b.number = \''.$data.'\'')
		// ->join('home_description d','d.house_id = e.e_number')
		// ->paginate(5);

		// return Db::table('home_description')->alias('d')
		// //经纪人编号等于房评里经纪人的编号
		// ->join('home_broker b', ' b.number = \''.$data.'\'')
		// //房评里房子编号与房子编号相等
		// ->join('home_exchange e', 'e.e_number=d.house_id')
		// ->paginate(5);
	}
	//查询所有个数
	public function countExchange()
	{
		return  Db::table('home_exchange')->count();
	}
	//查询id最大的二手房
	public function bigid()
	{
		return Db::name('exchange')->where('id>0')->order('id','desc')->find();
	}
	//查询id最大的出租房
	public function bigrid()
	{
		return Db::name('rent')->where('id>0')->order('id','desc')->find();
	}
	//增加二手房信息
	public function insertExchange($data = array())
	{
		return Db::table('home_exchange')->insert($data);
	}
	//删除当前选中的二手房信息
	public function delExchange($data)
	{
		return Db::name('exchange')->where('id',$data)->delete();
	}
	//查询要更改的页面的内容
	public function selectEx()
	{
		return Db::name('exchange')->where('e_number',$_GET['id'])->select();
	}
	//更改二手房信息
	public function upExchange($id,$data = array())
	{
		return Db::table('home_exchange')->where('e_number',$id)->update($data);
	}
	//批量上传房子照片
	public function numexchanges($data=array())
	{
		$datas = [
			['h_picture' => $data['path'],'h_id' => $data['h_id']]
		
		];
		
		return Db::table('home_picture')->insertAll($datas);
	}
	//对客户预定的租房进行锁定
	public function exchangeLock($id)
	{
		return Db::name('exchange')->where('e_number',$id)->update(['e_lock' =>1]);
	}
	//对没有成交的租房进行解锁
	public function exchangeOpen($id)
	{
		return Db::name('exchange')->where('e_number',$id)->update(['e_lock' => 0]);
	}
	//搜索二手房
	public function sousuo($keywords)
	{
		return Db::name('exchange')->where('e_f_location', 'like', "%$keywords%")->paginate(5);
	}
	//显示当前搜索数量
	public function countExchanges($keywords)
	{
		return  Db::table('home_exchange')->where('e_f_location',$keywords)->select();
	}


	//搜索出租房
	public function sourent($keywords)
	{
		return Db::name('rent')->where('r_f_location', 'like', "%$keywords%")->paginate(5);
	}
	//当前显示搜索数量
	public function conutRents($keywords)
	{
		return  Db::table('home_rent')->where('r_f_location',$keywords)->select();
	}
	//查询租房信息
	public function doRent()
	{
		return Db::table('home_rent')->where('id>0')->paginate(5);
	}
	public function conutRent()
	{
		return Db::table('home_rent')->count();
	}

	//增加出租房信息
	public function insertRent($data = array())
	{
		return Db::table('home_rent')->insert($data);
	}
	//查询要更改的页面的内容
	public function selectRe()
	{
		return Db::name('rent')->where('r_number',$_GET['id'])->select();
	}
	//更改出租信息
	public function upRent($id,$data = array())
	{
		return Db::table('home_rent')->where('r_number',$id)->update($data);
	}
	//删除当前选中的出租房信息
	public function delRent($data)
	{
		return Db::name('rent')->where('id',$data)->delete();
	}
	//对客户预定的租房进行锁定
	public function rentLock($id)
	{
		return Db::name('rent')->where('r_number',$id)->update(['r_lock' =>1]);
	}
	//对没有成交的租房进行解锁
	public function rentOpen($id)
	{
		return Db::name('rent')->where('r_number',$id)->update(['r_lock' => 0]);
	}
}	