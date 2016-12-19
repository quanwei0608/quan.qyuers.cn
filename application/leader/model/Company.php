<?php
namespace app\leader\model;
use think\Model;
use think\Db;
class Company extends model
{
	//查询所有门店
	public function selCompany()
	{
		return Db::name('company')->where('id>0')->select();
	}
	//增加新的门店
	public function addCompany($data = array())
	{
		return Db::name('company')->insert($data);
	}
	//删除选定门店
	public function delCompanys($id)
	{
		return Db::table('home_company')->where('id',$id)->delete();
	}
}