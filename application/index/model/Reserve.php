<?php
/**
 * 处理预约信息模型
 */
namespace app\index\model;
use think\Model;
use think\Db;
class Reserve extends Model
{
	public function insertResever($data)
	{
		return Db::name('reserve')->insert($data);
	}
}