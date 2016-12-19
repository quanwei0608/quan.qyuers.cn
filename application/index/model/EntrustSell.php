<?php
/**
 * 处理委托信息控制器
 */
namespace app\index\model;
use think\Model;
use think\Db;

class EntrustSell extends Model
{
	//添加卖房信息
	public function insertSell($data = array())
	{
		return Db::name('entrust_sell')->insert($data);
	}

}
