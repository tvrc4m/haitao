<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/6/20
 * Time: 13:25
 */
class logistics{

    private $_weight;

    private $_costs = array();

    public function __construct($weight)
    {
        $this->_weight = (int)$weight/1000;
    }

    /*
     * 物流费用计算
     * @param 参数 weight
     * @return string 物流费用
     * */
    public function cost(){

        if(is_numeric($this->_weight)){
            if($this->_weight<0.5) return 88;
            if($this->_weight<0.6 && $this->_weight>=0.5) return 96;//'document.write("' . 100 . '");';
            if($this->_weight<0.7 && $this->_weight>=0.6) return 105;
            if($this->_weight<0.8 && $this->_weight>=0.7) return 114;
            if($this->_weight<0.9 && $this->_weight>=0.8) return 123;
            if($this->_weight<1.0 && $this->_weight>=0.9) return 128;
            if($this->_weight<1.5 && $this->_weight>=1.0) return 150;//'document.write("' . 100 . '");';
            if($this->_weight<2.0 && $this->_weight>=1.5) return 172;
            if($this->_weight<2.5 && $this->_weight>=2.0) return 194;
            if($this->_weight<3.0 && $this->_weight>=2.5) return 217;
            if($this->_weight<3.5 && $this->_weight>=3.0) return 239;
            if($this->_weight<4.0 && $this->_weight>=3.5) return 261;
            if($this->_weight<4.5 && $this->_weight>=4.0) return 283;
            if($this->_weight<5.0 && $this->_weight>=4.5) return 305;
        }else
            return '无';


    }
}
/*$weight = !empty($_GET['weight'])?$_GET['weight']:'';
if(is_numeric($weight))$weight = (int)$weight/1000;
$obj = new logistics($weight);
echo $obj->cost();*/
