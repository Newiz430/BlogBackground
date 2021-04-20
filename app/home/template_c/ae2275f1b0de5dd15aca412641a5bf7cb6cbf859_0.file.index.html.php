<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-15 14:12:00
  from 'D:\phpstudy_pro\WWW\mvc\app\home\view\Index\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f377cb0686597_47776439',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae2275f1b0de5dd15aca412641a5bf7cb6cbf859' => 
    array (
      0 => 'D:\\phpstudy_pro\\WWW\\mvc\\app\\home\\view\\Index\\index.html',
      1 => 1597402152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f377cb0686597_47776439 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<!-- /app/home/view/Index/index.html -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Class</title>
	<style>
		div {
			width: 200px;
			height: 200px;
			padding: 10px;
			background-color: cyan;
			margin: 0 auto;
		}
		* {
			background-color: black;
		}
	</style>
</head>
<body>
	<div>
		My class info:<br/>
		ID: <?php echo $_smarty_tpl->tpl_vars['res']->value['ID'];?>
<br/>
		Name: <?php echo $_smarty_tpl->tpl_vars['res']->value['name'];?>
 <!-- Smarty语法，显示从表中获得的记录的ID和name值 -->
	</div>
</body>
</html><?php }
}
