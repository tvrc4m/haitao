<?php /* Smarty version 2.6.20, created on 2016-03-03 11:37:40
         compiled from header.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'header.htm', 27, false),array('modifier', 'truncate', 'header.htm', 56, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "site_nav.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="header">
	<div class="w fn-clear">
        <div class="logo">
        <a title="<?php echo $this->_tpl_vars['config']['company']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><img src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>" /></a>
        </div>
        
        <?php if ($this->_tpl_vars['domain']): ?>
        <div class="domain">
        	<p class="p"><?php echo $this->_tpl_vars['domain']; ?>
</p>
            <p><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/sub_site.php">[城市分站]</a></p>
        </div>
        <?php endif; ?>
        
        <div class="search">
            <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" class="form" method="get">
            <div class="i-search">
                <input type="hidden" value="product" name="m" id="m">
                <input type="hidden" value="list" name="s" id="s">
                <input autocomplete="off" onkeyup="get_search_word(this.value);" value="<?php echo $_GET['key']; ?>
" type="text" class="text" id="key" name="key"/>
            </div>
            <div id="key_select"></div>
            <input type="submit" value="搜&nbsp;索" class="button">
            </form>
            <div class="hotwords">
                <strong>热门搜索：</strong>
                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'searchword', 'temp' => 'search_word', 'limit' => 12)), $this); ?>

            </div>
        </div>
		<dl class="code noborder">
            <dd><img width="100" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/down.png"></dd>
            <div class="hidden showDown">
                <img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/code-down.jpg" />
            </div>
        </dl>    
    </div>  
</div>
<script type="text/javascript">
    $(".code").hover(function(){
         $(this).find(".showDown").css({"display":"block"})
    },function(){
        $(this).find(".showDown").css({"display":"none"})
    })
</script>
<div class="menu">
    <div class="w">
    <dl class="dl">
        <dt class="dt"><h2><a href="javascript:void(0);">全部商品分类</a></h2></dt>
		<dd class="dd" <?php if ($_GET['m'] == 'product' && $_GET['s'] == 'index'): ?>style="display:block" <?php endif; ?> >
            <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'cat', 'temp' => 'pro_cat_shop_left')), $this); ?>

            </dd>
        </dl>
        <ul class="menu-items">
            <?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nav'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
        $this->_foreach['nav']['iteration']++;
?>
            <li <?php if ($this->_tpl_vars['list']['identifier'] == $this->_tpl_vars['current']): ?>class="current"<?php endif; ?>>
                <a href="<?php if (((is_array($_tmp=$this->_tpl_vars['list']['url'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?><?php echo $this->_tpl_vars['list']['url']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['list']['url']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['list']['name']; ?>
</a>
                <?php if ($this->_tpl_vars['list']['scat']): ?>
                <div class="i-items">
                    <?php $_from = $this->_tpl_vars['list']['scat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                    <a href="<?php if (((is_array($_tmp=$this->_tpl_vars['slist']['url'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?><?php echo $this->_tpl_vars['slist']['url']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/<?php echo $this->_tpl_vars['slist']['url']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['slist']['name']; ?>
</a>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
                <?php endif; ?>
            </li>
            <?php endforeach; endif; unset($_from); ?>
			<li class="cart">
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=product&s=cart">
                <b><script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart_number"></script></b>
                我的购物车
                </a>
            </li>
        </ul>
    </div>
</div>
<script>
$('.menu-items li').hover(function(){					 
	$(this).addClass("hover");
},function(){
	$(this).removeClass("hover");	
});
function get_search_word(k)
{
    if(k!='')
    {
        var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/ajax_back_end.php';
        var sj = Math.random();
        var pars = 'shuiji=' + sj+'&search_flag=1&key='+k;
        $.post(url, pars,showResponse);
    }

    function showResponse(originalRequest)
    {
        if(originalRequest)
        {
            $('#key_select').show();
            //$('#key_select').css("display",'block');
            $('#key_select').html(originalRequest);
        }
        else
            $('#key_select').hide();
    }

}
function select_word(v)
{
    $('#key').val(v);
    $('#key_select').hide();
}
</script>