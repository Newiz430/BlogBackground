<?php
// /app/home/model/CategoryModel.php

namespace home\model;
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
	public function noLimitCategory($categories, $parent_id = 0, $level = 0){
		static $list = array(); //用二维数组list表示记录的分类与层级
		foreach($categories as $cat){ //按层遍历数据记录，默认从顶层0开始
			if($cat["c_parent_id"] == $parent_id){ 
				$cat["level"] = $level; //为$categories中当前的分类添加层级信息
				$list[$cat["id"]] = $cat; //把当前记录保存至数组
				$this -> noLimitCategory($categories, $cat["id"], $level + 1);
			}
		}
		return $list;
	}
}



