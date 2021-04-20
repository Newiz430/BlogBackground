<?php
// /app/admin/model/UserModel.php

namespace admin\model;
use \core\Model;

class UserModel extends Model{
	protected $table = "user";
	//获取用户信息
	public function getUserByUsername($username){
		$username = addslashes($username); //防止SQL注入：通过设定特殊符号（用addslashes()函数给转义字符加反斜杠）改变SQL指令
		$sql = "select * from {$this -> getTable()} where u_username = '{$username}'"; //查询用户数据
		return $this -> query($sql);
	}
	//获取用户数量
	public function getCounts(){
		$sql = "select count(*) as c from {$this -> getTable()}";
		$res = $this -> query($sql);
		return $res['c'] ?? 0; //当没有记录时，显示用户数为0
	}
	//验证用户名是否存在
	public function checkUsername($username){
		$sql = "select id from {$this -> getTable()} where u_username = '{$username}'";
		return $this -> query($sql);
	}
	//按照分页获取用户信息
	public function getAllUsers($pagecount = 5, $page = 1){
		$offset = ($page - 1) * $pagecount;
		$sql = "select id, u_username, u_is_admin, u_reg_time from {$this -> getTable()} order by u_reg_time desc limit {$offset}, {$pagecount}";
		return $this -> query($sql, true);
	}
}