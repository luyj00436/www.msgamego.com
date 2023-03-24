<?php
/**
 * 作者：Ms游戏库
 * 首页拖拽布局，高级筛选，会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 我愿向小三一样，做大哥的女人，做大哥在修改网页中最想日的一个。
 * 感谢支持，更好的更用心的等你来调教
 */


get_header();
?>
<div class="content-area">
    <main class="site-main">
        <?php $module_home = _cao('home_mode');
        if (!$module_home) {
            echo '<h2 style=" text-align: center; margin: 0 auto; padding: 60px; ">请前往后台-主题设置-设置首页模块！</h2>';
        }
        if ($module_home) {
            foreach ($module_home['enabled'] as $key => $value) {
                @get_template_part('parts/home-mode/' . $key);
            }
        }
        get_template_part('parts/home-mode/banner')
        ?>
    </main>
</div>
<?php get_footer(); ?>
