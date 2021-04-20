<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-22 18:52:28
  from 'D:\blog\app\admin\view\Public\sidebar.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f40f8ec4db158_36398803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87ca26b88478da405cbfed01f3aaaedc4de78b3e' => 
    array (
      0 => 'D:\\blog\\app\\admin\\view\\Public\\sidebar.html',
      1 => 1598091957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f40f8ec4db158_36398803 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="sidebar">
            <div id="searchbox" style="z-index: 880;">
                <div class="in" style="z-index: 870;">
                    <p class="text-center font18 line-height35">此广告位常年招商</p>
                </div>
            </div>
            <!-- start sidemenu -->
            <div id="sidemenu">
            	<ul>
                	<li <?php if (strtolower(C) == "index") {?>class="active"<?php }?>><a href="index.php?p=admin&c=index&a=index"><img src="<?php echo P;?>
/img/icons/sidemenu/laptop.png" width="16" height="16" alt="icon"/>控制面板</a></li>
                	<?php if ($_SESSION['user']['u_is_admin']) {?>
                    <!-- 分类管理 -->
                    <li class="subtitle">
                        <a class="action tips-right" href="#" title="分类管理"><img src="<?php echo P;?>
/img/icons/sidemenu/key.png" width="16" height="16" alt="icon"/>分类管理<img src="<?php echo P;?>
/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" /></a>
                        <ul class="submenu display-block">
                            <li <?php if (strtolower(C) == "category" && (strtolower(A) == "index" || strtolower(A) == "edit")) {?>class="active"<?php }?>><a href="index.php?p=admin&c=category"><img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>分类列表</a></li>
                            
                            <li <?php if (strtolower(C) == "category" && strtolower(A) == "add") {?>class="active"<?php }?>><a href="index.php?p=admin&c=category&a=add"><img src="<?php echo P;?>
/img/icons/sidemenu/file_add.png" width="16" height="16" alt="icon"/>添加分类</a></li>
                        </ul>
                    </li>
                    <!-- 分类管理 -->
					<?php }?>
                    <!-- 博文管理 -->
                    <li class="subtitle">
                    	<a class="action tips-right" href="#" title="博文管理"><img src="<?php echo P;?>
/img/icons/sidemenu/mail.png" width="16" height="16" alt="icon"/>博文管理<img src="<?php echo P;?>
/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" /></a>
                    	<ul class="submenu display-block">
                    	<li <?php if (strtolower(C) == "article" && (strtolower(A) == "index" || strtolower(A) == "edit")) {?>class="active"<?php }?>><a href="index.php?p=admin&c=article"><img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>博文列表</a></li>
                        <li <?php if (strtolower(C) == "article" && strtolower(A) == "add") {?>class="active"<?php }?>><a href="index.php?p=admin&c=article&a=add"><img src="<?php echo P;?>
/img/icons/sidemenu/file_add.png" width="16" height="16" alt="icon"/>添加博文</a></li>
                        </ul>
                    </li>
                    <!-- 博文管理 -->
                    <?php if ($_SESSION['user']['u_is_admin']) {?>
                    <!-- 用户管理 -->
                    <li class="subtitle">
                        <a class="action tips-right" href="#" title="用户管理"><img src="<?php echo P;?>
/img/icons/sidemenu/user.png" width="16" height="16" alt="icon"/>用户管理<img src="<?php echo P;?>
/img/arrow-down.png" width="7" height="4" alt="arrow" class="arrow" /></a>
                        <ul class="submenu display-block">
                        	<li <?php if (strtolower(C) == "user" && (strtolower(A) == "index" || strtolower(A) == "edit")) {?>class="active"<?php }?>><a href="index.php?p=admin&c=user"><img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>用户列表</a></li>
                            <li <?php if (strtolower(C) == "user" && strtolower(A) == "add") {?>class="active"<?php }?>><a href="index.php?p=admin&c=user&a=add"><img src="<?php echo P;?>
/img/icons/sidemenu/user_add.png" width="16" height="16" alt="icon"/>添加用户</a></li>
                        </ul>
                    </li>
                    <!-- 用户管理 -->
                    <?php }?>
                    <!-- 评论管理 -->
                    <li <?php if (strtolower(C) == "comment") {?>class="active"<?php }?>><a href="index.php?p=admin&c=comment"><img src="<?php echo P;?>
/img/icons/sidemenu/file.png" width="16" height="16" alt="icon"/>评论列表</a></li>
                    <!-- 评论管理 -->
                </ul>
            </div>
            <!-- end sidemenu -->
        </div><?php }
}
