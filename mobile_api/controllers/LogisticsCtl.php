<?php

/**
 *
 * 物流相关api
 *
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class LogisticsCtl extends Yf_AppController
{
	public function status()
	{
		$logistics_config = Yf_Registry::get('logistics_config');

		$api_id     = $logistics_config['logistic_app_id'] ? $logistics_config['logistic_app_id'] : "";
		$api_sceret = $logistics_config['logistic_api_sceret'] ? $logistics_config['logistic_api_sceret'] : "";

		$company = request_string('com');
		$nu      = request_string('nu');

		$data = array();

		if ($company && $nu)
		{
			$Fast_MailModel = new Fast_MailModel();
			$fast_mail_rows = $Fast_MailModel->getMailByCompany($company);

			if ($fast_mail_rows)
			{
				$fast_mail_row = array_pop($fast_mail_rows);

				$com       = $fast_mail_row['pinyin'];

				//爱查快递
				$url2 = "http://api.ickd.cn/?com=" . $com . "&nu=" . $nu . "&id=" . $api_id . "&secret=" . $api_sceret . "&type=json&encode=utf8";
				//快递100  show=[0|1|2|3]


				$url2 = "http://api.kuaidi100.com/api?id=$api_id&com=$com&nu=$nu&valicode=[]&show=0&muti=1&order=desc";

				$data = file_get_contents($url2);

				$data = @decode_json($data);

				$status = 200;
				$msg = '读取接口数据成功！';
			}
			else
			{
				$status = 200;
				$msg = '暂时没有物流信息！';
			}
		}
		else
		{
			$msg    = 'failure';
			$status = 250;
		}

		//http://api.ickd.cn/?id=[]&secret=[]&com=[]&nu=[]&type=[]&encode=[]&ord=[]&lang=[]
		/*com	必须	快递公司代码（英文），所支持快递公司见如下列表
		nu	必须	快递单号，长度必须大于5位
		id	必须	授权KEY，申请请点击快递查询API申请方式
		在新版中ID为一个纯数字型，此时必须添加参数secret（secret为一个小写的字符串）
		secret	必选(新增)	该参数为新增加，老用户可以使用申请时填写的邮箱和接收到的KEY值登录http://api.ickd.cn/users/查看对应secret值
		type	可选	返回结果类型，值分别为 html | json（默认） | text | xml
		encode	可选	gbk（默认）| utf8
		ord	可选	asc（默认）|desc，返回结果排序
		lang	可选	en返回英文结果，目前仅支持部分快递（EMS、顺丰、DHL）*/
		/*
		function lookorder($com, $nu)
		{
			$api_id     = API_Id;
			$api_sceret = API_Sceret;

			//爱查快递
			$url2 = "http://api.ickd.cn/?com=" . $com . "&nu=" . $nu . "&id=" . $api_id . "&secret=" . $api_sceret . "&type=html&encode=utf8";

			//快递100  show=[0|1|2|3]


			$url2 = "http://api.kuaidi100.com/api?id=$api_id&com=$com&nu=$nu&valicode=[]&show=2&muti=1&order=desc";

			$con = file_get_contents($url2);
			//return "document.write('".$con."');";
			return 'document.write("' . $con . '");';
		}
		*/


		$this->data->addBody(-140, $data, $msg, $status);
	}
}

?>
