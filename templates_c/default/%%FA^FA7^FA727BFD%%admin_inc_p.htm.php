<?php /* Smarty version 2.6.20, created on 2016-03-01 10:59:58
         compiled from admin_inc_p.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'admin_inc_p.htm', 53, false),array('modifier', 'explode', 'admin_inc_p.htm', 79, false),)), $this); ?>
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
<meta name="generator" content="<?php echo $this->_tpl_vars['config']['version']; ?>
" />

<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/css/buyer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jcarousel/skins/tango/skin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/base.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jcarousel/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.charCount.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/sns.js"></script>
</head>
<body class="member">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<div id="shortcut">
    <div class="w">
        <div class="fl"> 
            <script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php"></script> 
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">首页</a>
        </div>
        <div class="fr">
            <?php if ($this->_tpl_vars['cominfo']['shop_type'] == 1): ?>
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=shop&s=admin_step&shop_type=2&cg_u_type=2" style="font-weight: bold;">卖家中心</a>
            <?php else: ?>
                <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=2" style="font-weight: bold;">卖家中心</a>
            <?php endif; ?>
            <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/index.php?m=product&s=cart">我的购物车</a> 
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=admin_share_product">我的收藏</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_list_inbox">站内消息</a>
        </div>
    </div>
</div>

<div id="main">
    <div class="header">
        <h1 style="top:20px;">
        	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php" title="<?php echo $this->_tpl_vars['config']['company']; ?>
"> <img title="<?php echo $this->_tpl_vars['config']['company']; ?>
" alt="<?php echo $this->_tpl_vars['config']['company']; ?>
" src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>" /></a>
        </h1>
        <div id="nav">
            <ul>
                <?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
                <li class="<?php if ($this->_tpl_vars['cmenu'] == $this->_tpl_vars['num']): ?>frist<?php endif; ?>"><a <?php if (((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?>target="_blank"<?php endif; ?> href="<?php if (((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '') : smarty_modifier_truncate($_tmp, 1, '')) != '?' && ((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) != 'http'): ?>?action=<?php endif; ?><?php echo $this->_tpl_vars['list']['action']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></li>
                <?php endforeach; endif; unset($_from); ?>
            </ul>
            <div class="search_box">
                <form target="_blank" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/" method="get">
                    <input type="text" maxlength="200" class="text" id="key" name="key">
                    <input type="submit" class="submit" value="" name="">
                    <input type="hidden" name="m" value="" />
                    <input type="hidden" name="s" value="list" />
                </form>
            </div>
        </div>
    </div>

	<?php if ($_GET['m'] == 'product' && ( $_GET['s'] == 'admin_receipt' )): ?>
		<?php echo $this->_tpl_vars['output']; ?>

    <?php else: ?>
    <div class="layout buyer clearfix">
        <div class="left_con">
            <?php if ($this->_tpl_vars['cmenu'] == 'user'): ?>
                <?php $_from = $this->_tpl_vars['submenu']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
                    <div class="business_handle" id="my_menu">
                        <h3 style="text-indent:20px;"><?php echo $this->_tpl_vars['list']['name']; ?>
</h3>
                        <ul>
                            <?php $_from = $this->_tpl_vars['list']['action']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['akey'] => $this->_tpl_vars['slist']):
?>
                            <?php if ($this->_tpl_vars['slist']): ?>
                            <?php $this->assign('gets', ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('explode', true, $_tmp, "&") : smarty_modifier_explode($_tmp, "&"))); ?>
                             <li <?php if ($_GET['action'] == $this->_tpl_vars['akey'] || in_array ( $_GET['type'] , $this->_tpl_vars['gets'] ) || in_array ( $_GET['s'] , $this->_tpl_vars['gets'] ) || ( $this->_tpl_vars['gets']['s'] == admin_security && $_GET['s'] == 'mail' )): ?>class="active"<?php else: ?>class="normal"<?php endif; ?> ><a href="<?php if (((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '') : smarty_modifier_truncate($_tmp, 1, '')) == '?' || ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?><?php echo $this->_tpl_vars['akey']; ?>
<?php else: ?>?action=<?php echo $this->_tpl_vars['akey']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['slist']; ?>
</a>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
                <dl class="user">
                    <dd>
                        <div class="pic">
                       		<a href="main.php?m=member&s=admin_member">
                        		<img height="100" width="100" src="<?php if (! $this->_tpl_vars['cominfo']['plogo']): ?>image/default/user_admin/default_user_portrait.gif<?php else: ?><?php echo $this->_tpl_vars['cominfo']['plogo']; ?>
<?php endif; ?>" />
							</a>
                        </div>
                    </dd>
                </dl>
               
                <div class="business_handle" id="my_menu">
                    <h3><?php echo $this->_tpl_vars['lang']['trading_operations']; ?>
</h3>
                    <?php $_from = $this->_tpl_vars['submenu']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['name']['iteration']++;
?>
                        <?php if (((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '') : smarty_modifier_truncate($_tmp, 1, '')) == '?'): ?>
                       	 <?php $this->assign('gets', ((is_array($_tmp=$this->_tpl_vars['list']['action'])) ? $this->_run_mod_handler('explode', true, $_tmp, "&") : smarty_modifier_explode($_tmp, "&"))); ?>
                            <div class="<?php if ($_GET['action'] == $this->_tpl_vars['list']['action'] || in_array ( $_GET['type'] , $this->_tpl_vars['gets'] ) || in_array ( $_GET['s'] , $this->_tpl_vars['gets'] )): ?>active<?php else: ?>normal<?php endif; ?>"><em class="i<?php echo $this->_foreach['name']['iteration']; ?>
"></em><a href="<?php echo $this->_tpl_vars['list']['action']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></div>
						<?php else: ?>
                            <dl>
                            <dt><em class="i<?php echo $this->_foreach['name']['iteration']; ?>
"></em><a href="javascript:void(0)"><?php echo $this->_tpl_vars['list']['name']; ?>
</a></dt>
                                <?php $_from = $this->_tpl_vars['list']['action']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['akey'] => $this->_tpl_vars['slist']):
?>
                                <?php if ($this->_tpl_vars['slist']): ?>
                                <?php $this->assign('gets', ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('explode', true, $_tmp, "&") : smarty_modifier_explode($_tmp, "&"))); ?>
                                    <dd <?php if ($_GET['action'] == $this->_tpl_vars['akey'] || in_array ( $_GET['type'] , $this->_tpl_vars['gets'] ) || in_array ( $_GET['s'] , $this->_tpl_vars['gets'] )): ?>class="active"<?php else: ?>class="normal"<?php endif; ?> ><a href="<?php if (((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '') : smarty_modifier_truncate($_tmp, 1, '')) == '?' || ((is_array($_tmp=$this->_tpl_vars['akey'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, '') : smarty_modifier_truncate($_tmp, 4, '')) == 'http'): ?><?php echo $this->_tpl_vars['akey']; ?>
<?php else: ?>?action=<?php echo $this->_tpl_vars['akey']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['slist']; ?>
</a>
                                    </dd>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </dl>
                        <?php endif; ?>   
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="right_con"><?php echo $this->_tpl_vars['output']; ?>
</div>
	</div>
    <?php endif; ?>
</div>    
<div id="footer">
    <p><?php echo $this->_tpl_vars['web_con']; ?>
</p>
    <?php echo $this->_tpl_vars['bt']; ?>
<br>
</div>

<?php echo $this->_tpl_vars['chat_html']; ?>


</body>
</html>