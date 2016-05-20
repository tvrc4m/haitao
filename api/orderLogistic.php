<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/5/19
 * Time: 17:56
 */
class logistic{
    private $_order_id;
    private $_logistics_name;
    private $_logistics_id;
    private $_time;
    private $_secret;
    private $_sign;
    private $_times;
    private $_status = array('10001'=>'订单不能为空!','10002'=>'物流公司名称不能为空!','10003'=>'物流编号不能为空!','10004'=>'时间不能为空!','10005'=>'签名不能为空!','10006'=>'订单不匹配!','10007'=>'签名不匹配!','00000'=>'同步成功!');

    const EXT = '.txt';

    public function __construct($order_id='',$logistics_name='',$logistics_id,$time,$sign)
    {
        $this->_order_id = $order_id;
        $this->_logistics_name = $logistics_name;
        $this->_logistics_id = $logistics_id;
        $this->_time = $time;
        $this->_secret = md5('wonder');
        $this->_sign = $sign;
        $this->_times = time();

    }

    public function index(){
        if(empty($this->_order_id))return self::status('10001');
        if(empty($this->_logistics_name))return self::status('10002');
        if(empty($this->_logistics_id))return self::status('10003');
        if(empty($this->_time))return self::status('10004');
        if(empty($this->_sign))return self::status('10005');
        if(!self::order())return self::status('10006');
        if(!self::sign())return self::status('10007');
        return self::submit();
    }

    /*
     * 同步订单状态
     * order_id  订单编号
     * logistics_name 物流公司名称
     * logistics_id  物流编号
     * */
    public function submit(){
        $data = array();
        $data['orderId'] = $this->_order_id;
        $data['logistics_name'] = $this->_logistics_name;
        $data['logistics_id'] = $this->_logistics_id;
        self::cacheLog('gaofei_orider',$data,'api\/');
        return self::status('00000');
    }

    /*
     * 判断订单号是否匹配
     *order_id      订单编号
     **/
    public function order(){
        global $db;
        $sql = "select 1 from mallbuilder_product_order where order_id=".$this->_order_id." group by order_id";
        $db->query($sql);
        return $db->num_rows();
    }

    /*
     * 判断签名
     * order_id     订单id
     *logistics_id  物流编号
     *time          时间
     *secret        密钥
     *返回 签名状态
     * */
    public function sign(){
        return $this->_sign == md5($this->_order_id.'+”|~”+'.$this->_logistics_id.'+”|~”+'.$this->_time.'+”|~”+'.$this->_secret);
    }

    /*
     * 状态
     * statu 状态编号
     * */
    public function status($statu){
        //return json_encode(array('code'=>$statu,'msg'=>$this->_status[$statu]));
        return array('code'=>$statu,'msg'=>$this->_status[$statu]);
    }

    /*
     * 缓存日志
     * $key 文件名
     * $value 存储数据
     * $path  存储文件路径
     * */
    public function cacheLog($key='',$value='',$path=''){
        global $config;
        $datas = array();
        $datas['time']=$this->_times;
        $datas['list'][]=$value;

        $filename = $config['webroot'].'\/'.$path.$key.self::EXT;
        $con = file_get_contents($filename);
        if($con){
            $datas = json_decode($con,true);
            array_push($datas['list'],$value);
        }
        $data =json_encode($datas);
        if($data !== ''){
            $dir = dirname($filename);
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
            return file_put_contents($filename,$data);
        }

    }

}
include_once ("../includes/global.php");

var_dump($_POST);die;
/*$order_id = '160314030842001';
$logistics_name = '中通';
$logistics_id = '22222222';
$time = '33333333';
//$sign = 'aaaaaaaaaaaa';
$sign = '373b63998f93eefb69d54fce26e8c806';*/
if(!empty($_POST)){
$ob = new logistic($_POST['order_id'],$_POST['logistics_name'],$_POST['logistics_id'],$_POST['time'],$post['sign']);
echo $ob->index();
}
/*
 * 订单不能为空！   10001
 * 物流公司名称不能为空！   10002
 * 物流编号不能为空！     10003
 * 时间不能为空！   10004
 * 签名不能为空！   10005
 * 订单不匹配！     10006
 * 签名不匹配！     10007
 * 同步成功！       00000
 * */
?>