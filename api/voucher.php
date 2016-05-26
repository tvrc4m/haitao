<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/25
 * Time: 13:26
 */

class voucher{

    private $_dis = array('100','200','300','500');
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
    public function subDiscount(){ 

    }
}

include_once("../includes/global.php");

voucher::showVoucher();