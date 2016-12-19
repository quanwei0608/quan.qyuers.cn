<?php
/**
 * 处理委托信息控制器
 */
namespace app\index\model;
use think\Model;
use think\Db;

class EntrustRent extends Model
{
	//添加租房信息
	public function insertRent($data = array())
	{
		return Db::name('entrust_rent')->insert($data);
	}	
}