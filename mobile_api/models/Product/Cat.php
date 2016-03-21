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
class Product_Cat extends Yf_Model
{
    public $_cacheKeyPrefix  = 'c|product_cat|';
    public $_cacheName       = 'product';
    public $_tableName       = 'product_cat';
    public $_tablePrimaryKey = 'catid';

    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='mallbuilder_data', &$user=null)
    {
        $this->_tableName = TABEL_PREFIX . $this->_tableName;
        parent::__construct($db_id, $user);
    }

    /**
     * 根据主键值，从数据库读取数据
     *
     * @param  int   $catid  主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getCat($catid=null, $sort_key_row=null)
    {
        // 第一级别
        if (0 === $catid || '0' === $catid)
        {
            $this->sql->setWhere('catid', 9999, '<');
        }
        else
        {

        }

        $rows = array();

        $rows = $this->get($catid, $sort_key_row);

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
    public function addCat($field_row, $return_insert_id=false)
    {
        $add_flag = $this->add($field_row, $return_insert_id);

        //$this->removeKey($catid);
        return $add_flag;
    }

    /**
     * 根据主键更新表内容
     * @param mix   $catid  主键
     * @param array $field_row   key=>value数组
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editCat($catid=null, $field_row)
    {
        $update_flag = $this->edit($catid, $field_row);

        return $update_flag;
    }

    /**
     * 更新单个字段
     * @param mix   $catid
     * @param array $field_name
     * @param array $field_value_new
     * @param array $field_value_old
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function editCatSingleField($catid, $field_name, $field_value_new, $field_value_old)
    {
        $update_flag = $this->editSingleField($catid, $field_name, $field_value_new, $field_value_old);

        return $update_flag;
    }    
    
    /**
     * 删除操作
     * @param int $catid
     * @return bool $del_flag 是否成功
     * @access public
     */
    public function removeCat($catid)
    {
        $del_flag = $this->remove($catid);

        //$this->removeKey($catid);
        return $del_flag;
    }
}
?>