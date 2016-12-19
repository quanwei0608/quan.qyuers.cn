<?php
/**
 * 处理图片信息模型
 */
namespace app\index\model;
use think\Model;
use think\Db;
class Picture extends Model
{
	//查找二手房图片
	public function findExchangePic($num)
	{
		return Db::name('picture')->where('h_id',$num)->select();
	}
	//只查找五张二手房图片
	public function findExchangePicFive($num)
	{
		return Db::name('picture')->where('h_id',$num)->limit(5)->select();
	}
	//查找二手房图片个数
	public function findExchangePicNum($num)
	{
		return 	Db::query('select count(h_picture) as num from home_picture where h_id = \''.$num.'\'');
	}
	//查找租房图片
	public function findRentPic($num)
	{
		return Db::name('picture')->where('h_id',$num)->select();
	}
	//只查找五张租房房图片
	public function findRentPicFive($num)
	{
		return Db::name('picture')->where('h_id',$num)->limit(5)->select();
	}
	//查找租房图片个数
	public function findRentPicNum($num)
	{
		return 	Db::query('select count(h_picture) as num from home_picture where h_id = \''.$num.'\'');
	}
}