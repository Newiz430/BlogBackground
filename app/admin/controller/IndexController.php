<?php
// /app/admin/controller/IndexController.php

namespace admin\controller;
use \core\Controller; 

//后台首页
class IndexController extends Controller{
	//进入首页
	public function index(){
		$u = new \admin\model\UserModel();
		$counts = $u -> getCounts(); //获取网站的用户数量
		@session_start(); //开启session会话，为确保安全性添加错误抑制
		$this -> assign("counts", $counts);
		$this -> display("index.html");
	}
}