<?php
// /app/home/model/CommentModel.php

namespace home\model;
use \core\Model;

class CommentModel extends Model{
	protected $table = "comment";
	//获取评论
	public function getCommentsByArticle($id){
		$sql = "select * from {$this -> getTable()} c left join {$this -> getTable('user')} u on c.u_id = u.id where com.a_id = {$id} order by c.c_time desc";
		return $this -> query($sql, true);
	}
}