<?php
// /vendor/Captcha.php
	
namespace vendor;

//验证码
class Captcha{
	//图片宽度$width = 450
	//图片高度$height = 65
	//验证码默认字符数$length = 4
	//验证码字体$fonts = ''
		
	//获取随机字符串
	private static function getString($length = 4){
		$captcha = '';
		for($i = 0; $i < $length; $i++){
			switch(mt_rand(1,2)){
				case 1: //小写字母
					$captcha .= chr(mt_rand(65, 90)); //把对应的数值按ASCII转换为字符
					break;
				case 2: //大写字母
					$captcha .= chr(mt_rand(97, 122));
					break;
			}
		}
		return $captcha;
	}

	//获取验证码图片
	public static function getCaptcha($width = 450, $height = 65, $length = 4, $fonts = ''){
		if(empty($fonts)) //判定是否指定字体
			$fonts = "jokerman.ttf";
		$fonts = __DIR__ . "/fonts/" . $fonts; 

		$img = imagecreatetruecolor($width, $height);
		$bg_color = imagecolorallocate($img, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255)); //随机背景色
		imagefill($img, 0, 0, $bg_color);
		for($i = 0; $i < mt_rand(5, 15); $i++){
			//干扰线
			$line_color = imagecolorallocate($img, mt_rand(100, 200), mt_rand(100, 200), mt_rand(100, 200));
			imageline($img, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $line_color);
		}
		for($i = 0; $i < mt_rand(40, 60); $i++){
			//噪点
			$dots_color = imagecolorallocate($img, mt_rand(100, 200), mt_rand(100, 200), mt_rand(100, 200));
			imagestring($img, mt_rand(1, 5), mt_rand(0, $width), mt_rand(0, $height), ".", $dots_color);
		}
		$captcha = self::getString($length); //获取验证码
		@session_start(); 
		$_SESSION["captcha"] = $captcha; //保存验证码到session
		for($i = 0; $i < $length; $i++){
			$c_color = imagecolorallocate($img, mt_rand(0, 60), mt_rand(0, 60), mt_rand(0, 60));
			imagettftext($img, mt_rand(40, 50), mt_rand(-45, 45), $width / ($length + 1) * ($i + 1), mt_rand(48, $height - 15), $c_color, $fonts, $captcha[$i]); //挨个给字符添加效果并写入
		}
		header("Content-type:image/png"); 
		imagepng($img); //输出图片
		imagedestroy($img); //销毁图片资源
	}

	//验证功能
	public static function checkCaptcha($captcha){
		@session_start();
		return (strtolower($captcha) === strtolower($_SESSION["captcha"])); //不区分大小写
	}
}