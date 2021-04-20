<?php
// /core/Dao.php

namespace core;
use \PDO, \PDOStatement, \PDOException; //引入PDO类

class Dao{
	private $pdo; //PDO对象变量
	private $fetch_mode;
	
	public function __construct($info = array(), $drivers = array()){ //构造方法
		$type = $info["type"] ?? "mysql";
		$host = $info["host"] ?? "localhost";
		$port = $info["port"] ?? "3306";
		$user = $info["user"] ?? "root";
		$pass = $info["pass"] ?? "root";
		$dbname = $info["dbname"] ?? "mydb";
		$charset = $info["charset"] ?? "utf8";
		$this -> fetch_mode = $info["fetch_mode"] ?? PDO::FETCH_ASSOC;
		$drivers[PDO::ATTR_ERRMODE] = $drivers[PDO::ATTR_ERRMODE] ?? PDO::ERRMODE_EXCEPTION; //异常模式处理
		
		//实例化$pdo
		try{
			$this -> pdo = @new PDO($type . ":host=" . $host . ";port=" . $port . ";dbname=" . $dbname, $user, $pass, $drivers);
		}
		catch(PDOException $e){
			$this -> dao_exception($e);
		}

		//设置字符集
		try{
			$this -> pdo -> exec("set names {$charset}");
		}
		catch(PDOException $e){
			$this -> dao_exception($e);
		}
	}

	private function dao_exception(PDOException $e){ //异常处理方法二次封装
		echo "SQL execution error:<br/>";
		echo "Error file: " . $e -> getFile() . '<br/>';
		echo "Error line: " . $e -> getLine() . '<br/>';
		echo "Error Message: " . $e -> getMessage(); 
		die();
	}

	public function dao_exec($sql){ //PDO写方法二次封装
		try{
			return $this -> pdo -> exec($sql);
		}
		catch(PDOException $e){
			$this -> dao_exception($e);
		}
	}
	public function dao_insert_id(){ //获取自增长ID二次封装
		return $this -> pdo -> lastInsertId();
	}
	public function dao_query($sql, $all = false){ //PDO读方法二次封装
		try{
			$stat = $this -> pdo -> query($sql);
			$stat -> setFetchMode($this -> fetch_mode);
			if(!$all){
				return $stat -> fetch();
			}
			else{
				return $stat -> fetchAll();
			}
		}
		catch(PDOException $e){
			$this -> dao_exception($e);
		}
	}
}