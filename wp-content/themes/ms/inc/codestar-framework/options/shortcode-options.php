<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = 'csf_demo_shortcodes';

//
// Create a shortcoder
//
CSF::createShortcoder($prefix, array(
    'button_title' => '添加付费隐藏内容',
    'select_title' => '选择添加的内容块',
    'insert_title' => '插入简码',
    'show_in_editor' => true,
    'gutenberg' => array(
        'title' => 'RiPro主题简码',
        'description' => 'RiPro主题简码块',
        'icon' => 'screenoptions',
        'category' => 'widgets',
        'keywords' => array('shortcode', 'csf', 'insert'),
        'placeholder' => '在这里写短代码...',
    ),
));

//
// A shortcode [rihide]隐藏部分付费内容[/rihide]
//
CSF::createSection($prefix, array(
    'title' => '[rihide] 隐藏部分付费内容',
    'view' => 'normal',
    'shortcode' => 'rihide',
    'fields' => array(

        array(
            'id' => 'content',
            'type' => 'wp_editor',
            'title' => '',
            'desc' => '[rihide]隐藏部分付费内容[/rihide] <br/> 注意：添加隐藏内容后，因为公用价格和折扣字段，所有资源类型优先为付费查看内容模式，侧边栏下载资源小工具将不显示',
        ),

    ),
));

/**
 * [shop_shortcode 付费查看部分内容]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T13:10:24+0800
 * @param    [type]                   $atts    [description]
 * @param    [type]                   $content [description]
 * @return   [type]                            [description]
 */
function shop_shortcode($atts, $content)
{
    global $post, $wpdb;
    $user_id = is_user_logged_in() ? wp_get_current_user()->ID : 0;
    $atts = shortcode_atts(array(
        'id' => 0,
    ), $atts, 'rihide');
    $post_id = $post->ID;
    if ($atts['id']) {
        $post_id = $atts['id'];
    }
    $CaoUser = new CaoUser($user_id);
    // meta init
    $cao_price = get_post_meta($post_id, 'cao_price', true);
    $cao_vip_rate = get_post_meta($post_id, 'cao_vip_rate', true);
    $cao_paynum = get_post_meta($post_id, 'cao_paynum', true);
    $cao_is_boosvip = get_post_meta($post_id, 'cao_is_boosvip', true);
    $cao_close_novip_pay = get_post_meta($post_id, 'cao_close_novip_pay', true);
    $site_vip_name = _cao('site_vip_name');
    $site_money_ua = _cao('site_money_ua');
    if ($CaoUser->vip_status()) {
        $cao_this_am = ($cao_price * $cao_vip_rate) . $site_money_ua;
    } else {
        $cao_this_am = $cao_price . $site_money_ua;
    }
    // 优惠信息
    switch ($cao_vip_rate) {
        case 1:
            $rate_text = '暂无优惠';
            break;
        case 0:
            $rate_text = $site_vip_name . '免费';
            break;
        default:
            $rate_text = $site_vip_name . '价 ' . ($cao_vip_rate * 10) . ' 折';
    }
    if ($cao_is_boosvip) {
        $rate_text = $rate_text . ' 永久' . $site_vip_name . '免费';
    }

    $close_novip_pay_str = ($cao_close_novip_pay) ? '专属资源仅限会员可以购买，普通用户无权购买。' : '';

    $RiProPayAuth = new RiProPayAuth($user_id, $post_id);
    switch ($RiProPayAuth->ThePayAuthStatus()) {
        case 11: //免登陆  已经购买过 输出OK
            $do_shortcode = '<div class="content-hide-tips"><i class="fa fa-unlock-alt"></i>'; //原始内容
            $do_shortcode .= do_shortcode($content); //原始内容
            $do_shortcode .= '</div>'; //原始内容
            break;
        case 12: //免登陆  登录后查看
            if (!_cao('is_ripro_free_no_login')) {
                $do_shortcode = '<div class="content-hide-tips"><i class="fa fa-lock"></i>';
                $do_shortcode .= '<span class="rate label label-warning">登录后免费查看</span>';
                $do_shortcode .= '<div class="login-false">当前隐藏内容需登录后查看';
                $do_shortcode .= '<div class="coin"><span class="label label-warning">免费</span></div>';
                $do_shortcode .= '</div>';
                $do_shortcode .= '<p class="t-c">已有<span class="red">' . _get_post_views() . '</span>人阅读</p>';
                $do_shortcode .= '<div class="pc-button">';
                $do_shortcode .= '<button type="button" class="login-btn btn btn--primary"><i class="fa fa-user"></i> 登录后查看</button>';
                $do_shortcode .= '</div>';
                $do_shortcode .= '</div>';
            } else {
                $do_shortcode = '<div class="content-hide-tips"><i class="fa fa-unlock-alt"></i>'; //原始内容
                $do_shortcode .= do_shortcode($content); //原始内容
                $do_shortcode .= '</div>'; //原始内容
            }

            break;
        case 13: //免登陆 输出购买按钮信息
            $create_nonce = wp_create_nonce('caopay-' . $post_id);
            $do_shortcode = '<div class="content-hide-tips"><i class="fa fa-lock"></i>';
            $do_shortcode .= '<span class="rate label label-warning">' . $rate_text . '</span>';
            $do_shortcode .= '<div class="login-false">' . $close_novip_pay_str . '当前隐藏内容需要支付';
            $do_shortcode .= '<div class="coin"><span class="label label-warning">' . $cao_this_am . '</span></div>';
            $do_shortcode .= '</div>';
            $do_shortcode .= '<p class="t-c">已有<span class="red">' . $cao_paynum . '</span>人支付</p>';
            $do_shortcode .= '<div class="pc-button">';
            if ($cao_close_novip_pay && !$CaoUser->vip_status()) {
                $do_shortcode .= '<button type="button" class="btn btn--secondary disabled"><i class="fa fa-money"></i> 仅会员可购买</button>';
            } else {
                $do_shortcode .= '<button type="button" class="click-pay btn btn--secondary" data-postid="' . $post_id . '" data-nonce="' . $create_nonce . '" data-price="' . $cao_this_am . '"><i class="fa fa-money"></i> 支付查看</button>';
            }
            $do_shortcode .= '</div>';
            $do_shortcode .= '</div>';
            break;
        case 21: //登陆后  已经购买过 输出OK
            $do_shortcode = '<div class="content-hide-tips"><i class="fa fa-unlock-alt"></i>'; //原始内容
            $do_shortcode .= do_shortcode($content); //原始内容
            $do_shortcode .= '</div>'; //原始内容
            break;
        case 22: //登陆后  输出购买按钮信息
            $create_nonce = wp_create_nonce('caopay-' . $post_id);
            $do_shortcode = '<div class="content-hide-tips"><i class="fa fa-lock"></i>';
            $do_shortcode .= '<span class="rate label label-warning">' . $rate_text . '</span>';
            $do_shortcode .= '<div class="login-false">' . $close_novip_pay_str . '当前隐藏内容需要支付';
            $do_shortcode .= '<div class="coin"><span class="label label-warning">' . $cao_this_am . '</span></div>';
            $do_shortcode .= '</div>';
            $do_shortcode .= '<p class="t-c">已有<span class="red">' . $cao_paynum . '</span>人支付</p>';
            $do_shortcode .= '<div class="pc-button">';
            if ($cao_close_novip_pay && !$CaoUser->vip_status()) {
                $do_shortcode .= '<button type="button" class="btn btn--secondary disabled"><i class="fa fa-money"></i> 仅会员可购买</button>';
            } else {
                $do_shortcode .= '<button type="button" class="click-pay btn btn--secondary" data-postid="' . $post_id . '" data-nonce="' . $create_nonce . '" data-price="' . $cao_this_am . '"><i class="fa fa-money"></i> 立即购买</button>';
            }
            $do_shortcode .= '</div>';
            $do_shortcode .= '</div>';
            break;
        case 31: //没有开启免登录 没有登录 输出登录后进行操作
            $do_shortcode = '<div class="content-hide-tips"><i class="fa fa-lock"></i>';
            $do_shortcode .= '<span class="rate label label-warning">' . $rate_text . '</span>';
            $do_shortcode .= '<div class="login-false">当前隐藏内容需要支付';
            $do_shortcode .= '<div class="coin"><span class="label label-warning">' . $cao_this_am . '</span></div>';
            $do_shortcode .= '</div>';
            $do_shortcode .= '<p class="t-c">已有<span class="red">' . $cao_paynum . '</span>人支付</p>';
            $do_shortcode .= '<div class="pc-button">';
            $do_shortcode .= '<button type="button" class="login-btn btn btn--primary"><i class="fa fa-user"></i> 登录购买</button>';
            $do_shortcode .= '</div>';
            $do_shortcode .= '</div>';
            break;
    }
    return $do_shortcode;

}

add_shortcode('rihide', 'shop_shortcode');
