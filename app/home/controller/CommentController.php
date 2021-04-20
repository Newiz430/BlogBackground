<?php
// /app/home/controller/CommentController.php

namespace home\controller;
use \core\Controller;

//前台评论功能
class CommentController extends Controller{
	//新增评论
	public function insert(){
		$data["a_id"] = (int)$_POST["a_id"];
		$data["c_comment"] = trim($_POST["c_comment"]);
		if(empty($data["c_comment"])){
			$this -> back("评论不能为空！");
		}
		//评论合法
		@session_start();
		$data["u_id"] = $_SESSION["user"]["id"]; //获取当前用户id
		$data["c_time"] = time(); //获取评论时间
		$c = new \home\model\CommentModel();
		if($c -> autoInsert($data)){
			$this -> back("评论发布成功！");
		}else{
			$this -> back("出现未知错误，评论发布失败！");
		}
	}
}