<?php
/**
 * 作者：Ms游戏库
 * 首页拖拽布局，高级筛选，会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 我愿向小三一样，做大哥的女人，做大哥在修改网页中最想日的一个。
 * 感谢支持，更好的更用心的等你来调教
 */


//码支付
header('Content-type:text/html; Charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
ob_start();
require_once dirname(__FILE__) . "../../../../../../wp-load.php";
ob_end_clean();

if (!_cao('is_codepay')) {
    wp_safe_redirect(home_url());
    exit;
}

// 获取后台支付配置
$codepayConfig = _cao('codepay');
$mzf_appid = $codepayConfig['mzf_appid']; //appid
$mzf_secret = $codepayConfig['mzf_secret']; //secret
if (empty($mzf_appid) || empty($mzf_secret)) {
    wp_safe_redirect(home_url());
    exit;
}

ksort($_POST); //排序post参数
reset($_POST); //内部指针指向数组中的第一个元素

$sign = '';//初始化
foreach ($_POST as $key => $val) { //遍历POST参数
    if ($val == '' || $key == 'sign') continue; //跳过这些不签名
    if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
    $sign .= "$key=$val"; //拼接为url参数形式
}

if (!$_POST['pay_no'] || md5($sign . $mzf_secret) != $_POST['sign']) { //不合法的数据
    exit('fail');  //返回失败 继续补单
} else {
    //商户本地订单号
    $out_trade_no = $_POST['pay_id'];
    //交易号
    $trade_no = $_POST['pay_no'];
    //发送支付成功回调用
    $RiProPay = new RiProPay;
    $RiProPay->send_order_trade_success($out_trade_no, $trade_no, 'ripropaysucc');
    echo 'success';
    exit();
}