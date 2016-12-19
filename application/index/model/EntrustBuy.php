<?php
/**
 * 处理委托信息控制器
 */
namespace app\index\model;
use think\Model;
use think\Db;

class EntrustBuy extends Model
{
	//添加买房信息
	public function insertBuy($data = array())
	{
		return Db::name('entrust_buy')->insert($data);
	}
	
}