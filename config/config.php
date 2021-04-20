<?php
// /config/config.php

return array(
	//数据库配置
	"database" => array(
		"type" => "mysql",
		"host" => "localhost",
		"port" => "3306",
		"user" => "root",
		"pass" => "root",
		"charset" => "utf8",
		"dbname" => "BLOG",
		"prefix" => "b_" //表前缀
	),

	"drivers" => array(),
		
	"system" => array(
		"error_reporting" => E_ALL, //默认显示所有错误
		"display_errors" => 1 //错误显示控制	（0为隐藏，1为显示）
	),	
);