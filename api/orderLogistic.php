<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/19
 * Time: 17:56
 */
class logistic{
    private $order_id;
    private $logistics_name;
    private $logistics_id;
    private $time;
    private $secret;
    private $sign;

    public function __construct($order_id='',$logistics_name='',$logistics_id,$time,$sign)
    {
        $this->order_id = $order_id;
        $this->logistics_name = $logistics_name;
        $this->logistics_id = $logistics_id;
        $this->time = $time;
        $this->secret = md5('wonder');
        $this->sign = $sign;
    }
    public function verification(){
        echo $this->secret;
    }
    /*
     * 返回密钥
     * order_id     订单id
     *logistics_id  物流编号
     *time          时间
     *secret        密钥
     * */
    public function sign(){
        return md5($this->order_id.'+”|~”+'.$this->logistics_id.'+”|~”+'.$this->time.'+”|~”+'.$this->secret);
    }

}
$order_id = '11111111';
$logistics_name = '中通';
$logistics_id = '22222222';
$time = '33333333';
$sign = 'aaaaaaaaaaaa';
$ob = new logistic($order_id,$logistics_name,$logistics_id,$time,$sign);
$ob->verification();
/*
 * 订单不能为空
 * 订单不匹配
 * 物流公司名称不能为空
 * 物流编号不能为空
 * 时间不能为空
 * 密钥不能为空
 * 密钥不正确
 * 同步成功
 * */
?>