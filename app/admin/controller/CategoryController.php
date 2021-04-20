<?php
// /app/admin/controller/CategoryController.php

namespace admin\controller;
use \core\Controller; 

//侧边栏分类管理
class CategoryController extends Controller{
	//首页显示所有分类
	public function index(){
		$c = new \admin\model\CategoryModel();
		$categories = $c -> getAllCategories(); //获取所有分类数据
		$_SESSION["categories"] = $categories; //把数据存入session
		$a = new \admin\model\ArticleModel();
		$cat_counts = $a -> getCountsByCategory(); //获取各分类下的博文数量
		$this -> assign("cat_counts", $cat_counts);
		$this -> display("categoryIndex.html");
	}
	//新增分类
	public function add(){
		if(!isset($_SESSION["categories"])){ //若数据未分类
			$c = new \admin\model\CategoryModel();
			$categories = $c -> getAllCategories(); //重新分类一次数据
			$_SESSION["categories"] = $categories; 
		}
		$this -> display("categoryAdd.html");
	}
	//新增分类入库
	public function insert(){
		$c_name = trim($_POST["c_name"]);
		$c_parent_id = (int)$_POST["c_parent_id"];
		$c_sort = trim($_POST["c_sort"]);
		//合法性判定
		if(empty($c_name)){
			$this -> error("分类名不能为空！3秒后自动跳转到添加分类页面。。。", "add");
		}
		if(!is_numeric($c_sort) || (int)$c_sort != $c_sort || $c_sort < 0 || $c_sort > PHP_INT_MAX){ //排序值必须为正整数，且不能超过上限
			$this -> error("排序必须是正整数！3秒后自动跳转到添加分类页面。。。", "add");
		}
		$c = new \admin\model\CategoryModel();
		if($c -> checkCategoryName($c_parent_id, $c_name)){ //检查是否存在同名分类
			$this -> error("当前分类名“" . $c_name . "”在指定分类下已经存在！3秒后自动跳转到添加分类页面。。。", "add");
		}
		//信息合法后
		if($c -> insertCategory($c_name, (int)$c_parent_id, (int)$c_sort)){ //数据添加成功
			$this -> success("新增分类“" . $c_name . "”成功！3秒后自动跳转到分类管理页面。。。", "index");
		}else{ //数据添加失败
			$this -> error("出现未知错误，新增分类“" . $c_name . "”失败！3秒后自动跳转到添加分类页面。。。", "add");
		}
	}
	//删除分类
	public function delete(){
		$id = (int)$_GET["id"];
		$c = new \admin\model\CategoryModel();
		if($c -> getSon($id)){ //若当前分类有子分类
			$this -> error("当前分类有子分类，不能删除！3秒后自动跳转到分类管理页面。。。", "index");
		}
		$a = new \admin\model\ArticleModel();
		if($a -> checkArticleByCategory($id)){
			$this -> error("当前分类下有博文，不能删除！3秒后自动跳转到分类管理页面。。。", "index");
		}
		//删除操作合法
		if($c -> deleteById($id)){ //删除成功
			$this -> success("删除成功！3秒后自动跳转到分类管理页面。。。", "index");
		}else{ //删除失败
			$this -> error("出现未知错误，删除失败！3秒后自动跳转到分类管理页面。。。", "index");
		}
	}
	//编辑分类
	public function edit(){
		$id = (int)$_GET["id"];
		if(!array_key_exists($id, $_SESSION["categories"])){ //判断当前id是否存在于分类中
			$this -> error("当前要编辑的分类不存在！3秒后自动跳转到分类管理页面。。。", "index");
		}
		$c = new \admin\model\CategoryModel();
		$categories = $c -> noLimitCategory($_SESSION["categories"], 0, 0, $id); //在分类数据中去除自己和自己的子分类
		$this -> assign("categories", $categories); 
		$this -> assign("id", $id);
		$this -> display("categoryEdit.html"); //跳转到编辑页面
	}
	//更新编辑后的数据
	public function update(){
		$id = (int)$_POST["id"];
		$data["c_name"] = trim($_POST["c_name"]);
		$data["c_parent_id"] = (int)$_POST["c_parent_id"];
		$data["c_sort"] = trim($_POST["c_sort"]); //用$data保存表单传来的数据
		//更新数据的合法性判断
		if(empty($data["c_name"])){
			$this -> back("分类名不能为空！");
		}
		if(!is_numeric($data["c_sort"]) || (int)$data["c_sort"] != $data["c_sort"] || $data["c_sort"] < 0 || $data["c_sort"] > PHP_INT_MAX){
			$this -> back("排序必须是正整数！");
		}
		//更新数据合法
		$c = new \admin\model\CategoryModel();
		$cat = $c -> checkCategoryName((int)$data["c_parent_id"], $data["c_name"]); //检查是否存在同名分类
		if($cat && $cat["id"] != $id){ //检查是否存在同名分类
			$this -> back("当前分类名“" . $data["c_name"] . "”在指定分类下已经存在！");
		}
		//更新数据有效
		$data = array_diff_assoc($data, $_SESSION["categories"][$id]); //该函数把数组$data中的同时存在于session中的元素排除出去，获得差集
		if(empty($data)){ //若$data和$_SESSION中数据相同，即未进行实际的更改
			$this -> error("并未更新任何内容！3秒后自动跳转到分类管理页面。。。", "index");
		}
		if($c -> autoUpdate($id, $data)){ //更新成功
			$this -> success("更新成功！3秒后自动跳转到分类管理页面。。。", "index");
		}else{ //更新失败
			$this -> error("出现未知错误，更新失败！3秒后自动跳转到分类管理页面。。。", "index");
		}
	}
}