<?php /* Smarty version 2.6.20, created on 2016-03-16 11:34:23
         compiled from admin_inc.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'admin_inc.htm', 75, false),array('modifier', 'truncate', 'admin_inc.htm', 88, false),array('modifier', 'number_format', 'admin_inc.htm', 142, false),array('modifier', 'explode', 'admin_inc.htm', 166, false),)), $this); ?>
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
/templates/default/user_admin/user_admin.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js" type=text/javascript></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/index.js" type=text/javascript></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.ui.js" ></script>
<script type="text/javascript" id="dialog_js" charset="utf-8" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/dialog/dialog.js" ></script>
<script language="javascript">
var searchTxt = ' <?php echo $this->_tpl_vars['lang']['search_products']; ?>
';
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
// 收缩展开效果
$(document).ready(function(){
	$(".sidebar dl dt").click(function(){
		$(this).toggleClass("hou");
		var sidebar_id = $(this).attr("id");
		var sidebar_dd = $(this).next("dd");
		sidebar_dd.slideToggle("slow",function(){
				sidebar_dd.css("display");
		 });
	});
});
</script>
</head>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div id="shortcut">
    <div class="w">
        <div class="fl">
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php" /></script>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">首页</a>
        </div>
        <div class="fr">
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1" style="font-weight: bold;">买家中心</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=admin_share_product">我的收藏</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_list_inbox">站内信</a>
        </div>
    </div>
</div>

<div class="header">
    <h1>
    	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php" title="<?php echo $this->_tpl_vars['config']['company']; ?>
">
        <img title="<?php echo $this->_tpl_vars['config']['company']; ?>
" alt="<?php echo $this->_tpl_vars['config']['company']; ?>
" src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>"  />
        </a>
        <i><?php echo $this->_tpl_vars['lang']['seller_center']; ?>
</i>
	</h1>
    <div class="search">
        <div class="i-search ld">
        <form method="get" class="form" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">
            <input id="m" name="m" type="hidden" value="product" />
            <input id="s" name="s" type="hidden" value="list" />
            <input type="text" autocomplete="off" placeholder="<?php echo $_GET['key']; ?>
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

<?php if (( $_GET['m'] == 'product' && $_GET['s'] == 'admin_product' ) || ( $_GET['m'] == 'tg' && $_GET['s'] == 'admin_tg' )): ?>
	<?php echo $this->_tpl_vars['output']; ?>

<?php elseif ($_GET['m'] == 'product' && $_GET['s'] == 'admin_apply_detail'): ?>
	<div class="layout"><div class="apply_detail"><?php echo $this->_tpl_vars['output']; ?>
</div></div>
<?php else: ?>
<div class="menu clearfix">
    <ul>
        <?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
		<li class="<?php if ($this->_foreach['name']['iteration'] == 1): ?>first<?php elseif (($this->_foreach['name']['iteration'] == $this->_foreach['name']['total'])): ?>last<?php endif; ?><?php if ($this->_tpl_vars['cmenu'] == $this->_tpl_vars['num']): ?> selected<?php endif; ?>"><a <?php if (((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?>target="_blank"<?php endif; ?> href="<?php if (((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '') : smarty_modifier_truncate($_tmp, 1, '')) != '?' && ((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) != 'http'): ?>?action=<?php endif; ?><?php echo $this->_tpl_vars['list']['action']; ?>
"><span><?php echo $this->_tpl_vars['list']['name']; ?>
</span></a></li>
        <?php endforeach; endif; unset($_from); ?>
    </ul>
	<a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/pay/" class="payment"><span><?php echo $this->_tpl_vars['config']['pay_name']; ?>
</span></a>
	<a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
" class="mytb"><span>我的店铺</span></a>
</div>

<?php if ($this->_tpl_vars['shop_statu'] == '-1'): ?>
<div class="shop_close_info">店铺已关闭，请联系管理员。</div>
<?php elseif ($this->_tpl_vars['shop_statu'] == '-2'): ?>
<div class="shop_close_info">店铺开启申请审核不通过，请联系管理员。</div>
<?php elseif ($this->_tpl_vars['shop_statu'] == '-3'): ?>
<div class="shop_close_info">目前为分销店铺，如果想成为商家，<a href="main.php?m=shop&s=admin_step&shop_type=2&cg_u_type=2" target="_blank">点击开店</a></div>
<?php elseif ($this->_tpl_vars['shop_statu'] == '-4'): ?>
<div class="shop_close_info">您的分销店铺正在审核过程中，审核通过商品管理功能才能使用！</div>
<?php elseif ($this->_tpl_vars['shop_statu'] == '0'): ?>
<div class="shop_close_info">店铺开启申请审核中。</div>
<?php endif; ?>
<?php if (( ! $_GET['action'] || $_GET['action'] == 'main' ) && ! $_GET['m']): ?>
<div class="intro clearfix">
    <div class="left">
        <div class="store-pic">
            <img width="95" height="95" src="<?php if (! $this->_tpl_vars['cominfo']['logo']): ?>image/default/user_admin/default_logo.gif<?php else: ?><?php echo $this->_tpl_vars['cominfo']['logo']; ?>
<?php endif; ?>" />
        </div>
        <div class="userinfo">
            <div class="basic clearfix">
                <strong><?php echo $_COOKIE['USER']; ?>
</strong>
                <a href="main.php?m=shop&s=admin_certification">
                <img src="image/default/certification<?php if ($this->_tpl_vars['cominfo']['shop_auth'] != '1'): ?>_no<?php endif; ?>.gif" />
                </a>
                <a href="main.php?m=shop&s=admin_certification">
                <img src="image/default/certautonym<?php if ($this->_tpl_vars['cominfo']['shopkeeper_auth'] != '1'): ?>_no<?php endif; ?>.gif" />
                </a>
                &nbsp;<?php echo $this->_tpl_vars['cominfo']['gradename']; ?>

            </div>
            <div>
                <span>卖家信誉:</span>
               	<img align="<?php echo $this->_tpl_vars['cominfo']['sellerpoints']; ?>
" title="<?php echo $this->_tpl_vars['cominfo']['sellerpoints']; ?>
" src="image/points/<?php echo $this->_tpl_vars['cominfo']['sellerpointsimg']; ?>
">
            </div>
            <div>
                <span>店铺名称:</span>
                <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['buid']; ?>
"><?php echo $this->_tpl_vars['cominfo']['company']; ?>
</a>
            </div>
            <div>
                <span>店铺状态:</span>
                <?php if ($this->_tpl_vars['cominfo']['shop_statu'] == 1): ?><?php echo $this->_tpl_vars['lang']['turned_display']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['closed_unopened']; ?>
<?php endif; ?>
            </div>
        </div>
    </div>
    <div class="right seller-rate">
        <h2>店铺动态评分</h2>
        <dl>
            <dt>描述相符:</dt>
            <dd class="rate-star"><em><i style="width:<?php echo $this->_tpl_vars['shop_comment']['aw']; ?>
%;"></i></em></dd>
            <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['shop_comment']['a'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
<?php echo $this->_tpl_vars['lang']['pts']; ?>
</dd>
        </dl>
        <dl>
            <dt>服务态度:</dt>
            <dd class="rate-star"><em><i style=" width:<?php echo $this->_tpl_vars['shop_comment']['bw']; ?>
%;"></i></em></dd>
            <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['shop_comment']['b'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
<?php echo $this->_tpl_vars['lang']['pts']; ?>
</dd>
        </dl>
        <dl>
            <dt>发货速度:</dt>
            <dd class="rate-star"><em><i style=" width:<?php echo $this->_tpl_vars['shop_comment']['cw']; ?>
%;"></i></em></dd>
            <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['shop_comment']['c'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
<?php echo $this->_tpl_vars['lang']['pts']; ?>
</dd>
        </dl>
    </div>
</div>
<?php endif; ?>
<div class="layout">
	<div class="sidebar">
        <?php $_from = $this->_tpl_vars['submenu']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <dl>
        	<dt><i class="pngFix"></i><?php echo $this->_tpl_vars['list']['name']; ?>
</dt>
            <dd style="display:">
            	<ul>
                	<?php $_from = $this->_tpl_vars['list']['action']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['akey'] => $this->_tpl_vars['slist']):
?>
                    <?php if ($this->_tpl_vars['slist']): ?>
                    <?php $this->assign('gets', ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('explode', true, $_tmp, "&") : smarty_modifier_explode($_tmp, "&"))); ?>
                        <li>
                        <a <?php if (((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?>target="_blank"<?php endif; ?><?php if ($_GET['action'] == $this->_tpl_vars['akey'] || in_array ( $_GET['type'] , $this->_tpl_vars['gets'] ) || in_array ( $_GET['s'] , $this->_tpl_vars['gets'] )): ?> class="active" <?php endif; ?> href="<?php if (((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '') : smarty_modifier_truncate($_tmp, 1, '')) == '?' || ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?><?php else: ?>?action=<?php endif; ?><?php echo $this->_tpl_vars['akey']; ?>
"><?php echo $this->_tpl_vars['slist']; ?>
</a>
                        </li>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </dd>
        </dl>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div class="right_content"><?php echo $this->_tpl_vars['output']; ?>
</div>
    <div class="clear"></div>
</div>
<?php endif; ?>
<div id="footer">
  <p><?php echo $this->_tpl_vars['web_con']; ?>
</p>
  <?php echo $this->_tpl_vars['bt']; ?>
<br>
</div>
</body>
</html>