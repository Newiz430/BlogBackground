<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-22 16:39:07
  from 'D:\blog\app\home\view\Index\blogShow.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f40d9abcd25d7_55676561',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da0d98bfe76de941e975df16b666f6c0f608640a' => 
    array (
      0 => 'D:\\blog\\app\\home\\view\\Index\\blogShow.html',
      1 => 1598085371,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f40d9abcd25d7_55676561 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>博文内容</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link href="<?php echo P;?>
/css/app.css" rel="stylesheet" media="screen">
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/modernizr.custom.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/detectizr.min.js"><?php echo '</script'; ?>
>
</head>

<!-- Body -->
<body>
<!-- Page Wrapper -->
<div class="page-wrapper">
  <!-- Navbar -->
  <!-- Add class ".navbar-sticky" to make navbar stuck when it hits the top of the page. Another modifier class is: "navbar-fullwidth" to stretch navbar and make it occupy 100% of the page width. The screen width at which navbar collapses can be controlled through the variable "$nav-collapse" in sass/variables.scss -->
  <header class="navbar">

    <!-- Toolbar -->
    <div class="topbar">
      <div class="container">
        <a href="index.php" class="site-logo">
          博文前台
        </a><!-- .site-logo -->
      </div><!-- .container -->
    </div><!-- .topbar -->
  </header><!-- .navbar -->

  <!-- Page Title -->
  <!--Add modifier class : "pt-fullwidth" to stretch page title and make it occupy 100% of the page width. -->
  <section class="page-title">
    <div class="container">
      <div class="inner">
        <div class="column">
          <div class="title">
            <h1>博文内容</h1>
          </div><!-- .title -->
        </div><!-- .column -->
        <div class="column">
        </div><!-- .column -->
      </div>
    </div>
  </section><!-- .page-title -->

  <!-- Container -->
    <div class="container">

      <!-- Content -->
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <h1><?php echo $_smarty_tpl->tpl_vars['article']->value['a_title'];?>
</h1>
          <div class="post-meta">
            <div class="column">
              <span>
                <i class="icon-head"></i>
                <a href="#"><?php echo $_smarty_tpl->tpl_vars['article']->value['a_author'];?>
</a>
              </span>
              <span>在</span>
              <span>
                <i class="icon-ribbon"></i>
                <a href="#"><?php echo $_SESSION['categories'][$_smarty_tpl->tpl_vars['article']->value['c_id']]['c_name'];?>
</a>
              </span>
              <span>下发布</span>
              <span class="post-comments">
                <i class="icon-speech-bubble"></i>
                <a href="#">12</a>
              </span>
            </div>
            <div class="column"><span><?php echo date("Y/m/d",$_smarty_tpl->tpl_vars['article']->value['a_time']);?>
</span></div>
          </div><!-- .post-meta -->
          <?php if ($_smarty_tpl->tpl_vars['article']->value['a_img']) {?>
          <img src="<?php echo URL;?>
/uploads/<?php echo $_smarty_tpl->tpl_vars['article']->value['a_img'];?>
" alt="Image">
          <?php }?>
          <p><?php echo $_smarty_tpl->tpl_vars['article']->value['a_content'];?>
</p>
          <div class="post-tools space-top-2x">
            <div class="column">
              <div class="tags-links">
                <a href="#">美食</a>
                <a href="#">教程</a>
                <a href="#">厨艺</a>
              </div>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .post-tools -->
          <div class="post-tools space-top-2x">
            <div class="column"></div>
            <div class="column text-center">
              <a><i class="fa fa-thumbs-up dz" aria-hidden="true">（32）</i></a>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .post-tools -->

          <!-- Comments -->
          <div class="comments-area space-top-3x">
            <h4 class="comments-count">共有<?php echo count($_smarty_tpl->tpl_vars['comments']->value);?>
条评论</h4>

            <!-- Comment -->
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'com');
$_smarty_tpl->tpl_vars['com']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['com']->value) {
$_smarty_tpl->tpl_vars['com']->do_else = false;
?>
            <div class="comment">
              <div class="comment-meta">
                <div class="column">
                  <span class="comment-autor"><i class="icon-head"></i><a href="#"><?php echo $_smarty_tpl->tpl_vars['com']->value['u_username'];?>
</a></span>
                </div>
                <div class="column">
                  <span class="comment-date"><?php echo date("d-m-Y",$_smarty_tpl->tpl_vars['com']->value['c_time']);?>
</span>
                </div>
              </div><!-- .comment-meta -->
              <div class="comment-body">
                <p><?php echo $_smarty_tpl->tpl_vars['com']->value['c_comment'];?>
</p>
              </div><!-- .comment-body -->

            </div><!-- .comment -->
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            
            <!-- Comment Form -->
            <div class="comment-respond">
              <h4 class="comment-reply-title">发布新评论</h4>
              <form method="post" id="comment-form" class="comment-form" action="index.php?c=comment&a=insert">
                <input type="hidden" name="a_id" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
">
                <div class="form-group">
                  <label for="cf_comment" class="sr-only">Comment</label>
                  <textarea name="c_comment" id="cf_comment" class="form-control input-alt" rows="7" placeholder="输入您的评论"></textarea>
                </div>            
                <p class="form-submit">
                  <!-- 判定登录状态 -->
                  <?php if ((isset($_SESSION['user']))) {?>
                  <input name="submit" type="submit" id="submit" class="btn btn-primary btn-block" value="发布">
                  <?php } else { ?>
                  <input type="button" onclick="JavaScript:return false" class="btn btn-primary btn-block" value="请先登录才能发布评论！">
                  <?php }?>
                </p>
              </form>
            </div><!-- .comment-respond -->
          </div><!-- .comments-area -->
        </div><!-- .col-lg-9.col-md-8 -->
      </div><!-- .row -->
    </div><!-- .container -->

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->

    <!-- Footer -->
    <!-- Footer -->
    <footer class="footer">
      <div class="bottom-footer">
        <div class="container">
          <div class="copyright">
            <div class="column">
              <p>&copy; 2016. 保留所有权利。</p>
            </div><!-- .column -->
            <div class="column">
            </div><!-- .column -->
          </div><!-- .copyright -->
        </div><!-- .container -->
      </div><!-- .bottom-footer -->
    </footer><!-- .footer -->

  </div><!-- .page-wrapper -->

  <!-- JavaScript (jQuery) libraries, plugins and custom scripts -->
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/jquery-2.1.4.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/bootstrap.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/waves.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/placeholder.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/waypoints.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/vendor/velocity.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="<?php echo P;?>
/js/scripts.js"><?php echo '</script'; ?>
>
</body><!-- <body> -->
</html>
<?php }
}
