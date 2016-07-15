<?php
class curlUp{

    private $id_num;
    private $id_name;
    private $realPositive;
    private $realBack;
    private $time;
    private $pass = 'AiMeiHtBoyWholeSaler001';
    private $tokenUrl = "http://121.40.31.77:8015/Service/Get_Aes.aspx";//验证token链接
    private $realUrl = "http://121.40.31.77:8015/Service/Get_Exist_Id_Num.aspx";//验证身份证是否存在链接
    private $imgUpurl = "http://121.40.31.77:8015/Service/Send_Id_Num_Info.aspx";//身份证信息上传链接
    private $orderUrl = "http://121.40.31.77:8015/Service/Send_Goods_Order.aspx";//订单提交链接

    private $trades = array('0'=>'1','1'=>'2','2'=>'0');

    const EXT='.txt';


    public function __construct($id_name='',$id_num='',$realPositive='',$realBack='')
    {
        $this->time = date("YmdHis",time());
        $this->id_num = $id_num;
        $this->id_name = $id_name;
        $this->realPositive = ltrim($realPositive,'/');
        $this->realBack = ltrim($realBack,'/');
    }

    /*订单提交
    * @param $id
    */
    function orderUp($orderList){

        $time = $this->time;//date("YmdHis",$orlist['order']['create_time']);
        $addr = explode(' ',$orderList['consignee_address']);
        $list = array();
        $list['goods_order_count']=1;
        $list['msg'] = '';
        $list['goods_order'][0]['order_code']=$orderList['order_id'];
        $list['goods_order'][0]['order_sum_money']=(string)($orderList['price']+$orderList['logistics_price']);//$orlist['order']['logistics_price']);
        $list['goods_order'][0]['order_member_name']=$orderList['consignee'];
        $list['goods_order'][0]['order_member_id_number']=$orderList['identity_card'];
        $list['goods_order'][0]['order_member_phone']=$orderList['consignee_mobile'];
        $list['goods_order'][0]['order_member_sheng']=$addr[0];
        $list['goods_order'][0]['order_member_shi']=$addr[1];
        $list['goods_order'][0]['order_member_xian']=$addr[2];
        $list['goods_order'][0]['order_member_address']=$addr[3];
        $list['goods_order'][0]['order_logistics_name']='快递';//$orderList['logistics_name'];
        $list['goods_order'][0]['order_logistics_money']=$orderList['logistics_price'];
        $list['goods_order'][0]['order_goods_money']=$orderList['price'];
        $list['goods_order'][0]['goods_attributes_list'][0]['id']='';
        $list['goods_order'][0]['goods_attributes_list'][0]['sku_id']=$orderList['skuid'];
        $list['goods_order'][0]['goods_attributes_list'][0]['price']=$orderList['price'];
        $list['goods_order'][0]['goods_attributes_list'][0]['num']=$orderList['num'];
        $list['goods_order'][0]['goods_attributes_list'][0]['trade']=$this->trades[$orderList['trade']];
        $order = json_encode($list);
        $token =  $this->token();
        $type = $this->aes($this->orderUrl,array ("time" => $this->time,"pass" => $this->pass,"token" => $token,"order" => $order));
    return $type;
    }

    /*
     * *流提交图片
     * 返回图片地址
     * */
    public function curlUpload(){

        $list = array();
        $list['time']=$this->time;
        //获取token值
        $list['token'] =  $this->token();
        $list['pass']=$this->pass;
        $list['id_num_info']['type']=0;
        $list['id_num_info']['id_num']=$this->id_num;
        $list['id_num_info']['id_name']=$this->id_name;
        $list['id_num_info'] = json_encode($list['id_num_info']);
        $filezheng = realpath(mb_convert_encoding($this->realPositive,'GBK','utf8'));
        $filebei = realpath(mb_convert_encoding($this->realBack,'GBK','utf8'));
        $list['realPositive'] = '@'.$filezheng;
        $list['realBack'] = '@'.$filebei;
        $type =  $this->aes($this->imgUpurl,$list);
        unset($list);
        return $type;
    }
    /*
    * 验证身份证是否存在
    * $real 身份证号
    * */
    public function real(){
        $list = array();
        $list['time']=$this->time;
        //获取token值
        $list['token'] =  $this->token();
        $list['pass']=$this->pass;
        $list['id_num']=$this->id_num;
        $type =  $this->aes($this->realUrl,$list);
        unset($list);

        return $type;
    }
    //获取token
    public function token(){
        $tokens = $this->aes($this->tokenUrl,array ("time" => $this->time,"pass" => $this->pass));
        if(is_array($tokens)){
            if($tokens['status']==0){
                $token = $tokens['aes'];
            }
        }
        return $token;
    }

    //curl提交
    public function aes($url='',$lists=''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $lists);
        $list = curl_exec($ch);
        curl_close($ch);
        unset($ch);
        return json_decode($list,true);
    }
    //缓存日志
    /*
     * 缓存日志
     * $key 文件名
     * $value 存储数据
     * $path  存储文件路径
     * */
    public function cacheLog($key='',$value='',$path=''){
        global $config;
        $data = $this->time.'>>>'.json_encode($value)."\r\n";
        $filename = $config['webroot'].'/'.$path.$key.self::EXT;
        if($data !== ''){
            $dir = dirname($filename);
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
            return file_put_contents($filename,$data,FILE_APPEND);
        }

    }
}
?>