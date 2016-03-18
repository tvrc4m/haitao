<?php /* Smarty version 2.6.20, created on 2016-03-16 14:31:30
         compiled from points_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'points_index.htm', 42, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "points_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="w clearfix">
	<div class="bannbar fl"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=10'></script></div>
    <div class="launch fr"><h2></h2><div><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=11'></script></div></div>
</div>
<div class="w">
	    <div class="m all">
    	<div class="mt mt-voucher">
            <a class="fr" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=points&s=list&type=voucher">更多&gt;&gt;</a>
        </div>
        <div class="mc clearfix">
            <ul class="voucher-list">
                <?php $_from = $this->_tpl_vars['voucher']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
            	<li <?php if (( $this->_tpl_vars['key']+1 ) % 3 == 0): ?>class="fr"<?php endif; ?> >
                    
                    <div class="voucher">
                    <div class="cut"></div>
                    <div class="info"><a class="store" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['list']['shop_id']; ?>
"><?php echo $this->_tpl_vars['list']['shop_name']; ?>
</a>
                      <p class="pline"><?php echo $this->_tpl_vars['list']['name']; ?>
</p>
                      <div class="pic"><img onerror="'" src="<?php echo $this->_tpl_vars['list']['logo']; ?>
"></div>
                    </div>
                    <dl class="value">
                      <dt>¥<em><?php echo $this->_tpl_vars['list']['price']; ?>
</em></dt>
                      <dd>购物满 <?php echo $this->_tpl_vars['list']['limit']; ?>
 元可用</dd>
                      <dd class="time">有效期至<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</dd>
                    </dl>
                    <div class="point">
                      <p class="required w120">需<em><?php echo $this->_tpl_vars['list']['points']; ?>
 </em>积分</p>
                      <p class="w120">每人限领<em><?php echo $this->_tpl_vars['list']['eachlimit']; ?>
</em>张</p>
                      <p class="w120">已发放<em><?php echo $this->_tpl_vars['list']['giveout']; ?>
</em>张</p>
                    </div>
                    <div class="button"><a class="ncp-btn ncp-btn-red" data-param="<?php echo $this->_tpl_vars['list']['id']; ?>
,<?php echo $this->_tpl_vars['list']['shop_id']; ?>
" nc_type="exchangebtn" href="javascript:void(0);" target="_blank">立即兑换</a></div>
                  </div>
                </li>
		<?php endforeach; endif; unset($_from); ?>
            </ul>
        </div>
    </div>
	<div class="m all">
    	<div class="mt">
            <a class="fr" href="?m=points&s=list">更多&gt;&gt;</a>
        </div>
        <div class="mc clearfix">
       		<ul>
                <?php $_from = $this->_tpl_vars['de']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
            	<li <?php if (( $this->_tpl_vars['key']+1 ) % 6 == 0): ?>class="fr"<?php endif; ?> >
                	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=points&s=detail&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">
                        <img src="<?php echo $this->_tpl_vars['list']['pic']; ?>
">
                        <h3><?php echo $this->_tpl_vars['list']['name']; ?>
</h3>
                        <p>所需积分<b><?php echo $this->_tpl_vars['list']['points']; ?>
</b></p>
                    </a>
                </li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/dialog/dialog.js" id="dialog_js"></script>
<script>
$(".ncp-btn-red").live('click',function(){
	var uname='<?php echo $_COOKIE['USER']; ?>
';
        var key = $(this).attr("data-param")
	if(uname=='')
	{
		alert('请登录以后再进行本操作！');
		window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward='+encodeURIComponent("index.php/?m=points&s=detail&id=1");
		return false;
	}					
	ajax_form("buy", '代金券兑换', '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=points&s=voucher_order&data='+key,500);
	return false;
});
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "points_footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>