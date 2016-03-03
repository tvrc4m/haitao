<?php /* Smarty version 2.6.20, created on 2016-03-03 15:00:40
         compiled from sms_config.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>短信设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>短信设置</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?> ><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>短信设置</span></a></li>
                    <li <?php if ($_GET['operation'] == 'test'): ?>class="current"<?php endif; ?> ><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&operation=test"><span>短信测试</span></a></li>
				</ul>
            </div>
        </div>
        <div class="h35"></div>  
        <?php if ($_GET['operation'] == 'test'): ?>
            <form name="smsconfig" action="" method="post">
            <input type="hidden" name="sub" value="sms" />
            <table class="table2">
            <tr>
                <td class="td" colspan="2">手机</td>
            </tr>
			<tr>
				<td>
                <input class="w350" name="mob" type="text" id="mob" value="">
                </td>
                <td class="tip"></td>
            </tr>
            <tr>
                <td class="td" colspan="2">内容</td>
            </tr>
			<tr>
				<td><textarea name="con" class="w350"></textarea></td>
                <td class="tip"></td>
            </tr>
            <tr>
                <td class="td" colspan="99">
                    <input class="submit" type="submit" value="发送">
                    <input name="act" type="hidden" id="action" value="send">
                </td>
            </tr>
            </table>
            </form>
        <?php else: ?>
        <form name="sysconfig" action="" method="post">
            <table class="table2">
            <tr>
                <td class="td" colspan="2">帐号</td>
            </tr>
            <tr>
                <td>
                <input class="w350" name="sms_account" type="text" id="sms_account" value="<?php echo $this->_tpl_vars['reg_config']['sms_account']; ?>
">
                </td>
                <td class="tip"></td>
            </tr>
            <tr>
                <td class="td" colspan="2">密码</td>
            </tr>
            <tr>
                <td>
                <input class="w350" name="sms_pass" type="text" id="sms_pass" value="<?php echo $this->_tpl_vars['reg_config']['sms_pass']; ?>
">
                </td>
                <td class="tip"></td>
            </tr>

            <tr>
                <td class="td" colspan="2">签名</td>
            </tr>
            <tr>
                <td>
                    <input class="w350" name="sms_sigin" type="text" id="sms_sigin" value="<?php echo $this->_tpl_vars['reg_config']['sms_sigin']; ?>
">
                </td>
                <td class="tip"></td>
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