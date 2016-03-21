<?php

/** 
 * news
 * @author 
 * @copyright 
 */
class NewsCtl extends Yf_AppController
{


	public function getNewslist()
	{
		$data = array();
		$NewsModels = new NewsModel();
		$result = $NewsModels->getNewslists();
		if ($result)
		{
			$msg = 'success';
			$status = 200;
		}
		else
		{
			$msg = 'failure';
			$status = 250;
		}


		$this->data->addBody(-140, $result, $msg, $status);
	}



}






?>
