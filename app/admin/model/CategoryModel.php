<?php
// /app/admin/model/CategoryModel.php

namespace admin\model;
use \core\Model;

class CategoryModel extends Model{
	protected $table = "category";
	//获取所有分类信息
	public function getAllCategories(){
		$sql = "select * from {$this -> getTable()} order by c_sort desc"; 
		$categories = $this -> query($sql, true); 
		return $this -> noLimitCategory($categories); //分类加工数据
	}
	//无限极分类方法，寻找对应层级的记录并储存下来
	public function noLimitCategory($categories, $parent_id = 0, $level = 0, $stop = 0){
		static $list = array(); //用二维数组list表示记录的分类与层级
		foreach($categories as $cat){ //按层遍历数据记录，默认从顶层0开始
			if($cat["id"] == $stop)
				continue; //不再获取该分类
			if($cat["c_parent_id"] == $parent_id){ 
				$cat["level"] = $level; //为$categories中当前的分类添加层级信息
				$list[$cat["id"]] = $cat; //把当前记录保存至数组
				$this -> noLimitCategory($categories, $cat["id"], $level + 1, $stop);
			}
		}
		return $list;
	}
	//查找同名分类，若分类名存在则返回其ID，不存在则返回false
	public function checkCategoryName($parent_id, $name){
		$sql = "select id from {$this -> getTable()} where c_parent_id = {$parent_id} and c_name = '{$name}'";
		return $this -> query($sql);
	}
	//分类数据入库
	public function insertCategory($name, $parent_id, $sort){
		$sql = "insert into {$this -> getTable()} values(null, '{$name}', {$sort}, {$parent_id})";
		return $this -> exec($sql);
	}
	//获取子分类
	public function getSon($id){
		$sql = "select id from {$this -> getTable()} where c_parent_id = {$id}";
		return $this -> query($sql);
	}
}



