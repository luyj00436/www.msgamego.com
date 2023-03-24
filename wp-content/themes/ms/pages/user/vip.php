<?php
// 开通会员
global $current_user;
$CaoUser = new CaoUser($current_user->ID);
$post_id = cao_get_page_by_slug('user');
$create_nonce = wp_create_nonce('caopay-' . $post_id);


/**
 * 数字转换为中文
 * @param integer $num 目标数字
 */
function number2chinese($num)
{
    if (is_int($num) && $num < 100) {
        $char = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
        $unit = ['', '十', '百', '千', '万'];
        $return = '';
        if ($num < 10) {
            $return = $char[$num];
        } elseif ($num % 10 == 0) {
            $firstNum = substr($num, 0, 1);
            if ($num != 10) $return .= $char[$firstNum];
            $return .= $unit[strlen($num) - 1];
        } elseif ($num < 20) {
            $return = $unit[substr($num, 0, -1)] . $char[substr($num, -1)];
        } else {
            $numData = str_split($num);
            $numLength = count($numData) - 1;
            foreach ($numData as $k => $v) {
                if ($k == $numLength) continue;
                $return .= $char[$v];
                if ($v != 0) $return .= $unit[$numLength - $k];
            }
            $return .= $char[substr($num, -1)];
        }
        return $return;
    }
}

?>
<style>
    .payvip-box .vip-info {
        position: relative;
        text-align: center;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        padding: 22px 0 20px;
        margin-bottom: 30px;
        border: 5px solid;
        border-color: transparent;
        /* opacity: 0.3; */
        cursor: pointer;
    }

    .payvip-box .vip-info p {
        color: #000 !important;
        margin: 0;
        padding: 10px;
        /* text-shadow: 0 -1px 0 rgb(0 0 0 / 10%); */
    }

    .payvip-box .vip-info h3 {
        color: #000 !important;
        font-size: 28px;
        font-weight: 500;
        margin: 0;
        text-shadow: 0 5px 5px rgb(0 0 0 / 10%);
    }
</style>
<div class="col-xs-12 col-sm-12 col-md-9">

    <form class="mb-0">
        <?php if (_cao('is_userpage_vip_head')) {
            get_template_part('pages/user/header-card');
        } ?>

        <div class="form-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="charge">
                        <div class="modules__title">
                            <h4>
                                <i class="fa fa-diamond"></i> <?php echo $CaoUser->vip_name() . '用户 · 特权到期时间：' . $CaoUser->vip_end_time() ?>
                                · 选择套餐购买或续费</h4>
                        </div>
                        <div class="pt-30">
                            <div class="payvip-box home-vip-mod">
                                <div class="row" style="color:#fff;">
                                    <?php
                                    $vip_pay_setting = _cao('vip-pay-setting');
                                    foreach ($vip_pay_setting as $key => $item) {


                                        echo '<div class="col-12 col-sm-6 col-md-4 col-lg-33">';

                                        echo '<div class="vip-info vip-cell" data-id="' . $key . '" data-price="' . $item['price'] . '" style="background:none;">';


                                        if ($item['daynum'] == 9999) {

                                            $daynum_str = '永久会员';
                                            echo '<span class="tehui"><i class="fa fa-diamond"></i> 限时促销</span>';
                                            echo '<span class="time">' . $daynum_str . '</span>';
                                        } else {
                                            if ($item['daynum'] == 30) {
                                                $daynum_str = '月费会员';
                                            } elseif ($item['daynum'] == 60) {
                                                $daynum_str = '二个月';
                                            } elseif ($item['daynum'] == 90) {
                                                $daynum_str = '三个月';
                                            } elseif ($item['daynum'] == 180) {
                                                $daynum_str = '六个月';
                                            } elseif ($item['daynum'] == 365) {
                                                $daynum_str = '年费会员';
                                            } else {
                                                $daynum_str = '一天体验会员';
                                            }


                                            echo '<span class="tehui"><i class="fa fa-diamond"></i> 限时促销</span>';

                                            echo '<span class="time">' . $daynum_str . '</span>';
                                        }


                                        echo '<div class="prices" style="color:#34495e;margin-top: 40px;"><span>' . _cao('site_money_ua') . '</span>' . $item['price'] . '</div>';

                                        echo $item['desc'];

                                        echo ' </div>';
                                        echo '</div>';

                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style=" text-align: center; margin-top:20px;">
                    <input type="hidden" name="pay_id" value="">
                    <?php echo '<button type="button" class="click-pay click-payvip btn btn--danger" data-postid="' . $post_id . '" data-postvid="0" data-nonce="' . $create_nonce . '" data-price="0" style="font-size:14px;">立即开通</button>'; ?>
                </div>

            </div>

        </div>
    </form>
</div>