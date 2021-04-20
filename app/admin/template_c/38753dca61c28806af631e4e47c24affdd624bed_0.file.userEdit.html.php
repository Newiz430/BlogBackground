<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-21 19:53:15
  from 'D:\blog\app\admin\view\user\userEdit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f3fb5abc92da3_42106852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '38753dca61c28806af631e4e47c24affdd624bed' => 
    array (
      0 => 'D:\\blog\\app\\admin\\view\\user\\userEdit.html',
      1 => 1598010791,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../Public/header.html' => 1,
    'file:../Public/sidebar.html' => 1,
    'file:../Public/footer.html' => 1,
  ),
),false)) {
function content_5f3fb5abc92da3_42106852 (Smarty_Internal_Template $_smarty_tpl) {
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
<div class="wrapper">

    <!-- START HEADER -->
    <?php $_smarty_tpl->_subTemplateRender("file:../Public/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <!-- END HEADER -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START SIDEBAR -->
        <?php $_smarty_tpl->_subTemplateRender("file:../Public/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <!-- END SIDEBAR -->

        <!-- START PAGE -->
        <div id="page">
            <!-- start page title -->
            <div class="page-title">
                <div class="in">
                    <div class="titlebar">	<h2>用户管理</h2>	<p>编辑用户</p></div>

                    <div class="clear"></div>
                </div>
            </div>
            <!-- end page title -->

            <!-- START CONTENT -->
            <div class="content">
                <div class="simplebox grid740" style="z-index: 720;">
                    <div class="titleh" style="z-index: 710;">
                        <h3>编辑用户</h3>
                    </div>
                    <div class="body" style="z-index: 690;">

                        <form id="form2" name="form2" method="post" action="index.php?p=admin&c=user&a=update">
                            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['users']->value['id'];?>
">
                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">用户名</span>
                                <input name="u_username" type="text" class="st-forminput" style="width:510px" value="<?php echo $_smarty_tpl->tpl_vars['users']->value['u_username'];?>
">
                                <div class="clear" style="z-index: 670;"></div>
                            </div>
                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">角色</span>
                                <label class="margin-right10"><input type="radio" name="u_is_admin" value="0" <?php if ($_smarty_tpl->tpl_vars['users']->value['u_is_admin'] == 0) {?> checked="checked" <?php }?> class="uniform"/>普通用户</label>
                                <label class="margin-right10"><input type="radio" name="u_is_admin" value="1" <?php if ($_smarty_tpl->tpl_vars['users']->value['u_is_admin'] == 1) {?> checked="checked" <?php }?> class="uniform"/> 管理员</label>
                                <div class="clear" style="z-index: 670;"></div>
                            </div>

                            <div class="st-form-line" style="z-index: 680;">
                                <span class="st-labeltext">设置新密码(不设置请留空)</span>
                                <input name="u_password" type="password" class="st-forminput" style="width:510px" value="">
                                <div class="clear" style="z-index: 670;"></div>
                            </div>

                            <div class="button-box" style="z-index: 460;">
                                <input type="submit" id="button" value="提交" class="st-button">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END PAGE -->
        <div class="clear"></div>
    </div>
    <!-- END MAIN -->

    <!-- START FOOTER -->
    <?php $_smarty_tpl->_subTemplateRender("file:../Public/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <!-- END FOOTER -->
</div>
</body>
</html><?php }
}
