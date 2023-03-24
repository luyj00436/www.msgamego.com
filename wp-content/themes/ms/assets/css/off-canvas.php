<?php
$menu_class = 'mobile-menu';
if (cao_compare_options(_cao('navbar_hidden', false), rwmb_meta('navbar_hidden')) == false) {
    $menu_class .= ' hidden-lg hidden-xl';
}
$logo_regular = _cao('site_logo');
?>


<?php
global $current_user;
$CaoUser = new CaoUser($current_user->ID);
$site_money_ua = _cao('site_money_ua');
?>


<div class="off-canvas">
    <div class="canvas-close"><i class="mdi mdi-close"></i></div>
    <div class="<?php echo esc_attr($menu_class); ?>"></div>


    <div class="header-top">
        <?php echo get_avatar($current_user->user_email); ?>
        <div class="">
              <span>
                <a class="user-names"
                   href="<?php echo esc_url(home_url('/user')) ?>"><?php echo $current_user->display_name; ?></a>
                  <?php echo ' <i class="wp wp-VIP"> ' . $CaoUser->vip_name() . ' </i>'; ?>
                  <?php echo ' <i class="group-name"> ' . $CaoUser->vip_end_time() . '</i> '; ?>
              </span>
            <p id="buy-vip" rel-vipid="3">
                <?php
                if ($CaoUser->vip_status()) {
                    echo '尊敬的' . $CaoUser->vip_name() . '会员您好，欢迎回来！';
                } else {
                    echo '加入' . _cao('site_vip_name') . '，享受折扣下载全站资源。';
                }
                ?>
            </p>
        </div>
        <a href="<?php echo wp_logout_url(home_url()); ?>" class="logout">退出</a>
    </div>
    <div class="header-center">
        <div class="md-l">
            <span class="md-tit">我的钱包</span>
            <span class="jinbi"
                  title="现有余额：<?php echo $CaoUser->get_balance(); ?>"><i></i>现有余额：<?php echo $CaoUser->get_balance(); ?> </span>
            <span class="dou"
                  title="消费金额：<?php echo $CaoUser->get_consumed_balance(); ?>"><i></i>消费金额：<?php echo $CaoUser->get_consumed_balance(); ?></span>
            <a href="/user?action=charge" class="pay-credit">充值</a>
        </div>
        <div class="md-r">
            <div class="md-t">
                <span><?php echo _cao('site_vip_name'); ?>会员</span>
                <?php
                if ($CaoUser->vip_status()) {
                    echo '<p>到期时间：' . $CaoUser->vip_end_time() . '</p><a href="/user?action=vip" class="pay-vip">续费</a>';
                } else {
                    echo '<p>' . _cao('navbar_newhover_text1') . '</p><a href="/user?action=vip" class="pay-vip">开通</a>';
                }
                ?>
            </div>
            <div class="md-b">
                <span>永久<?php echo _cao('site_vip_name'); ?>会员</span>
                <?php if (is_boosvip_status($current_user->ID)) {
                    echo '您已开通永久' . _cao('site_vip_name') . '特权';
                } else {
                    echo '<p>' . _cao('navbar_newhover_text2') . '</p><a href="/user?action=vip" class="pay-vip">升级</a>';
                } ?>


            </div>
        </div>
    </div>


    <aside class="widget-area">
        <?php dynamic_sidebar('off_canvas'); ?>
    </aside>
</div>