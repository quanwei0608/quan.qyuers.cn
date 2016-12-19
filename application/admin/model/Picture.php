<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Picture extends Model
{
	
	//更新头像
	public function upT($data)
	{
		return Db::table('home_broker')->where('username',session('user')['username'])->setField('picture',$data);
	}
}