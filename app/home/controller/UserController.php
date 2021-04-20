<?php
// /app/home/controller/UserController.php

namespace home\controller;
use \core\Controller;

class UserController extends Controller{
	//登录功能
	public function check(){
		$u_username = trim($_POST["u_username"]);
		$u_password = trim($_POST["u_password"]);
		//合法性验证
		if(empty($u_username) || empty($u_password)){
			$this -> error("用户名和密码都不能为空！3秒后自动跳转到首页。。。", "index", "index");
		}
		$u = new \home\model\UserModel();
		if(!$user = $u -> checkUsername($u_username)){
			$this -> error("当前用户不存在！3秒后自动跳转到首页。。。", "index", "index");
		}
		//数据合法
		if(md5($u_password) !== $user["u_password"]){
			$this -> error("密码错误！3秒后自动跳转到首页。。。", "index", "index");
		}
		@session_start();
		$_SESSION["user"] = $user;
		$this -> success("欢迎登录博客系统！3秒后自动跳转到首页。。。", "index", "index");
	}
	//登出功能
	public function logout(){
		@session_start();
		session_destroy();
		$this -> success("退出登录成功，欢迎下次登录！3秒后自动跳转到首页。。。", "index", "index");
	}
	//生成验证码
	public function captcha(){
		\vendor\Captcha::getCaptcha();
	}
	//注册
	public function register(){
		$data["u_username"] = trim($_POST["u_username"]);
		$data["u_password"] = trim($_POST["u_password"]);
		$captcha = trim($_POST["captcha"]);
		//合法性验证
		if(empty($captcha)){
			$this -> error("验证码不能为空！3秒后自动跳转到首页。。。", "index", "index");
		}
		if(empty($data["u_username"]) || empty($data["u_password"])){
			$this -> back("用户名和密码都不能为空！");
		}
		//有效性验证
		if(!\vendor\Captcha::checkCaptcha($captcha)){
			$this -> back("验证码错误！");
		}
		$u = new \home\model\UserModel();
		if($u -> checkUsername($data["u_username"])){
			$this -> back("当前用户名“" . $data["u_username"] . "”已存在！");
		}
		//数据合法
		$data["u_reg_time"] = time();
		$data["u_password"] = md5($data["u_password"]);
		if($u -> autoInsert($data)){
			$this -> success("注册成功！欢迎新朋友的加入！<br/>3秒后自动跳转到首页。。。", "index", "index");
		}else{
			$this -> error("出现未知错误，注册失败！3秒后自动跳转到首页。。。", "index", "index");
		}
	}
}