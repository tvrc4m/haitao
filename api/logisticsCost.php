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
        if(is_numeric($this->_weight))
            $this->_weight = (int)$weight/1000;
        else
            return '无';
    }

    /*
     * 物流费用计算
     * @param 参数 weight
     * @return string 物流费用
     * */
    public function cost(){
        if($this->_weight==0){
            if($this->_weight<=0.5 && $this->_weight>0) return 88;
            if($this->_weight<=0.6 && $this->_weight>0.5) return 96;//'document.write("' . 100 . '");';
            if($this->_weight<=0.7 && $this->_weight>0.6) return 104;
            if($this->_weight<=0.8 && $this->_weight>0.7) return 112;
            if($this->_weight<=0.9 && $this->_weight>0.8) return 120;
            if($this->_weight<=1.0 && $this->_weight>0.9) return 128;
            if($this->_weight<=1.5 && $this->_weight>1.0) return 150;
            if($this->_weight<=2.0 && $this->_weight>1.5) return 172;
            if($this->_weight<=2.5 && $this->_weight>2.0) return 194;
            if($this->_weight<=3.0 && $this->_weight>2.5) return 217;
            if($this->_weight<=3.5 && $this->_weight>3.0) return 239;
            if($this->_weight<=4.0 && $this->_weight>3.5) return 261;
            if($this->_weight<=4.5 && $this->_weight>4.0) return 283;
            if($this->_weight<=5.0 && $this->_weight>4.5) return 305;
        }else
            return '0';

    }
}
