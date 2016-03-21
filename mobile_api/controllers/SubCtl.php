<?php
/**
 * jsonp
 *
 * 其它服务器回调
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class SubCtl extends Yf_AppController
{
	public function get()
	{
		$top_domain = request_int('top_domain');
		$domain     = request_int('domain');
		
		$Sub_DomainModel = new Sub_DomainModel();
		//$data = array();
		$data = $Sub_DomainModel->getTopDomainList($top_domain, $domain);
		
		if (true)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $data, $msg, $status);
	}
}
?>
