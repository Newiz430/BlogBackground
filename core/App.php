<?php
// /core/App.php

//core命名空间
namespace core;
//安全判定，寻找入口文件index.php中的入口记号
if(!defined("ACCESS")){
	header("location:../public/index.php");
	exit; //终止后续代码，一般与跳转header()函数共用
}

//初始化类
class App{
	//入口方法
	public static function start(){
		//目录常量设置
		self::set_path();
		self::set_config();
		self::set_error();
		self::set_url();
		self::set_autoload();
		self::set_dispatch();
	}
	//路径常量方法
	private static function set_path(){
		define("CORE_PATH", ROOT_PATH . "core/");
		define("APP_PATH", ROOT_PATH . "app/");
		define("HOME_PATH", APP_PATH . "home/");
		define("ADMIN_PATH", APP_PATH . "admin/");
		define("ADMIN_CONT", ADMIN_PATH . "controller/");
		define("ADMIN_MODEL", ADMIN_PATH . "model/");
		define("ADMIN_VIEW", ADMIN_PATH . "view/");
		define("HOME_CONT", HOME_PATH . "controller/");
		define("HOME_MODEL", HOME_PATH . "model/");
		define("HOME_VIEW", HOME_PATH . "view/");
		define("VENDOR_PATH", ROOT_PATH . "vendor/");
		define("CONFIG_PATH", ROOT_PATH . "config/");
		define("UPLOAD_PATH", ROOT_PATH . "public/uploads/");
		define("URL", "http://www.blog.com");
	}
	//错误处理方法
	private static function set_error(){
		global $config; 
		@ini_set("error_reporting", $global["system"]["error_reporting"]); //显示所有错误
		@ini_set("display_errors", $global["system"]["display_errors"]); //显示错误信息
	}
	//读取配置文件
	private static function set_config(){
		global $config; //设置$config为全局变量
		$config = include CONFIG_PATH . "config.php"; //包含配置文件
	}
	//解析URL
	private static function set_url(){
		$p = $_REQUEST['p'] ?? "home"; //$p表示platform（平台），默认为前台home
		$c = $_REQUEST['c'] ?? "Index"; //$c表示controller（控制器），默认为Indexcontroller
		$a = $_REQUEST['a'] ?? "index"; //$a表示action（方法），默认为index方法
		//把解析结果定义成常量
		define('P', $p);
		define('C', $c);
		define('A', $a);
	}
	//类加载方法
	private static function set_autoload_function($class){
		$class = basename($class); //把命名空间从$class中分离，只保留类名
		
		$path = CORE_PATH . $class . ".php"; //核心类
		if(file_exists($path)){
			include_once $path;
		}

		$path = APP_PATH . P . "/controller/" . $class . ".php"; //前/后台控制器
		if(file_exists($path)){
			include_once $path;
		}

		$path = APP_PATH . P . "/model/" . $class . ".php"; //前/后台模型
		if(file_exists($path)){
			include_once $path;
		}

		$path = VENDOR_PATH . $class . ".php"; //外部类
		if(file_exists($path)){
			include_once $path;
		}
	}
	//spl_autoload_register自动加载
	private static function set_autoload(){
		spl_autoload_register(array(__CLASS__, "set_autoload_function"));
	}
	//分发控制器
	private static function set_dispatch(){
		$p = P; //找到前后台
		$c = C; //找到控制器
		$a = A; //找到方法
		$controller = "\\{$p}\\controller\\{$c}controller"; 
		$obj = new $controller();
		$obj -> $a(); //用可变对象访问controller对象$obj中的方法
	}
}