<?php
/**
 * 作者：Ms游戏库
 * 首页拖拽布局，高级筛选，会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 我愿向小三一样，做大哥的女人，做大哥在修改网页中最想日的一个。
 * 感谢支持，更好的更用心的等你来调教
 */


header('Content-type:text/html; Charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
ob_start();
require_once dirname(__FILE__) . "../../../../../../wp-load.php";
ob_end_clean();
require_once get_template_directory() . '/inc/class/xunhupay.class.php';

//未启用接口时禁止访问跳回首页
if (!_cao('is_xunhupay_wx')) {
    wp_safe_redirect(home_url());
    exit;
}


// 获取后台支付配置
$XHpayConfig = _cao('xunhupay_wx');
$data = (array)json_decode(file_get_contents('php://input'));
if (!$data) {
    exit('faild!');
}
$private_key = $XHpayConfig['private_key'];
$out_trade_no = isset($data['out_trade_no']) ? $data['out_trade_no'] : null;
$order_id = isset($data['order_id']) ? $data['order_id'] : null;
$hash = XH_Payment_Api::generate_xh_hash_new($data, $private_key);
if ($data['sign'] != $hash) {
    //签名验证失败
    echo 'failed';
    exit;
}
if ($data['status'] == 'complete') {
    $RiProPay = new RiProPay;
    $RiProPay->send_order_trade_success($out_trade_no, $order_id, 'ripropaysucc');
    print 'success';
    exit();
} else {
    //处理未支付的情况
}
//以下是处理成功后输出，当支付平台接收到此消息后，将不再重复回调当前接口
print 'success';
exit;