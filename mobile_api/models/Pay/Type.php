<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 
 * 
 * @category   Framework
 * @package    __init__
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo       
 */
class Pay_Type extends Yf_Model
{
    public $_cacheKeyPrefix  = 'c|pay_type|';
    public $_cacheName       = 'pay';
    public $_tableName       = 'pay_type';
    public $_tablePrimaryKey = 'payment_id';

    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='mallbuilder_data', &$user=null)
    {
        $this->_tableName =  $this->_tableName;
        parent::__construct($db_id, $user);
    }

    /**
     * 根据主键值，从数据库读取数据
     *
     * @param  int   $pay_id  主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getType($pay_id=null, $sort_key_row=null)
    {
        $rows = array();
        $rows = $this->get($pay_id, $sort_key_row);

        return $rows;
    }

    /**
     * 插入
     * @param array $field_row 插入数据信息
     * @param bool  $return_insert_id 是否返回inset id
     * @param array $field_row 信息
     * @return bool  是否成功
     * @access public
     */
    public function addType($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);

        //$this->removeKey($pay_id);
        return $add_flag;
    }

    /**
     * 根据主键更新表内容
     * @param mix   $pay_id  主键
     * @param array $field_row   key=>value数组
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editType($pay_id=null, $field_row)
    {
        $update_flag = $this->edit($pay_id, $field_row);

        return $update_flag;
    }

    /**
     * 更新单个字段
     * @param mix   $pay_id
     * @param array $field_name
     * @param array $field_value_new
     * @param array $field_value_old
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editTypeSingleField($pay_id, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($pay_id, $field_name, $field_value_new, $field_value_old);

        return $update_flag;
    }    
    
    /**
     * 删除操作
     * @param int $pay_id
     * @return bool $del_flag 是否成功
     * @access public
     */
    public function removeType($pay_id)
    {
        $del_flag = $this->remove($pay_id);

        //$this->removeKey($pay_id);
        return $del_flag;
    }
}
?>