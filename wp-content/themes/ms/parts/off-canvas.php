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
    <?php
    if (!is_user_logged_in() || !is_site_shop_open()) {
        ?>


        <div class="mobile-menu hidden-lg hidden-xl">
            <div class="slicknav_menu"><a href="#" aria-haspopup="true" role="button" tabindex="0"
                                          class="slicknav_btn slicknav_collapsed" style="outline: none;"><span
                            class="slicknav_menutxt"></span><span class="slicknav_icon slicknav_no-text"><span
                                class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span
                                class="slicknav_icon-bar"></span></span></a>
                <ul class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">

                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-5379 slicknav_collapsed slicknav_parent">
                        <div class="login-btn navbar-button"><i class="mdi mdi-account"></i> 点击登录</div>
                    </li>
                </ul>
            </div>
        </div>


        <?php
    } else {
        ?>
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
                <span class="jinbi" title="现有余额：<?php echo $CaoUser->get_balance(); ?>"><i></i><font
                            color="#FFFFFF">现有余额：<?php echo $CaoUser->get_balance(); ?></font> </span>
                <span class="dou" title="消费金额：<?php echo $CaoUser->get_consumed_balance(); ?>"><i></i><font
                            color="#FFFFFF">消费金额：<?php echo $CaoUser->get_consumed_balance(); ?></font></span>
                <a href="/user?action=charge" class="pay-credit">充值</a>
            </div>
            <div class="md-r">
                <div class="md-t">
                    <span><?php echo _cao('site_vip_name'); ?>会员</span>
                    <?php
                    if ($CaoUser->vip_status()) {
                        echo '<font color="#FFFFFF"><p>到期时间：' . $CaoUser->vip_end_time() . '</p><a href="/user?action=vip" class="pay-vip">续费</a</font>>';
                    } else {
                        echo '<font color="#FFFFFF"><p>' . _cao('navbar_newhover_text1') . '</p><a href="/user?action=vip" class="pay-vip">开通</a></font>';
                    }
                    ?>
                </div>
                <div class="md-b">
                    <span>永久<?php echo _cao('site_vip_name'); ?>会员</span>
                    <?php if (is_boosvip_status($current_user->ID)) {
                        echo '<font color="#FFFFFF">您已开通永久' . _cao('site_vip_name') . '特权</font>';
                    } else {
                        echo '<font color="#FFFFFF"><p>' . _cao('navbar_newhover_text2') . '</p><a href="/user?action=vip" class="pay-vip">升级</a></font>';
                    } ?>


                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <aside class="widget-area">
        <?php dynamic_sidebar('off_canvas'); ?>
    </aside>
</div>