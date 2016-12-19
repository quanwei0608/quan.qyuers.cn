<?php
namespace app\leader\model;
use think\Model;
use think\Db;

class Description extends Model
{
	//对二手房进行描述更新
	public function upEdescription()
	{
		return Db::table()->where()->setField('house_description', )
	}
	
}