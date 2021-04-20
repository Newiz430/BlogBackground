<?php
// /vendor/Uploader.php

namespace vendor;

//文件上传工具
class Uploader{
	private static $types = array("image/jpg", "image/jpeg", "image/pjpeg", "image/png"); //保存图片类型
	public static function setTypes(array $types = array()){
		if(!empty($types))
			self::$types = $types; //默认使用当前类型
	}
	public static $error; //保存上传的错误信息
	//单文件上传
	public static function uploadOne(array $file, string $path, int $max = 2000000){
		//判断文件是否有效
		if(!isset($file["error"]) || count($file) != 5){
			self::$error = "上传文件错误！";
			return false;
		}
		if(!is_dir($path)){
			self::$error = "指定的存储路径不存在！";
			return false;
		}
		switch($file["error"]){
			case 1:
			case 2:
				self::$error = "文件超过服务器的最大大小！";
				return false;
			case 3:
				self::$error = "文件未全部上传！";
				return false;
			case 4:
				self::$error = "未选中要上传的文件！";
				return false;
			case 6:
			case 7:
				self::$error = "服务器出现未知错误！";
				return false;
		}
		//上传文件有效
		if(!in_array($file["type"], self::$types)){
			self::$error = "不允许上传当前类型的文件！";
			return false;
		}
		if($file["size"] > $max){
			self::$error = "文件超出规定的大小" . (string)($max / 1000000) . "字节！";
			return false;
		}
		//上传文件合法
		$filename = self::getRandomName($file["name"]); //获取新的随机文件名
		if(move_uploaded_file($file["tmp_name"], $path . '/' . $filename)){
			return $filename; //上传成功
		}else{
			self::$error = "出现未知错误，文件上传失败！";
			return false; //上传失败
		}
	}
	//获取随机文件名
	public static function getRandomName(string $filename, $prefix = "image"){
		$ext = strrchr($filename, '.'); //提取出扩展名
		$newname = $prefix . date("YmdHis"); //前缀+日期时间
		for($i = 0; $i < 6; $i++){
			$newname .= chr(mt_rand(65, 90));
		}
		return $newname . $ext; //最终文件名=前缀+日期时间+随机大写字母6个.扩展名
	}
}