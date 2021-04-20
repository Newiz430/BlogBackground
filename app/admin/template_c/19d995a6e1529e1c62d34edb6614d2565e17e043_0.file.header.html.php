<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-09 14:14:18
  from 'D:\blog\app\admin\view\Public\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f5872ba1c9693_16515531',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19d995a6e1529e1c62d34edb6614d2565e17e043' => 
    array (
      0 => 'D:\\blog\\app\\admin\\view\\Public\\header.html',
      1 => 1598093806,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f5872ba1c9693_16515531 (Smarty_Internal_Template $_smarty_tpl) {
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
/img/default-user.jpg" width="33" height="33" alt="profile"/> <span><?php if ($_SESSION['user']['u_is_admin']) {?>管理员<?php } else { ?>用户<?php }?></span> <b>昵称：<?php echo $_SESSION['user']['u_username'];?>
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
