<?php
// /core/Controller.php

namespace core;

//公共控制器
class Controller{
	//初始化的构造方法
	protected $smarty; //smarty对象，可供子类使用

	public function __construct(){
		include VENDOR_PATH . "smarty/Smarty.class.php"; //smarty目录在vendor/smarty/
		$this -> smarty = new \Smarty(); //实例化smarty
		//设置Smarty配置
		$this -> smarty -> template_dir = APP_PATH . P . "/view/" . C . '/'; //视图模板目录在app/home(或admin)/view/(特定的控制器名)/
		$this -> smarty -> caching = false;
		$this -> smarty -> cache_dir = APP_PATH . P . "/cache";
		$this -> smarty -> cache_lifetime = 120;
		$this -> smarty -> compile_dir = APP_PATH . P . "/template_c";
		//开启session并判断用户是否需要身份验证
		if(P == "admin"){ //位于后台
			@session_start();
			if(strtolower(C) !== "privilege" && !isset($_SESSION["user"])){ //当不位于登录界面，且session找不到用户信息
				if(isset($_COOKIE["id"])){ //当“7天免登录”有效时
					$u = new \admin\model\UserModel(); //直接进行登录
					$user = $u -> getById((int)$_COOKIE["id"]); //获取setcookie()保存的用户id
					if($user){ //判断获取的id是否存在于数据库
						$_SESSION["user"] = $user;
						$this -> success("欢迎回到博客系统！3秒后自动进入首页。。。");
					}
				}
				$this -> error("请先登录！3秒后自动跳转到登录页面。。。", "index", "Privilege");
			}
		}
	}
	//Smarty二次封装
	protected function assign($key, $value){ //实现方法的二次封装，以后可直接使用assign()来代替this -> smarty -> assign()
		$this -> smarty -> assign($key, $value);
	}
	protected function display($file){ //加载方法的二次封装，以后可直接使用display()来代替this -> smarty -> display()
		$this -> smarty -> display($file);
	}
	//公共方法
	protected function success($msg, $a = A, $c = C, $p = P, $time = 3){ //成功方法，$p/$c/$a表示跳转的目标平台/控制器/方法，等待时间默认3s
		$refresh = "Refresh:" . $time . ";url=" . URL . "?c=" . $c . "&a=" . $a . "&p=" . $p; 
		header($refresh); 
		echo $msg;
		exit;
	}
	protected function error($msg, $a = A, $c = C, $p = P, $time = 3){ //失败方法，$p/$c/$a表示跳转的目标平台/控制器/方法，等待时间默认3s
		$refresh = "Refresh:" . $time . ";url=" . URL . "?c=" . $c . "&a=" . $a . "&p=" . $p;
		header($refresh); 
		echo $msg;
		exit;
	}
	protected function back($msg, $time = 3){ //回退方法
		$url = $_SERVER["HTTP_REFERER"]; //表示上一次的请求位置
		header("Refresh:" . $time . ";url=" . $url);
		echo $msg, "{$time}秒后自动回退。。。";
		exit;
	}
}