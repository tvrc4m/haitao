<?php
class Web_ConfigModel extends Web_Config
{
	/**
	 * 得到首页推荐分类
	 *
	 * @param  int $config_id 主键值
	 * @return array $cat_pro_rows 返回的查询内容
	 * @access public
	 */
	public function getIndexCatIdConfig()
	{
		//设置where条件，读取后台设置的推荐分类
		$this->sql->setWhere('`index`', 'index_catid');
		$config_rows = $this->get('*');

		if ($config_rows)
		{
			$config_row = array_pop($config_rows);
		}

		$cat_pro_rows = unserialize($config_row['value']);

		//读取分类详情
		$catid_rows       = array_keys($cat_pro_rows);
		$Product_CatModel = new Product_CatModel();

		$cat_rows = $Product_CatModel->getCat($catid_rows);
		$cat_rows = $Product_CatModel->getCatDetailRows($catid_rows, false, $cat_rows);

		foreach ($cat_pro_rows as $k => $v)
		{
			$cat_pro_rows[$k]['name']    = $v['name'] ? $v['name'] : $cat_rows[$k]['cat'];
			$cat_pro_rows[$k]['pic']     = $cat_rows[$k]['pic'];
			$cat_pro_rows[$k]['wpic']    = $cat_rows[$k]['wpic'];
			//$cat_pro_rows[$k]['sub_cat'] = $cat_rows[$k]['sub_cat'];

		}

		fb($cat_pro_rows);
		return $cat_pro_rows;
	}
	
	public function getProConfig($proid)
	{
		$this->sql->setWhere('`index`', $proid);
		$config_rows = $this->get('*');
		
		if ($config_rows)
		{
			$config_row = array_pop($config_rows);
		}
		
		return $config_row['value'];
	}

	public function getWeburl()
	{
		$this->sql->setWhere('`index`', 'weburl');
		$config_rows = $this->get('*');
		
		if ($config_rows)
		{
			$config_row = array_pop($config_rows);
		}
		
		return $config_row['value'];
		

	}


	public function getAuthkeyConfig()
	{
		$this->sql->setWhere('`index`', 'authkey');
		$config_rows = $this->get('*');
		
		if ($config_rows)
		{
			$config_row = array_pop($config_rows);
		}
		
		return $config_row['value'];
		

	}

}