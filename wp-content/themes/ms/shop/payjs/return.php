<?php
/**
 * 作者：Ms游戏库
 * 首页拖拽布局，高级筛选，会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 我愿向小三一样，做大哥的女人，做大哥在修改网页中最想日的一个。
 * 感谢支持，更好的更用心的等你来调教
 */

/**
 * 微信同步回调
 */

header('Content-type:text/html; Charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
ob_start();
require_once dirname(__FILE__) . "../../../../../../wp-load.php";
ob_end_clean();
if (!_cao('is_payjs')) {
    wp_safe_redirect(home_url());
    exit;
}