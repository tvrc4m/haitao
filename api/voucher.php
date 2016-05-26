<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/25
 * Time: 13:26
 */

class voucher{

    private $_dis = array('0.5'=>'500','0.3'=>'200','0.2'=>'100');
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
/*    public function subDiscount(){
    }*/

    /*
     * 面额生成等比例的代金卷
     * price    面额
     * discount     折扣
     * */
    public function algorithm($price='',$discount=''){

        if(is_int($price/100)){

            foreach($this->_dis as $k=>$v){
                $sums[$k] = $price*$k/$this->_dis[$k];
            }
            var_dump($sums);
        }
    }

    public function price($price,$k){
        return $price-$price*intval($price*$k/$this->_dis[$k]);
    }
}

include_once("../includes/global.php");
$obj = new voucher();
$obj->algorithm('1100');