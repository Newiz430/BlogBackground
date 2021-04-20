<?php
// /app/admin/controller/UserController.php

namespace admin\controller;
use \core\Controller;

class UserController extends Controller{
	//新增一个用户
	public function add(){
		$this -> display("userAdd.html");
	}
	//新增用户数据入库
	public function insert(){
		$data = $_POST;
		//判断合法性
		if(empty(trim($data["u_username"])) || empty(trim($data["u_password"]))){ //当前用户名或密码未填
			$this -> error("用户名和密码都不能为空！3秒后自动跳转到添加用户页面。。。", "add");
		}
		$u = new \admin\model\UserModel();
		if($u -> checkUsername($data["u_username"])){ //当前用户名与库中的用户存在重名
			$this -> error("当前用户名“" . $data["u_username"] . "”已存在！3秒后自动跳转到添加用户页面。。。", "add");
		}
		//用户数据合法
		$data["u_reg_time"] = time();
		$data["u_password"] = md5($data["u_password"]); //密码加密
		if($u -> autoInsert($data)){
			$this -> success("新增用户“" . $data["u_username"] . "”成功！3秒后自动跳转到用户管理页面。。。", "index");
		}else{
			$this -> error("出现未知错误，新增用户失败！3秒后自动跳转到添加用户页面。。。", "add");
		}
	}
	//显示所有用户信息
	public function index(){
		$page = $_REQUEST["page"] ?? 1; //获取分页信息
		global $config;
		$pagecount = $config["admin"]["user_pagecount"] ?? 5; //若未设置，则默认每页显示5条数据
		$u = new \admin\model\UserModel();
		$users = $u -> getAllUsers($pagecount, $page);
		$counts = $u -> getCounts(); //获取总记录数
		$cond = array("a" => A, "c" => C, "p" => P);
		$pagestr = \vendor\Page::clickPage(URL . "/index.php", $counts, $pagecount, $page, $cond); //调用分页工具Page
		$this -> assign("pagestr", $pagestr);
		$this -> assign("users", $users);
		$this -> display("userIndex.html");
	}
	//删除用户
	public function delete(){
		$id = (int)$_GET["id"];
		$u = new \admin\model\UserModel();
		//... 可以在此加一些删除限制条件
		if($u -> deleteById($id)){
			if($id == $_SESSION["user"]["id"]){ //如果删除的是自己
				session_destroy(); 
				setcookie("id", '', 1); //清除7天免登录保存的信息
				$this -> success("删除用户成功！3秒后自动跳转到登录页面。。。", "index", "Privilege"); //不再登录，直接退出
			}else{
				$this -> success("删除用户成功！3秒后自动跳转到用户管理页面。。。", "index");
			}
		}else{
			$this -> error("出现未知错误，删除用户失败！3秒后自动跳转到用户管理页面。。。", "index");
		}
	}
	//编辑用户信息
	public function edit(){
		$id = (int)$_GET["id"];
		$u = new \admin\model\UserModel();
		$users = $u -> getById($id); //获取用户信息
		if(!$users)
			$this -> error("当前要修改的用户不存在！3秒后自动跳转到博文管理页面。。。", "index");
		$this -> assign("users", $users); 
		$this -> display("userEdit.html"); //跳转到编辑页面
	}
	//编辑用户信息入库
	public function update(){
		$id = (int)$_POST["id"];
		$data = $_POST;
		//判断合法性
		if(empty(trim($data["u_username"]))){
			$this -> back("用户名不能为空！");
		}
		$u = new \admin\model\UserModel();
		$users = $u -> getById($id); 
		if($data["u_username"] != $users["u_username"] && $u -> checkUsername($data["u_username"])){
			$this -> back("新用户名“" . $data["u_username"] . "”已存在！");
		}
		//用户数据合法
		$data["u_reg_time"] = $users["u_reg_time"]; //注册时间不会随着更改
		if(empty(trim($data["u_password"]))){ //如果密码为空，说明不进行修改
			$data["u_password"] = $users["u_password"]; //直接使用用户表中已加密过的密码
		}else{
			$data["u_password"] = md5($data["u_password"]); //密码加密
		}
		$data = array_diff_assoc($data, $users); //把数组$data中的同时存在于$users中的元素排除出去，获得差集
		if(empty($data)){ //若未进行实际的更改
			$this -> error("并未更新任何内容！3秒后自动跳转到用户管理页面。。。", "index");
		}
		if($u -> autoUpdate($id, $data)){ //更新成功
			$this -> success("更新成功！3秒后自动跳转到用户管理页面。。。", "index");
		}else{ //更新失败
			$this -> error("出现未知错误，更新失败！3秒后自动跳转到用户管理页面。。。", "index");
		}
	}
}