<?php
// /vendor/Image.php

namespace vendor;

//图片处理工具
class Image{
	private static $ext = array("jpg" => "jpeg", "jpeg" => "jpeg", "png" => "png", "gif" => "gif"); //保存图片后缀
	public static $error; //保存上传的错误信息
	//用GD库生成缩略图
	public static function makeThumb(string $file, string $path, int $width = 90, int $height = 90){
		//判断文件是否有效
		if(!is_file($file)){
			self::$error = "图片资源不存在！";
			return false;
		}
		if(!is_dir($path)){
			self::$error = "指定的存储路径不存在！";
			return false;
		}
		$file_info = pathinfo($file);
		$img_info = getimagesize($file);
		if(!array_key_exists($file_info["extension"], self::$ext)){ //判断文件是否能制作缩略图
			self::$error = "当前图片不能生成缩略图！";
			return false;
		}
		//图片资源合法
		$open = "imagecreatefrom" . self::$ext[$file_info["extension"]]; //打开函数
		$save = "image" . self::$ext[$file_info["extension"]]; //保存函数
		$src = $open($file); //可变方法打开文件
		$thumb = imagecreatetruecolor($width, $height);
		$bg_color = imagecolorallocate($thumb, 255, 255, 255); 
		imagefill($thumb, 0, 0, $bg_color); //设置白背景色
		//缩小图片
		$src_b = $img_info[0] / $img_info[1]; //原图宽高比
		$thumb_b = $width / $height; //缩略图宽高比
		if($src_b > $thumb_b){
			$w = $width; //缩略图的宽不变
			$h = ceil($width / $src_b); //原图若更窄，则把缩略图的高调小
			$x = 0; 
			$y = ceil(($height - $h) / 2); //缩略图的起始点坐标
		}else{
			$w = ceil($src_b * $height); //原图若更高，则把缩略图的宽调小
			$h = $height; //缩略图的高不变
			$x = ceil(($width - $w) / 2); 
			$y = 0; 
		}
		//复制合并
		if(!imagecopyresampled($thumb, $src, $x, $y, 0, 0, $w, $h, $img_info[0], $img_info[1])){
			self::$error = "出现未知错误，缩略图生成失败！";
			return false;
		}
		//生成成功
		$res = $save($thumb, $path . "thumb_" . $file_info["basename"]); //保存缩略图
		imagedestroy($src);
		imagedestroy($thumb); //销毁资源
		if($res){ //缩略图保存成功
			return "thumb_" . $file_info["basename"];
		}else{
			self::$error = "出现未知错误，缩略图保存失败！";
			return false;
		}
	}
}