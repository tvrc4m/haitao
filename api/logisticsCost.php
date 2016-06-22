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
        if(is_numeric($weight) && $weight!=0)
            $this->_weight = (int)$weight/1000;
        else
            return  '0.00';
    }

    /*
     * 物流费用计算
     * @param 参数 weight
     * @return string 物流费用
     * */
    public function cost(){
        if($this->_weight!=0){
            if($this->_weight<=0.5 && $this->_weight>0) return '88.00';
            if($this->_weight<=0.6 && $this->_weight>0.5) return '96.00';//'document.write("' . 100 . '");';
            if($this->_weight<=0.7 && $this->_weight>0.6) return '104.00';
            if($this->_weight<=0.8 && $this->_weight>0.7) return '112.00';
            if($this->_weight<=0.9 && $this->_weight>0.8) return '120.00';
            if($this->_weight<=1.0 && $this->_weight>0.9) return '128.00';
            if($this->_weight<=1.5 && $this->_weight>1.0) return '150.00';
            if($this->_weight<=2.0 && $this->_weight>1.5) return '172.00';
            if($this->_weight<=2.5 && $this->_weight>2.0) return '194.00';
            if($this->_weight<=3.0 && $this->_weight>2.5) return '217.00';
            if($this->_weight<=3.5 && $this->_weight>3.0) return '239.00';
            if($this->_weight<=4.0 && $this->_weight>3.5) return '261.00';
            if($this->_weight<=4.5 && $this->_weight>4.0) return '283.00';
            if($this->_weight<=5.0 && $this->_weight>4.5) return '305.00';
            if($this->_weight>5.0) return '1000.00';
        }else
            return  '0.00';

    }
}
