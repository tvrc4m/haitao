<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Advs_ContentsModel extends Advs_Contents
{

	/**
	 * 得到首页slide
	 *
	 * @param  int   $group_id  主键值
	 * @return array slide_rows 返回的查询内容
	 * @access public
	 */
	public function getSlideAdv($group_id = null)
	{
		//设置where条件，读取后台设置的推荐分类
		$this->sql->setWhere('group_id', $group_id);
		$slide_rows = $this->get('*');
		
		return $slide_rows;
	}
}
?>