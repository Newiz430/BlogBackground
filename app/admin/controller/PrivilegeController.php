<?php
// /app/admin/controller/PrivilegeController.php

namespace admin\controller;
use \core\Controller;

class PrivilegeController extends Controller{
	
	//获取登录表单界面
	public function index(){
		$this -> display("login.html"); //自动执行，打开页面时即进入登录页面
	}
	
	//验证用户信息
	public function check(){
		$username = trim($_POST["u_username"]); //接收数据，用trim()去除用户输入的空格
		$password = trim($_POST["u_password"]);
		$captcha = trim($_POST["captcha"]);

		if(empty($captcha)){ //验证码未填
			$this -> error("验证码不能为空！3秒后自动跳转到登录页面。。。", "index");
		}
		if(!\vendor\Captcha::checkCaptcha($captcha)){ //验证码不匹配
			$this -> error("验证码错误！3秒后自动跳转到登录页面。。。", "index");
		}
		if(empty($username) || empty($password)){ //验证信息的合法性
			$this -> error("用户名和密码都不能为空！3秒后自动跳转到登录页面。。。", "index"); //调用Controller类中的错误方法
		}
		//信息合法后
		$u = new \admin\model\UserModel(); //调用模型，获取数据
		$user = $u -> getUserByUsername($username);
		if(!$user){
			//用户名不存在
			$this -> error('当前用户名"' . $username . '"不存在！3秒后自动跳转到登录页面。。。', "index"); 
		}
		if($user["u_password"] !== md5($password)){
			//密码错误
			$this -> error("密码错误！3秒后自动跳转到登录页面。。。", "index");
		}
		//登录验证成功后
		@session_start(); //开启session会话
		$_SESSION["user"] = $user; //把当前用户信息存入Session
		//7天免登录功能
		if(isset($_POST["rememberMe"])){ //表示选中“7天免登录”
			setcookie("id", $user["id"], time() + 7 * 24 * 3600);
		}

		$this -> success("欢迎登录博客系统！3秒后自动进入首页。。。", "index", "Index"); //进入首页
	}

	//获取验证码
	public function captcha(){
		\vendor\Captcha::getCaptcha(); //调用Captcha类
	} 
	
	//退出系统
	public function logout(){
		session_destroy(); 
		setcookie("id", '', 1); //清除7天免登录保存的信息
		$this -> success("退出成功！3秒后自动跳转到登录页面。。。", "index"); //跳转到登录页面
	}
}