<?php /* Smarty version 2.6.20, created on 2016-03-16 11:32:45
         compiled from admin_step.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'admin_step.htm', 59, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['title']): ?><?php echo $this->_tpl_vars['title']; ?>
 - <?php echo $this->_tpl_vars['config']['company']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['title']; ?>
<?php endif; ?><?php echo $this->_tpl_vars['config']['company']; ?>
</title>
<meta name="description" content="<?php echo $this->_tpl_vars['config']['description']; ?>
">
<meta name="keywords" content="<?php echo $this->_tpl_vars['config']['keyword']; ?>
">
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/user_admin.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js" type=text/javascript></script>
<script language="javascript">
var searchTxt = ' 搜索商品！';
var SEARCHVALUE = '请输入分类属性名称';
var weburl="<?php echo $this->_tpl_vars['config']['weburl']; ?>
";
function searchFocus(e){
	if(e.value == searchTxt){
		e.value='';
		$('#keyword').css("color","");
	}
}
function searchBlur(e){
	if(e.value == ''){
		e.value=searchTxt;
		$('#keyword').css("color","#999999");
	}
}
</script>
</head>
<div id="shortcut">
    <div class="w">
        <div class="fl">
            <script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php"></script>
        </div>
        <div class="fr">
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1">进入买家中心</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=admin_share_product">我的收藏</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_list_inbox">站内消息</a>
        </div>
    </div>
</div>
<div class="header">
    <h1>
    	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" title="<?php echo $this->_tpl_vars['config']['company']; ?>
">
        <img title="<?php echo $this->_tpl_vars['config']['company']; ?>
" alt="<?php echo $this->_tpl_vars['config']['company']; ?>
" src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>" />
        </a>
        <i>卖家中心</i>
	</h1>
    <div class="search">
        <div class="i-search ld">
        <form method="get" class="form" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">
            <input id="m" name="m" type="hidden" value="product" />
            <input id="s" name="s" type="hidden" value="list" />
            <input type="text" autocomplete="off" value="<?php echo $_GET['key']; ?>
" id="key" name="key" class="text">
            <input type="submit" class="search_button" value="搜索">
        </form>
        </div>
        <div class="hotwords">
            <strong>热门搜索：</strong>
            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'searchword', 'temp' => 'search_word', 'limit' => 7)), $this); ?>

        </div>
    </div>
</div>
<div class="layout">
	<div class="wrap_shadow">
    	<div class="wrap_all">
            <div class="chart">
                <div title="请选择店铺分类" class="pos_x1 bg_a2"></div>
                <div title="填写店主和店铺信息" class="pos_x2 bg_b1"></div>
                <div title="完成" class="pos_x3 bg_c"></div>
            </div>
            <?php if ($this->_tpl_vars['distribution_open_flag'] == 1): ?>
            <div style="text-align:center;width:100%;font-weight: bold;font-size: 16px;"><?php if ($_SESSION['shop_type'] == 1): ?>申请开通分销店铺<?php else: ?>申请开通商家店铺<?php endif; ?></div>
            <?php else: ?>
            <?php endif; ?>
            <div class="shop_grade">

            <table>
                <tbody>
                  
  				<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>  
                    <tr>
                        <th width="300"><?php echo $this->_tpl_vars['list']['name']; ?>
</th>
                        <td><?php echo $this->_tpl_vars['list']['desc']; ?>
</td>
                        <td width="120"><a class="btn2" href="main.php?m=shop&s=admin_step&grade=<?php echo $this->_tpl_vars['list']['id']; ?>
">立即开店</a></td>
                	</tr>
                <?php endforeach; endif; unset($_from); ?>   
                </tbody>
            </table>    
            </div>
    	</div>
    </div>
</div>
<div id="footer">
  <p><?php echo $this->_tpl_vars['web_con']; ?>
</p>
  <?php echo $this->_tpl_vars['bt']; ?>
<br>
</div>
</body>
</html>

