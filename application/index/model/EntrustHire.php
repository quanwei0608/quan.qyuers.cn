<?php
/**
 * 处理委托信息控制器
 */
namespace app\index\model;
use think\Model;
use think\Db;

class EntrustHire extends Model
{
	//添加出租信息
	public function insertHire($data = array())
	{
		return Db::name('entrust_hire')->insert($data);
	}

}