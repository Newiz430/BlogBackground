<?php
// /app/admin/controller/ArticleController.php

namespace admin\controller;
use \core\Controller; 

//侧边栏博文管理
class ArticleController extends Controller{
	//检索并显示博文列表
	public function index(){
		$cond = array(); //$cond接收检索条件
		$page = $_REQUEST["page"] ?? 1; //$page接收页码，默认第1页
		$pagecount = $config["admin"]["article_pagecount"] ?? 5; //获取每页的显示博文数量，默认5条

		if(isset($_REQUEST["a_title"]) && !empty(trim($_REQUEST["a_title"]))) //若标题存在
			$cond["a_title"] = trim($_REQUEST["a_title"]);
		if(isset($_REQUEST["c_id"]) && $_REQUEST["c_id"] != 0) //若分类不为“任意”
			$cond["c_id"] = (int)$_REQUEST["c_id"];
		if(isset($_REQUEST["a_status"]) && $_REQUEST["a_status"] != 0) //若文章状态存在
			$cond["a_status"] = (int)$_REQUEST["a_status"];
		if(isset($_REQUEST["a_topped"]) && $_REQUEST["a_topped"] != 0) //若文章置顶
			$cond["a_topped"] = (int)$_REQUEST["a_topped"];
		if(!$_SESSION["user"]["u_is_admin"])
			$cond["u_id"] = $_SESSION["user"]["id"]; //非管理员用户只能查看到自己的博文

		if(!isset($_SESSION["categories"])){ //若数据未分类
			$c = new \admin\model\CategoryModel();
			$categories = $c -> getAllCategories(); //重新分类一次数据
			$_SESSION["categories"] = $categories; 
		}
		$a = new \admin\model\ArticleModel();
		$articles = $a -> getArticleInfo($cond, $pagecount, $page); //按照检索数组进行查询显示
		//数据分页
		$counts = $a -> getSearchCounts($cond); //获取检索结果总记录数
		$cond['a'] = A;
		$cond['c'] = C;
		$cond['p'] = P; //添加跳转链接
		$pagestr = \vendor\Page::clickPage(URL . "/index.php", $counts, $pagecount, $page, $cond);
		$this -> assign("pagestr", $pagestr);
		$this -> assign("cond", $cond);
		$this -> assign("articles", $articles);
		$this -> display("articleIndex.html");
	}
	//显示表单
	public function add(){
		if(!isset($_SESSION["categories"])){ 
			$c = new \admin\model\CategoryModel();
			$categories = $c -> getAllCategories();
			$_SESSION["categories"] = $categories; 
		}
		$this -> display("articleAdd.html");
	}
	//新增博文入库
	public function insert(){
		$data = $_POST; //接收数据
		//合法性判定
		if(empty(trim($data["a_title"])) || empty(trim($data["a_content"]))){
			$this -> error("文章标题和内容都不能为空！3秒后自动跳转到添加博文页面。。。", "add");
		}
		if(!array_key_exists($data["c_id"], $_SESSION["categories"])){ 
			$this -> error("当前博文所属的分类不存在！3秒后自动跳转到添加博文页面。。。", "add");
		}
		//信息合法后
		$data["u_id"] = $_SESSION["user"]["id"];
		$data["a_author"] = $_SESSION["user"]["u_username"];
		$data["a_time"] = time(); //补充添加博文页面上没有的数据
		//上传文件
		if($a_img = \vendor\Uploader::uploadOne($_FILES["a_img"], UPLOAD_PATH)){ //UPLOAD_PATH指向\public\uploads文件夹
			$data["a_img"] = $a_img;
			$a_img_thumb = \vendor\Image::makeThumb(UPLOAD_PATH . $a_img, UPLOAD_PATH); //制作缩略图
			if($a_img_thumb)
				$data["a_img_thumb"] = $a_img_thumb;
		}
		$a = new \admin\model\ArticleModel();
		if($a -> autoInsert($data)){ //博文添加成功
			echo("新增博文“" . trim($data["a_title"]) . "”成功！");
			if(!$a_img)
				$this -> success("<br/>错误原因：" . \vendor\Uploader::$error . "<br/>图片上传失败！3秒后自动跳转到博文管理页面。。。", "index"); //当图片未上传成功时，不影响博文的上传
			elseif(!$a_img_thumb)
				$this -> success("<br/>错误原因：" . \vendor\Image::$error . "<br/>缩略图生成失败！3秒后自动跳转到博文管理页面。。。", "index"); //当缩略图未生成成功时，不影响博文的上传
			$this -> success("3秒后自动跳转到博文管理页面。。。", "index");
		}else{ //博文添加失败
			@unlink(UPLOAD_PATH . $a_img); //取消上传
			$this -> error("出现未知错误，新增博文“" . trim($data["a_title"]) . "”失败！3秒后自动跳转到添加博文页面。。。", "add");
		}
	}
	//删除博文
	public function delete(){
		$id = (int)$_GET["id"];
		$a = new \admin\model\ArticleModel();
		if($a -> deleteById($id)){ //删除成功
			$this -> success("删除成功！3秒后自动跳转到博文管理页面。。。", "index");
		}else{ //删除失败
			$this -> error("出现未知错误，删除失败！3秒后自动跳转到博文管理页面。。。", "index");
		}
	}
	//编辑博文
	public function edit(){
		$id = (int)$_GET["id"];
		if(!isset($_SESSION["categories"])){ 
			$c = new \admin\model\CategoryModel();
			$categories = $c -> getAllCategories();
			$_SESSION["categories"] = $categories; 
		}
		$a = new \admin\model\ArticleModel();
		$article = $a -> getById($id); //获取博文信息
		if(!$article)
			$this -> error("当前要编辑的博文不存在！3秒后自动跳转到博文管理页面。。。", "index");
		$this -> assign("article", $article); 
		$this -> display("articleEdit.html"); //跳转到编辑页面
	}
	//更新编辑后的博文
	public function update(){
		$id = (int)$_POST["id"];
		$data["a_title"] = trim($_POST["a_title"]);
		$data["c_id"] = (int)$_POST["c_id"];
		$data["a_status"] = (int)$_POST["a_status"];
		$data["a_topped"] = (int)$_POST["a_topped"];
		$data["a_content"] = trim($_POST["a_content"]); //用$data保存表单传来的数据
		//更新数据的合法性判断
		if(empty($data["a_title"])){
			$this -> back("博文标题不能为空！");
		}
		//更新数据合法
		//上传文件
		if($a_img = \vendor\Uploader::uploadOne($_FILES["a_img"], UPLOAD_PATH)){
			$data["a_img"] = $a_img;
			$a_img_thumb = \vendor\Image::makeThumb(UPLOAD_PATH . $a_img, UPLOAD_PATH);
			if($a_img_thumb)
				$data["a_img_thumb"] = $a_img_thumb;
		}
		$a = new \admin\model\ArticleModel();
		$article = $a -> getById($id); 
		$data = array_diff_assoc($data, $article); //把数组$data中的同时存在于$article中的元素排除出去，获得差集
		if(empty($data)){ //若未进行实际的更改
			$this -> error("并未更新任何内容！3秒后自动跳转到博文管理页面。。。", "index");
		}
		if($a -> autoUpdate($id, $data)){ //更新成功
			if(!$a_img)
				$this -> success("更新成功！<br/>错误原因：" . \vendor\Uploader::$error . "<br/>图片上传失败！3秒后自动跳转到博文管理页面。。。", "index");
			elseif(!$a_img_thumb)
				$this -> success("更新成功！<br/>错误原因：" . \vendor\Image::$error . "<br/>缩略图生成失败！3秒后自动跳转到博文管理页面。。。", "index");
			$this -> success("更新成功！3秒后自动跳转到博文管理页面。。。", "index");
		}else{ //更新失败
			$this -> error("出现未知错误，更新失败！3秒后自动跳转到博文管理页面。。。", "index");
		}
	}
}