<?php
/**
 * 作者：Ms游戏库
 * 首页拖拽布局，高级筛选，会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 我愿向小三一样，做大哥的女人，做大哥在修改网页中最想日的一个。
 * 感谢支持，更好的更用心的等你来调教
 */


/**
 * 支付宝异步通知Mapi
 */

header('Content-type:text/html; Charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
ob_start();
require_once dirname(__FILE__) . "../../../../../../wp-load.php";
ob_end_clean();


if (!_cao('is_alipay')) {
    wp_safe_redirect(home_url());
    exit;
}


if (empty($_POST)) {
    wp_die('<meta charset="UTF-8" />非法请求');
}

// 获取后台支付宝配置
$aliPayConfig = _cao('alipay');

if (empty($aliPayConfig['md5Key'])) {
    wp_safe_redirect(home_url());
    exit;
}

// 初始化变量 $this_verify
$this_verify = false;

// mapi模式公共配置
$params = new \Yurun\PaySDK\Alipay\Params\PublicParams;
$params->md5Key = $aliPayConfig['md5Key'];
// SDK实例化，传入公共配置
$pay = new \Yurun\PaySDK\Alipay\SDK($params);
if ($pay->verifyCallback($_POST)) {
    // 模式2通知验证成功，可以通过POST参数来获取支付宝回传的参数
    $this_verify = true;
} else {
    $this_verify = false;
}
//商户本地订单号
$out_trade_no = $_POST['out_trade_no'];
//支付宝交易号
$trade_no = $_POST['trade_no'];


// 处理本地业务逻辑
if ($this_verify && $_POST['trade_status'] == 'TRADE_SUCCESS') {
    //发送支付成功回调用
    $RiProPay = new RiProPay;
    $RiProPay->send_order_trade_success($out_trade_no, $trade_no, 'ripropaysucc');
    echo 'success';
    exit();
} else {
    // 输出错误日志 可以在生产环境关闭 注释即可
    echo "error";
    exit();
}
exit();
