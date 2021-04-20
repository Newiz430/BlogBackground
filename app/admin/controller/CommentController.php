<?php
// /app/admin/controller/CommentController.php

namespace admin\controller;
use \core\Controller;

//后台评论功能
class CommentController extends Controller{
	//分页显示所有评论
	public function index(){
		//分页数据
		$page = $_GET["page"] ?? 1;
		global $config;
		$pagecount = $config["admin"]["comment_pagecount"] ?? 5;
		//评论数据
		$c = new \admin\model\CommentModel();
		$comments = $c -> getAllComments($pagecount, $page);
		$counts = $c -> getCounts(); //获取评论记录数
		$cond = array('a' => A, 'c' => C, 'p' => P);
		$pagestr = \vendor\Page::clickPage(URL . "/index.php", $counts, $pagecount, $page, $cond); //使用分页工具

		$this -> assign("comments", $comments);
		$this -> assign("pagestr", $pagestr);
		$this -> display("commentIndex.html");
	}
	//删除评论
	public function delete(){
		$id = (int)$_GET["id"];
		$c = new \admin\model\CommentModel();
		if($c -> deleteById($id)){
			$this -> success("评论删除成功！3秒后自动跳转到评论管理页面。。。", "index");
		}else{
			$this -> error("出现未知错误，评论删除失败！3秒后自动跳转到评论管理页面。。。", "index");
		}
	}
}