<?php
/**
 * 处理主页控制器
 */
namespace app\index\controller;
use think\View;
use think\Controller;
use think\Session;
class Index extends Controller
{	
	//显示主页
    public function index()
    {
        return $this->fetch();
    }
}
