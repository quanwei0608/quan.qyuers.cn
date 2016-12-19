<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Description extends Model
{
	//对二手房进行描述更新
	public function upEdescription($data,$id)
	{
		return Db::table('home_description')->where('house_id', '=', $id)->setField('house_description',$data);
	}

	//对出租房进行描述更新
	public function upRdescription($data,$id)
	{
		return Db::table('home_description')->where('house_id', '=', $id)->setField('house_description',$data);
	}
}