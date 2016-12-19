<?php
namespace app\leader\model;
use think\Model;
use think\Db;
class Blogroll extends model
{
	//查询所有的友情链接
	public function selectLink()
	{
		return Db::name('link')->where('lid>0')->select();
	}
	//删除选定的友情链接
	public function delLinks($id)
	{
		return Db::table('home_link')->where('lid',$id)->delete();
	}
	//修改指定的友情链接
	public function upLinks($id,$data=array())
	{
		return Db::table('home_link')->where('lid',$id)->update($data);
	}
	//增加新的友情链接
	public function addLink($data = array())
	{
		return Db::name('link')->insert($data);
	}
}