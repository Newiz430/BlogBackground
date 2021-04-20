<?php
// /core/Model.php

namespace core;

class Model{
	protected $dao; //DAO对象

	public function __construct(){
		global $config; //使用配置文件
		$this -> dao = new Dao($config["database"], $config["drivers"]); 
		$this -> getFields(); //初始化字段信息
	}

	protected function exec(string $sql){ //DAO写方法的二次封装
		return $this -> dao -> dao_exec($sql);
	}
	public function getLastId(){ //获取自增长ID的二次封装
		return $this -> dao -> dao_insert_id();
	}
	protected function query(string $sql, $all = false){ //DAO读方法的二次封装
		return $this -> dao -> dao_query($sql, $all);
	}

	//公共方法
	protected function getTable(string $table = ''){ //构造全表名（带前缀的表名）
		global $config;
		$table = empty($table) ? $this -> table : $table; //获取表名，默认用当前表名
		return $config["database"]["prefix"] . $table; //加上配置文件中设置的前缀
	}
	protected function getAll(){ //获取所有表名
		$sql = "select * from {$this -> getTable()}";
		return $this -> query($sql, true); //获取全部数据
	}
	protected function getFields(){ //获取表的字段
		$sql = "desc {$this -> getTable()}";
		$rows = $this -> query($sql, true); //获得表记录的二维数组
		foreach($rows as $row){ //循环遍历
			$this -> fields[] = $row["Field"];
			if($row["Key"] == "PRI"){ //存储主键
				$this -> fields["Key"] = $row["Field"];
			}
		}
	}
	public function getById($id){ //通过主键ID获取记录
		if(!isset($this -> fields["Key"])){ //没有主键
			return false;
		}
		$sql = "select * from {$this -> getTable()} where {$this -> fields['Key']} = '{$id}'";
		return $this -> query($sql);
	}
	public function deleteById($id){ //通过主键删除记录
		if(!isset($this -> fields["Key"])){ //没有主键
			return false;
		}
		$sql = "delete from {$this -> getTable()} where {$this -> fields['Key']} = '{$id}'";
		return $this -> exec($sql);
	}
	public function autoUpdate($id, $data){ //有主键的自动更新
		$where = " where {$this -> fields['Key']} = '{$id}'"; //查询条件
		$sql = "update {$this -> getTable()} set ";
		foreach ($data as $key => $value) {
			if(is_string($value))
				$value = addslashes($value); //对字符串和文本进行转义
			$sql .= $key . "='" . $value . "',"; //用遍历方法创建更新SQL语句
		}
		$sql = trim($sql, ',') . $where; //给SQL语句添加更新条件
		return $this -> exec($sql);
	}
	public function autoInsert($data){ //自动新增数据
		$keys = $values = ''; 
		foreach ($this -> fields as $k => $v) {
			if($k == "Key")
				continue; //主键为自增长属性，不需要新增
			if(array_key_exists($v, $data)){ //判定当前字段是否存在
				$keys .= $v . ',';
				$values .= "'" . $data[$v] . "',";
			}
		}
		$keys = rtrim($keys, ','); 
		$values = rtrim($values, ','); //去除最右边的逗号
		$sql = "insert into {$this -> getTable()} ({$keys}) values({$values})";
		return $this -> exec($sql);
	}
}