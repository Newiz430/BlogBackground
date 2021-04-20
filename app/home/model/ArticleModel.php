<?php
// /app/home/model/ArticleModel.php

namespace home\model;
use \core\Model;

class ArticleModel extends Model{
	protected $table = "article";
	//按检索条件分页获取博文
	public function getAllArticles($cond = array(), $pagecount = 5, $page = 1){
		$offset = ($page - 1) * $pagecount;//每页要显示的博文条数
		$where = "where a_is_delete = 0 and a_status = 2"; //只显示未删除且公开的博文
		if(isset($cond["a_title"]))
			$where .= " and a_title like '%{$cond["a_title"]}%' ";
		if(isset($cond["c_id"]))
			$where .= " and c_id = {$cond["c_id"]}";
		$sql = "select * from {$this -> getTable()} a left join (select a_id, count(*) c_count from {$this -> getTable('comment')} group by a_id) c on a.id = c.a_id {$where} order by a_time desc limit {$offset}, {$pagecount}"; //连接评论表，获取评论数目c_count
		return $this -> query($sql, true);
	}
	//根据分类获取博文数量
	public function getCountsByCategory(){
		$sql = "select c_id, count(*) c from {$this -> getTable()} where a_is_delete = 0 group by c_id";
		$res = $this -> query($sql, true);
		$list = array();
		foreach($res as $v){
			$list[$v["c_id"]] = $v; //把分类的ID作为数组的下标
		}
		return $list;
	}
	//获取最新的$limit篇博文
	public function getNewsInfo($limit = 3){
		$sql = "select id, a_title, a_img_thumb from {$this -> getTable()} where a_is_delete = 0 order by a_time desc limit {$limit}";
		return $this -> query($sql, true);
	}
	//获取所有博文数量
	public function getCounts($cond = array()){
		$where = "where a_is_delete = 0 and a_status = 2";
		if(isset($cond["a_title"]))
			$where .= " and a_title like '%{$cond["a_title"]}%' ";
		if(isset($cond["c_id"]))
			$where .= " and c_id = {$cond["c_id"]}";
		$sql = "select count(*) c from {$this -> getTable()} {$where}";
		$res = $this -> query($sql, true);
		return $res[0]['c'] ?? 0;
	}
}	