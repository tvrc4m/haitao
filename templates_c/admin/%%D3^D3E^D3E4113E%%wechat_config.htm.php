<?php /* Smarty version 2.6.20, created on 2016-03-03 13:02:59
         compiled from wechat_config.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'wechat_config.htm', 49, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>微信公众平台</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>微信公众平台</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?> ><a href="wechat_config.php"><span>微信公众平台设置</span></a></li>
                    <li <?php if ($_GET['operation'] == 'item'): ?>class="current"<?php endif; ?> ><a href="wechat_config.php?operation=item"><span>微信自定义菜单</span></a></li>
                </ul>
            </div>
        </div>
        <div class="h35"></div>
        <?php if ($_GET['operation'] == 'item'): ?>
        <form name="form" id="form" method="post">
		<table class="table2"> <tr>
			 <tr>
                <td class="td" colspan="2">AppId</td>
            </tr>
         	<tr>
                <td width="200">
                <input name="wechat_app_id" type="text" class="w250" value="<?php echo $this->_tpl_vars['wechat_config']['wechat_app_id']; ?>
" />
                </td>
                <td></td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">AppSecret</td>
            </tr>
            <tr>
                <td width="200">
                <input type="text" name="wechat_app_secret" class="w250" value="<?php echo $this->_tpl_vars['wechat_config']['wechat_app_secret']; ?>
" />
                </td>
                <td class="tip"></td>
            </tr>

            <tr>
                <td class="td" colspan="2">自定义菜单</td>
            </tr>
            <tr>
                <td width="400">
                    <textarea name="wechat_app_item" class="w250"   rows="20"  style="width: 500px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wechat_config']['wechat_app_item'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
                </td>
                <td class="tip"><a target="_blank" href="http://mp.weixin.qq.com/wiki/13/43de8269be54a0a6f64413e4dfa94f39.html">什么是自定义菜单？</a></td>
            </tr>

            <tr>
                <td class="td" colspan="99">
                <input class="submit" type="submit" value="提交">
                <input name="act" type="hidden" id="action" value="item">
                </td>
            </tr>
        </table>
        </form>
        <?php else: ?>
        <form name="form" id="form" method="post">
            <table class="table2"> <tr>
                <tr>
                    <td class="td" colspan="2">URL</td>
                </tr>
                <tr>
                    <td width="200">
                        <input readonly="readonly" type="text" class="w250" value="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/wechat.php" />
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td class="td" colspan="2">Token</td>
                </tr>
                <tr>
                    <td width="200">
                        <input type="text" name="wechat" class="w250" value="<?php echo $this->_tpl_vars['wechat_config']['wechat']; ?>
" />
                    </td>
                    <td class="tip"><a target="_blank" href="http://mp.weixin.qq.com/wiki/index.php?title=%E6%8E%A5%E5%85%A5%E6%8C%87%E5%8D%97">什么是Token？</a></td>
                </tr>

                <tr>
                    <td class="td" colspan="99">
                        <input class="submit" type="submit" value="提交">
                        <input name="act" type="hidden" id="action" value="save">
                    </td>
                </tr>
            </table>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>