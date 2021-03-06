<?php
/**
 * Ajax数据格式化类
 * 
 * 用来生成Ajax需要的JSON数据。
 * 
 * @category   Framework
 * @package	Model
 * @author	 Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version	1.0
 * @todo	   
 */
class Yf_Data
{
	/**
	 * 控制器返回的数据,For ajax data format.
	 * 
	 * @access public
	 * @var array
	 */
	//public $dataRows = array('h'=>array('i'=>0, 'e'=>false, 'm'=>''),'b'=>'');
	public $dataRows = array();

	public function __construct()
	{
		if (array_key_exists('id', $_REQUEST))
		{
			//$this->dataRows['h']['i'] = trim($_REQUEST['id']);
		}


	}

	/*
	//废弃
	public function buildXML($id, $data, $rows=1, $errorMessage='发生错误', $type='object', $operateType='object')
	{
		$outString=	
					'<?xml version="1.0" encoding="UTF-8" ?>
						<ajax-response>
							<response type="'.$type.'" id="'.$id.'"	 totalRows="'.$rows.'" errorMessage="'.$errorMessage.'"	operateType="'.$operateType.'">
								'.$data.'
							</response>
						</ajax-response>';
		return $outString ;
	}

	//废弃
	public function printXML($row=false)
	{
		header('Content-type: text/xml');
		
		if (!$row)
		{
			$row = $this->virtualRow;
		}

		$data	= convertArrayToProperties($row,'arytest',false,false);
		$outXML	= $this->buildXML($this->id, $data,$this->totalRows, $this->errorMessage);
		echo $outXML ;
	}

	//废弃
	public function printHTML($row=false)
	{
		header('Content-type: text/xml');
		
		if (!$row)
		{
			$row = $this->virtualRow;
		}

		$outXML	= $this->buildXML($this->id, $row,$this->totalRows,	$this->errorMessage, 'object', 'element');

		echo $outXML ;
	}

	//废弃
	public function buildXMLCDATA($id,	$data, $rows=1,	$errorMessage='发生错误', $type='object')
	{
		$outString=	
					'<?xml version="1.0" encoding="UTF-8" ?>
						<ajax-response>
							<response type="'.$type.'" id="'.$id.'"	 totalRows="'.$rows.'" errorMessage="'.$errorMessage.'">
								<![CDATA['.$data.']]>
							</response>
						</ajax-response>';
		return $outString ;
	}

	//废弃
	public function printXMLCDATA($row=false)
	{
		header('Content-type: text/xml');
		
		if (!$row)
		{
			$row = $this->virtualRow;
		}

		$data	= convertArrayToProperties($row,'arytest',false,false);
		$outXML	= $this->buildXMLCDATA($this->id, $data,$this->totalRows, $this->errorMessage);
		echo $outXML ;
	}
	*/

	/**
	 * 返回请求数据
	 *
	 * @return   string $json   返回数据
	 * @access   public
	 */
	public function getJSON()
	{
		header('Content-type: text/html');

		return json_encode($this->getDataRows()) ;
	}

	/**
	 * 返回请求数据
	 *
	 * @return   string $json   返回数据
	 * @access   public
	 */
	public function getDataRows()
	{
		if (DEBUG)
		{
			if ($d = trim(ob_get_contents()))
			{
				$item = array(-999, $d);
				$this->dataRows['d'] = $item;
			}
			
		}
		
		if ('cli' != SAPI)
		{
			ob_end_clean();
			ob_start();
		}

		return $this->dataRows;
	}

	/**
	 * 返回请求数据
	 *
	 * @return string   $json   返回数据
	 * @access public
	 */
	public function printJSON()
	{
		echo $this->getJSON();
	}

	/**
	 * 设置结果状态
	 *
	 * @return string   $json   返回数据
	 * @access public
	 */
	public function setState($state = true)
	{
	   $this->dataRows['h']['e'] = $state;
	}

	/**
	 * 设置出错信息
	 *$code int 0普通出错提示,1:缺银两,2:缺黄金
	 * @return string   $json   返回数据
	 * @access public
	 */
	public function setError($msg, $code=0, $id=0)
	{
		$item = array('cmd_id'=>-1, 'b'=>array('code'=>$code, 'msg'=>$msg,'id'=>$id));
		$this->dataRows[] = $item;
	}

    public function setApiError($msg)
    {
        exit(json_encode(array("result"=>0,"msg"=>$msg)));
    }

	/**
	 * 设置出错信息
	 *
	 * @return string   $json   返回数据
	 * @access public
	 */
	public function addMsg($cmd_id=-1,$code=0, $msg='')
	{
		$item = array('cmd_id'=>$cmd_id, 'code'=>$code, 'msg'=>$msg);
		$this->dataRows[] = $item;
	}

	/**
	 * 设置返回数据
	 *
	 * @return string   $json   返回数据
	 * @access public
	 */
	public function addBody($cmd_id, $data_rows=null)
	{
		//fb($data_rows);
		$item = array();

		if(is_array($data_rows))
		{
            $body_data_rows = array();
            //$body_data_rows = $data_rows;
            $body_data_rows['b'] = $data_rows;

			//$item = array_merge($item, self::typeConversion($data_rows));
			//$item = array_merge($item, $data_rows);
            $pro_data_rows = array('cmd_id'=>$cmd_id) + $body_data_rows;
			//array_unshift($data_rows, $cmd_id);

			//echo('<pre>');
			//var_dump($item);
			//fb("ooooooooooooooooooooooooo");
			//fb($pro_data_rows);
			$this->dataRows[] = $pro_data_rows;
		}
        else
        {
            throw new Exception("协议内容有误：" . $cmd_id);
        }
	}
	
	/**
	 * 类型转换
	 *
	 * @param	
	 * @return	
	 * @access	public
	 * @see	
	 */
	public static function typeConversion($data)
	{
		$new_data = '';

		if(is_numeric($data))
		{
            $new_data = intval($data);
            /*
			if (is_true_int($data))
			{
				$new_data = intval($data);
			}
			else
			{
				//if(is_true_float($data))
				$new_data = floatval($data);
			}
            */
		}
		elseif (is_string($data))
		{
			$new_data = $data;
		}
		elseif (is_bool($data))
		{
			$new_data = $data;
		}
		else
		{
			$new_data = $data;
		}

		return $new_data;
	}

	/**
	 * convert dic to array
	 *
	 * @param	
	 * @return	
	 * @access	public
	 * @see	
	 */
	public static function array2ValuesRecursive(array $data)
	{
		$new_data = array();

		if(is_array($data))
		{
			foreach($data as $key=>$data_child)
			{
				if(is_array($data_child))
				{
					$data_temp = self::array2ValuesRecursive($data_child);

					array_push($new_data, $data_temp);
				}
				else
				{
					if('user_name' === $key)
					{
						array_push($new_data, $data);
					}
					else
					{
						array_push($new_data, self::typeConversion($data_child));
					}
				}
			}
		}
		else
		{
			$new_data = self::typeConversion($data);
		}

		return $new_data;
	}

	//msgpack封装下，便于其他地方调用
	public static function msgEncode($item)
	{
		if (function_exists('msgpack_pack'))
		{
			$item_data = msgpack_pack($item);
		}
		else
		{
			$item_data = MsgPack_Coder::encode($item);
		}

		return $item_data;
	}

	public static function msgDecode($item) 
	{
		if (function_exists('msgpack_unpack')) 
		{
			$item_data = msgpack_unpack($item);
		}
		else
		{
			$item_data = MsgPack_Coder::decode($item);
		}

		return $item_data;
	}


	/**
	 * 输出数据
	 *
	 * @return string   $json   返回数据
	 * @access public
	 */
	public static function encodeProtocolData($d, $typ='o')
	{
		if ('o' == $typ)
		{
			if (isset($_REQUEST['data_type']) && 'json' == $_REQUEST['data_type'])
			{
				if (isset($_REQUEST['debug']) && 1 == $_REQUEST['debug'])
				{
					return var_dump($d);
				}
				else
				{
					return json_encode($d);
				}
			}
			else
			{
				/*
				$d = array
				(
					array(-500, "abcdefg", "hijklmn"),
					array(-900, "fda", "fdafda")
					array(-900, "abcdefg", "fd")
					array(-800, "ffd", "hijklmn")
					array(-900, "abcdefg", "hijklmn")
					
				);
				$d = array
				(
					array(-900, "abcdefg", "hijklmn"),
					array(-900, "黄新泽", "黄新泽发达双方都"),
					array(-900, "abcdefg", "hijklmn")
				);
				*/
				 
				$protocol_data = "";

				foreach ($d as $key=>$item)
				{
					$item_data = "";

					$item_data = Yf_Data::msgEncode(self::array2ValuesRecursive($item));

					$protocol_item_head = pack("sS", $item['cmd_id'], strlen($item_data));

					$protocol_data .=  $protocol_item_head . $item_data;
				}

				return $protocol_data;
			}
		}
		else
		{
			return $d;
		}
	}
}
?>