<?php
// /app/home/model/UserModel.php

namespace home\model;
use \core\Model;

class UserModel extends Model{
	protected $table = "user";

	//验证用户名是否存在
	public function checkUsername($username){
		$username = addslashes($username);
		$sql = "select * from {$this -> getTable()} where u_username = '{$username}'";
		return $this -> query($sql);
	}
}