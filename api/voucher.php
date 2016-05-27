<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/25
 * Time: 13:26
 */

class voucher{

    private $_dis = array('200'=>'0.3','500'=>'0.5','100' => '0.2');
    /*
     * 获取代金卷列表
     * */
    public function showVoucher(){
        global $db;
        $sql = "select `id`,`shop_id`,`shop_name`,`limit`,`price`,`start_time`,`end_time` from mallbuilder_voucher_temp where status=1";
        $db->query($sql);
        $list = $db->getRows();
        return json_encode($list);
    }

    /*
     * 生成对应比例的代金卷
     * id       优惠卷id
     * discount  折扣
     * price    面额
     * */

    /*
     * 面额生成等比例的代金卷
     * price    面额
     * discount     折扣
     * */
    public function algorithm($price='',$discount=''){
        $prices = $price*$discount;
        if($prices%100==0){
            var_dump($this->make_coupon_num($this->_dis,$prices));
        }else
            echo '不为100倍数';
    }

    public function make_coupon_num($coupon_arr, $money)
    {
        $arr_total = array();
        $count = 0;
        $coupon_num = array();
        $arr_money = array();
        $arr_rate = array();
        ksort($coupon_arr);
        foreach ($coupon_arr as $key => $val) {
            $count += $key;
            $arr_total[] = $count;
            $coupon_num[$key] = 0;
            $arr_money[] = $key;
            $arr_rate[] = $val;
        }
        $num_level = count($arr_total);
        for ($i = $num_level; $i > 0; $i--) {
            if ($money >= $arr_total[$i - 1]) {
                if ($i < count($arr_total)) {
                    $arr_rate_total = 0;
                    for ($j = 0; $j < $i; $j++) {
                        $arr_rate_total += $arr_rate[$j];
                    }
                    $new_atr = array();
                    for ($jj = 0; $jj < $i; $jj++) {
                        $new_atr[] = ($arr_rate[$jj] / $arr_rate_total);
                    }
                } else {
                    $new_atr = $arr_rate;
                }
                $money_count = 0;
                for ($k = $i; $k > 0; $k--) {
                    if ($k > 1) {
                        $coupon_num[$arr_money[$k - 1]] = round($money * $new_atr[$k - 1] / $arr_money[$k - 1]);
                        $money_count += $coupon_num[$arr_money[$k - 1]] * $arr_money[$k - 1];
                    } else {
                        $coupon_num[$arr_money[$k - 1]] = floor(($money - $money_count) / $arr_money[$k - 1]);
                    }
                }
                break;
            }
        }
        return $coupon_num;
    }

}
//var_dump(make_coupon_num($arr, 800));
include_once("../includes/global.php");
$obj = new voucher();
$obj->algorithm('1000','0.1');