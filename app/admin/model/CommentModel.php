<?php
// /app/admin/model/CommentModel.php

namespace admin\model;
use \core\Model;

class CommentModel extends Model{
	protected $table = "comment";
	//分页获取全部评论信息
	public function getAllComments($pagecount = 5, $page = 1){
		$offset = ($page - 1) * $pagecount;
		//连接用户、评论、博文三张表进行操作
		$sql = "select c.*, u.u_username, a.a_title from {$this -> getTable()} c left join {$this -> getTable('user')} u on c.u_id = u.id left join {$this -> getTable('article')} a on c.a_id = a.id order by c.c_time desc, c.a_id desc limit {$offset}, {$pagecount}"; 
		return $this -> query($sql, true);
	}
	//获取评论记录数
	public function getCounts(){
		$sql = "select count(*) c from {$this -> getTable()}";
		$res = $this -> query($sql);
		return $res['c'] ?? 0;
	}
}