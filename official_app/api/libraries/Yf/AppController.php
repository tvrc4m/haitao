<?php
/**
 * 主控制器
 * 
 * 处理默认运行的方法，让不同功能的控制器继承
 * 
 * @category   Framework
 * @package    Controller
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo       
 */
class Yf_AppController extends Yf_Controller
{
    /**
     * 默认控制的模型
     * 
     * @access public
     * @var Object $Yf_Model
     */
    public $model = null;

    /**
     * 调用模板类，控制视图
     * 
     * @access public
     * @var string|null
     */
    public $view = null;

    /**
     * format json data  for Ajax  
     *
     * @var Yf_Data
     */
    public $data = null;

    /**
     * Constructor
     *
     * @global string $themes 视图风格
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        if (true || 'e' == $this->typ)
        {
            global $themes;
            global $pro_path_row;

            $this->view = new Yf_View($this->ctl, $this->met);

            $this->view->stc = Yf_Registry::get('static_url') . $themes;
            $this->view->img = Yf_Registry::get('static_url') . $themes . '/images';
            $this->view->css = Yf_Registry::get('static_url') . $themes . '/css';
            $this->view->js  = Yf_Registry::get('static_url') . $themes . '/js';

            $this->view->url  = $pro_path_row[1] . '';

            //
            $this->data = new Yf_Data();
        }
        else
        {
            $this->data = new Yf_Data();
        }

        $this->init();
    }

    /**
     * 运行 $met 方法
     * 
     * @access public
     */
    public function run()
    {
        if (method_exists($this, $this->met))
        {
            call_user_func(array($this, $this->met));
        }
        else
        {
            error_header(404, 'Page Not Found');
            //echo '请检查 $act 及 $met 是否正确， 类不存在传入的方法！';
            throw new Exception('请检查 $act 及 '.$this->met.' 是否正确， 类不存在传入的方法！');
            //die();
        }
    }

    /**
     * 处理后的数据，用来返还给客户端
     * 
     * @access public
     * @return array 返回ajax需要的json数组
     */
    public function getDataRows()
    {
        $rs = $this->data->getDataRows();

        return $rs;
    }

    /**
     * 默认运行的主方法，可以被覆盖。
     * 
     * @access public
     */
    public function index()
    {
        phpinfo();
    }

    /**
     * 初始化方法，有构造函数调用
     * 
     * @access public
     */
    public function init()
    {
    }


    public function getData()
    {
        if ('e' == $this->typ)
        {
			$d = ob_get_contents();
			ob_end_clean();
			ob_start();
		}
		else
		{
			$d = $this->getDataRows();
		}

        return $d;
    }
}
?>