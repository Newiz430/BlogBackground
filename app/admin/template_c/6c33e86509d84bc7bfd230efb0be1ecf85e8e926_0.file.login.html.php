<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-16 21:14:01
  from 'D:\blog\app\admin\view\Privilege\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f3931191bf6e1_55353852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c33e86509d84bc7bfd230efb0be1ecf85e8e926' => 
    array (
      0 => 'D:\\blog\\app\\admin\\view\\Privilege\\login.html',
      1 => 1597583160,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f3931191bf6e1_55353852 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>博客后台</title>
	<link rel="stylesheet" type="text/css" href="<?php echo P;?>
/css/app.css" />
	<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo P;?>
/js/app.js"><?php echo '</script'; ?>
>
</head>
<body>
    <div class="loginform">
    	<div class="title"> <span class="logo-text font18">博客后台管理系统</span></div>
        <div class="body">
       	  <form id="form1" name="form1" method="post" action="index.php?p=admin&c=Privilege&a=check">
          	<label class="log-lab">用户名</label>
            <input name="u_username" type="text" class="login-input-user" id="textfield" value=""/>
          	<label class="log-lab">密码</label>
            <input name="u_password" type="password" class="login-input-pass" id="textfield" value=""/>
			<label class="log-lab">验证码</label>
			<div class="padding-bottom5"><img src="index.php?p=admin&c=Privilege&a=captcha" width="220" height="30" 
        onclick="this.src='index.php?p=admin&c=Privilege&a=captcha&'+Math.random()"></div> <!-- 用js语法添加点击切换功能 -->
			<input name="captcha" type="text" class="login-input" id="textfield" value=""/>
			<label class="log-lab"><input type="checkbox" name="rememberMe" class="uniform"> 7天内自动登录</label>
            <input type="submit" name="button" id="button" value="登录" class="button"/>
       	  </form>
        </div>
    </div>
</div>
</body>
</html><?php }
}
