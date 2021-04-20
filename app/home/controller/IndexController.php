<?php
// /app/home/controller/IndexController.php

namespace home\controller;
use \core\Controller; //使用公共控制器的命名空间

//前台首页
class IndexController extends Controller{
	public function index(){
		//检索条件
		$cond = array();
		if(isset($_GET["c_id"]) && $_GET["c_id"] != 0)
			$cond["c_id"] = (int)$_GET["c_id"]; //接收要检索的分类
		if(isset($_REQUEST["a_title"]) && !empty(trim($_REQUEST["a_title"])))
			$cond["a_title"] = trim($_REQUEST["a_title"]); //接收要检索的标题
		//分页数据
		$page = $_GET["page"] ?? 1; //当前页
		global $config;
		$pagecount = $config["home"]["article_pagecount"] ?? 5;
		//获取首页显示信息
		@session_start(); 
		$c = new \home\model\CategoryModel();
		$categories = $c -> getAllCategories(); //获取分类信息
		$_SESSION["categories"] = $categories; //把分类信息保存到session
		$a = new \home\model\ArticleModel();
		$articles = $a -> getAllArticles($cond, $pagecount, $page); //分页获取所有博文信息
		$counts = $a -> getCounts($cond);
		$pagestr = \vendor\Page::clickPage(URL . "/index.php", $counts, $pagecount, $page, $cond);
		$cat_counts = $a -> getCountsByCategory();//获取各分类下的博文数量
		$news = $a -> getNewsInfo(); //获取最新的记录

		$this -> assign("cond", $cond);
		$this -> assign("news", $news);
		$this -> assign("articles", $articles);
		$this -> assign("cat_counts", $cat_counts);
		$this -> assign("pagestr", $pagestr);
		$this -> display("blogShowList.html");
	}
	//查看博文明细
	public function detail(){
		$id = (int)$_GET["id"];
		$a = new \home\model\ArticleModel();
		$article = $a -> getById($id); //获取相应博文数据
		//获取博文分类信息
		@session_start();
		if(isset($_SESSION["categories"])){
			$c = new \home\model\CategoryModel();
			$categories = $c -> getAllCategories(); //获取分类信息
			$_SESSION["categories"] = $categories; //把分类信息保存到session
		}
		//获取评论
		$c = new \home\model\CommentModel();
		$comments = $c -> getCommentsByArticle($id);

		$this -> assign("article", $article);
		$this -> assign("comments", $comments);
		$this -> display("blogShow.html");
	}
}