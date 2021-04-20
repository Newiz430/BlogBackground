<?php
// /app/admin/model/ArticleModel.php

namespace admin\model;
use \core\Model;

class ArticleModel extends Model{
	protected $table = "article";
	//分页获取所有博文数据
	public function getArticleInfo($cond = array(), $pagecount = 5, $page = 1){
		$where = " where a_is_delete = 0"; //排除被删除的博文
		foreach ($cond as $k => $v) {
			switch($k){
				case "a_title":
					$where .= " and a_title like '%" . $v . "%'"; 
					break;
				case "c_id":
				case "a_status":
				case "a_topped":
				case "u_id":
					$where .= " and {$k} = {$v}";
					break;
			}
		}
		$offset = ($page - 1) * $pagecount; //分页起始位置
		$sql = "select id, a_author, a_title, c_id, u_id, a_time, a_status from {$this -> getTable()} {$where} order by a_time desc limit {$offset}, {$pagecount}"; //按发表时间降序查询
		return $this -> query($sql, true);
	}
	//获取检索结果的总记录数
	public function getSearchCounts($cond = array(), $pagecount = 5, $page = 1){
		$where = " where a_is_delete = 0"; //排除被删除的博文
		foreach ($cond as $k => $v) {
			switch($k){
				case "a_title":
					$where .= " and a_title like '%" . $v . "%'"; 
					break;
				case "c_id":
				case "a_status":
				case "a_topped":
				case "u_id":
					$where .= " and {$k} = {$v}";
					break;
			}
		}
		$sql = "select count(*) c from {$this -> getTable()} {$where}"; //查询总记录数，并存入表c
		$res = $this -> query($sql);
		return $res["c"] ?? 0; //未查询到记录时，把false转换成0
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
	//判断某个分类下是否存在博文
	public function checkArticleByCategory($c_id){
		$sql = "select c_id from {$this -> getTable()} where c_id = {$c_id} limit 1"; //只需要查一条记录即可
		return $this -> query($sql);
	}
}