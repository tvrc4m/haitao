<?php /* Smarty version 2.6.20, created on 2016-03-01 09:38:57
         compiled from app_push_config.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>App推送设置</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="admin.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
<div class="container">
    <div class="flow">
        <div class="itemtitle">
            <h3>App推送设置</h3>
            <ul>
                <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?> ><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
"><span>推送设置</span></a></li>
                <li <?php if ($_GET['operation'] == 'test'): ?>class="current"<?php endif; ?> ><a href="?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&operation=test"><span>通知推送</span></a></li>
            </ul>
        </div>
    </div>
    <div class="h35"></div>
    <?php if ($_GET['operation'] == 'test'): ?>
    <form name="smsconfig" action="" method="post">
        <input type="hidden" name="sub" value="sms" />
        <table class="table2">
            <tr>
                <td class="td" colspan="2">推送标题</td>
            </tr>
            <tr>
                <td>
                    <input class="w350" name="msg_title" type="text" id="msg_title" value="">
                </td>
                <td class="tip"></td>
            </tr>
            <tr>
                <td class="td" colspan="2">推送内容</td>
            </tr>
            <tr>
                <td><textarea name="msg_content" class="w350"></textarea></td>
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
                <td class="td" colspan="2">AppKey</td>
            </tr>
            <tr>
                <td>
                    <input class="w350" name="jpush_app_key" type="text" id="jpush_app_key" value="<?php echo $this->_tpl_vars['reg_config']['jpush_app_key']; ?>
">
                </td>
                <td class="tip"></td>
            </tr>
            <tr>
                <td class="td" colspan="2">Master Secret</td>
            </tr>
            <tr>
                <td>
                    <input class="w350" name="jpush_app_secret" type="text" id="jpush_app_secret" value="<?php echo $this->_tpl_vars['reg_config']['jpush_app_secret']; ?>
">
                </td>
                <td class="tip"></td>
            </tr>
            <tr>
                <td colspan="3" align="left" >
                <span class="bz">采用Jpush，对应设置，到<a href="https://www.jpush.cn/" target="_blank">极光推送</a>上申请</span> </td>
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