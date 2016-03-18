<?php /* Smarty version 2.6.20, created on 2016-03-16 14:29:27
         compiled from user_admin/admin_msg.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'user_admin/admin_msg.htm', 43, false),)), $this); ?>
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
</head>
<div id="shortcut">
    <div class="w">
        <div class="fl">
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php" /></script>
			<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/"><?php echo $this->_tpl_vars['lang']['homepage']; ?>
</a>
        </div>
        <div class="fr">
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1"><?php echo $this->_tpl_vars['lang']['enter_the_buyer_center']; ?>
</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=admin_share_product"><?php echo $this->_tpl_vars['lang']['my_favorites']; ?>
</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_list_inbox"><?php echo $this->_tpl_vars['lang']['news_station']; ?>
</a>
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
	<div class="tip">
        <p class="<?php if ($_GET['type']): ?>failure<?php else: ?>success<?php endif; ?>">
            <span>
            	<?php if ($_GET['str']): ?>
                	<?php if ($_GET['str'] == 'shop_statu'): ?>
                        <?php if ($_GET['n'] == '-1'): ?>
                        店铺已关闭，请联系管理员。
                        <?php elseif ($_GET['n'] == '-2'): ?>
                        店铺开启申请审核不通过，请联系管理员。
                        <?php elseif ($_GET['n'] == '-3'): ?>
                        店铺为分销店铺，如果升级为商铺，请联系管理员。
                        <?php elseif ($_GET['n'] == '-4'): ?>
                        您的分销店铺正在审核过程中，审核通过商品管理功能才能使用！
                        <?php else: ?>
                        您的店铺正在审核过程中，审核通过商品管理功能才能使用！
                        <?php endif; ?>
                    <?php else: ?>
            		<?php echo $_GET['str']; ?>

                    <?php endif; ?>
            	<?php else: ?>
                	<?php echo $this->_tpl_vars['lang']['edit_suc']; ?>

            	<?php endif; ?>
            </span>
        </p>
    </div>
</div>
<div id="footer">
  <p><?php echo $this->_tpl_vars['web_con']; ?>
</p>
  <?php echo $this->_tpl_vars['bt']; ?>
<br>
</div>
<script>
function gotourl(url)
{
	var time=900;
	<?php if ($_GET['time']): ?>
	var time=<?php echo $_GET['time']; ?>
;
	<?php endif; ?>
	setTimeout("gotourl1('"+url+"')",time);//设定超时时间
}
function gotourl1(url)
{
	window.location=url;
}
<?php if ($_GET['url']): ?>
gotourl('<?php echo $_GET['url']; ?>
');
<?php endif; ?>
</script>