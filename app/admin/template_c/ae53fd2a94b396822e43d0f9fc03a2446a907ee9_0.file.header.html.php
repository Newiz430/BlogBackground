<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-22 18:19:02
  from 'D:\blog\app\admin\view\Public\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f40f1162978a5_11794593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae53fd2a94b396822e43d0f9fc03a2446a907ee9' => 
    array (
      0 => 'D:\\blog\\app\\admin\\view\\Public\\header.html',
      1 => 1598087384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f40f1162978a5_11794593 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="header">
    	<!-- logo -->
    	<div class="logo">	<a href="index.php?p=admin"><span class="logo-text text-center font18">博客后台</span></a>	</div>

        <!-- notifications -->
        <div id="notifications">
          <div class="clear"></div>
        </div>

        <!-- quick menu -->
        <div id="quickmenu">
            <a href="index.php?p=admin&c=article&a=add" class="qbutton-left tips" title="新增一篇博客"><img src="<?php echo P;?>
/img/icons/header/newpost.png" width="18" height="14" alt="new post" /></a>
            <a href="index.php" class="qbutton-right tips" title="直达前台"><img src="<?php echo P;?>
/img/icons/sidemenu/magnify.png" width="18" height="14" alt="new post" /></a>
            <div class="clear"></div>
        </div>

        <!-- profile box -->
        <div id="profilebox">
        	<a href="#" class="display">
            	<img src="<?php echo P;?>
/img/simple-profile-img.jpg" width="33" height="33" alt="profile"/> <span><?php if ($_SESSION['user']['u_is_admin']) {?>管理员<?php } else { ?>用户<?php }?></span> <b>昵称：<?php echo $_SESSION['user']['u_username'];?>
</b> 
                <!-- 用session会话数据判断用户是管理员还是普通用户，并显示用户信息 -->
            </a>
            <div class="profilemenu">
            	<ul>
                	<li><a href="<?php echo URL;?>
/index.php?p=admin&c=Privilege&a=logout">退出</a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div><?php }
}
