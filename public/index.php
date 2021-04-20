<?php
// /public/index.php

//入口标记
define("ACCESS", true); 
//上级目录常量，把反斜杠转换为正斜杠
define("ROOT_PATH", str_replace('\\', '/', dirname(__dir__) . '/'));
//加载初始化文件
include ROOT_PATH."core/App.php";
//激活初始化文件(App类位于core命名空间)
\core\App::start();