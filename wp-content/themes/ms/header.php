<?php
/**
 * 作者：Ms游戏库
 * 首页拖拽布局，高级筛选，会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 我愿向小三一样，做大哥的女人，做大哥在修改网页中最想日的一个。
 * 感谢支持，更好的更用心的等你来调教
 */


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="<?php echo _cao('site_favicon') ?>" rel="icon">
    <link rel='stylesheet' id='app-css'
          href='https://www.msgamego.com/wp-content/themes/ms/assets/css/apps.css?ver=1.0.0' type='text/css'
          media='all'/>
    <title><?php echo _title() ?></title>

    <?php wp_head(); ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri() ?>/assets/js/html5shiv.js"></script>
      <script src="<?php echo get_template_directory_uri() ?>/assets/js/respond.min.js"></script>
    <![endif]-->
    <?php if (_cao('is_header_loaing', '0')) { ?>
        <script> $(document).ready(function () {
                NProgress.start();
                $(window).load(function () {
                    NProgress.done();
                });
            });</script>
    <?php } ?>
</head>

<body <?php body_class(); ?>>

<div class="site">
    <?php
    get_template_part('parts/navbar');
    if (is_archive() || is_search() || is_page_template()) {
        get_template_part('parts/term-bar');
    }
    ?>
    <div class="site-content">
    
