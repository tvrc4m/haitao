<?php /* Smarty version 2.6.20, created on 2016-03-01 09:39:44
         compiled from reg_config.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unserialize', 'reg_config.htm', 73, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>会员注册设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>会员注册设置</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?> ><a href="reg_config.php"><span>注册</span></a></li>
                </ul>
            </div>
        </div>
        <div class="h35"></div>
        <?php if ($_GET['operation'] == 'access'): ?>
        
        
        <?php else: ?>  
        <form name="form" id="form" method="post" enctype="multipart/form-data">
		<table class="table2">
        	<tr>
                <td class="td" colspan="2">允许新用户注册:</td>
            </tr>
            <tr>
                <td width="400">
<p class="mb6 clearfix"><label><input type="radio" name="closetype" value="0" checked="checked" />&nbsp;开启</label></p>
<p class="clearfix"><label><input type="radio" name="closetype" value="2" <?php if ($this->_tpl_vars['reg_config']['closetype'] == 2): ?>checked="checked"<?php endif; ?> />&nbsp;关闭</label></p>
                </td>
                <td class="tip">设置是否允许游客注册成为会员。</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">关闭注册提示信息:</td>
            </tr>
            <tr>
                <td>
                <textarea name="closecon" class="w245" rows="3"><?php echo $this->_tpl_vars['reg_config']['closecon']; ?>
</textarea>
                </td>
                <td class="tip">当站点关闭注册时的提示信息</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">受保护用户名:</td>
            </tr>
            <tr>
                <td>
                <textarea name="censoruser" class="w245" rows="3"><?php echo $this->_tpl_vars['reg_config']['censoruser']; ?>
</textarea>
                </td>
                <td class="tip">用户在注册时无法使用这些用户名。每个用户名一行</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">密码最小长度:</td>
            </tr>
            <tr>
                <td>
                <input maxlength="3" type="text" class="w250" name="pwlength" value="<?php if ($this->_tpl_vars['reg_config']['pwlength']): ?><?php echo $this->_tpl_vars['reg_config']['pwlength']; ?>
<?php else: ?>4<?php endif; ?>" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"/>
                </td>
                <td class="tip">新用户注册时密码最小长度，0或不填为不限制</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">强制密码复杂度:</td>
            </tr>
            <tr>
                <td>
                <input type="hidden" name="strongpw[]" value="" />
                <?php $this->assign('array', ((is_array($_tmp=$this->_tpl_vars['reg_config']['strongpw'])) ? $this->_run_mod_handler('unserialize', true, $_tmp) : unserialize($_tmp))); ?>
                <p class="clearfix"><label><input <?php if (@ in_array ( 1 , $this->_tpl_vars['array'] )): ?>checked="checked"<?php endif; ?> type="checkbox" name="strongpw[]" value="1" />&nbsp;数字</label></p>
                <p class="mtb6 clearfix"><label><input <?php if (@ in_array ( 2 , $this->_tpl_vars['array'] )): ?>checked="checked"<?php endif; ?> type="checkbox" name="strongpw[]" value="2" />&nbsp;小写字母</label></p>
                <p class="mb6 clearfix"><label><input <?php if (@ in_array ( 3 , $this->_tpl_vars['array'] )): ?>checked="checked"<?php endif; ?> type="checkbox" name="strongpw[]" value="3" />&nbsp;大写字母</label></p>
                <p class="clearfix"><label><input <?php if (@ in_array ( 4 , $this->_tpl_vars['array'] )): ?>checked="checked"<?php endif; ?> type="checkbox" name="strongpw[]" value="4" />&nbsp;符号</label></p>
                </td>
                <td class="tip">新用户注册时密码中必须存在所选字符类型，不选则为无限制</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">新用户注册验证:</td>
            </tr>
            <tr>
                <td>
                <p class="clearfix"><label><input type="radio" name="user_reg" value="1" checked="checked" />&nbsp;无</label></p>
                <p class="mtb6 clearfix"><label><input type="radio" name="user_reg" value="2" <?php if ($this->_tpl_vars['reg_config']['user_reg'] == 2): ?>checked="checked"<?php endif; ?> />&nbsp;Email 验证</label></p>
                <p class="clearfix"><label><input type="radio" name="user_reg" value="3" <?php if ($this->_tpl_vars['reg_config']['user_reg'] == 3): ?>checked="checked"<?php endif; ?> />&nbsp;手机验证</label></p>
                </td>
                <td class="tip" valign="top">选择"无"用户可直接注册成功；选择"Email 验证"将向用户注册 Email 发送一封验证邮件以确认邮箱的有效性；选择"手机 验证"将向用户注册手机发送一条短信验证码验以确认手机的有效性。</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">会员注册随机问题:</td>
            </tr>
            <tr>
                <td>
                <label><input type="radio" name="user_reg_verf" value="0" checked="checked" />关闭</label>
                <label><input type="radio" name="user_reg_verf" value="1" <?php if ($this->_tpl_vars['reg_config']['user_reg_verf'] == 1): ?>checked="checked"<?php endif; ?>/>开启</label>
                <a href="user_reg_verf.php">[设置问题]</a>
                </td>
                <td></td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">是否有论坛关联:</td>
            </tr>
            <tr>
                <td>
                <label><input type="radio" name="openbbs" value="0" checked="checked" />关闭</label>
                <label><input type="radio" name="openbbs" value="2" <?php if ($this->_tpl_vars['reg_config']['openbbs'] == 2): ?>checked="checked"<?php endif; ?> />开启</label>
                <a href="uc_config.php">[整合设置]</a>
                </td>
                <td></td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">同一 IP 注册间隔限制(小时):</td>
            </tr>
            <tr>
                <td>
                <input maxlength="3" type="text" class="w250" name="regctrl" value="<?php if ($this->_tpl_vars['reg_config']['regctrl']): ?><?php echo $this->_tpl_vars['reg_config']['regctrl']; ?>
<?php else: ?>0<?php endif; ?>" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"/>
                </td>
                <td class="tip">同一 IP 在本时间间隔内将只能注册一个帐号，0 为不限制</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">同一 IP 在 24 小时允许注册的最大次数:</td>
            </tr>
            <tr>
                <td>
                <input maxlength="3" type="text" class="w250" name="regfloodctrl" value="<?php if ($this->_tpl_vars['reg_config']['regfloodctrl']): ?><?php echo $this->_tpl_vars['reg_config']['regfloodctrl']; ?>
<?php else: ?>0<?php endif; ?>" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"/>
                </td>
                <td class="tip">同一 IP 地址在 24 小时内尝试注册的次数限制，建议在 30 - 100 范围内取值，0 为不限制</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">限时注册IP注册间隔限制(小时):</td>
            </tr>
            <tr>
                <td>
                <input maxlength="3" type="text" class="w250" name="ipregctrltime" value="<?php if ($this->_tpl_vars['reg_config']['ipregctrltime']): ?><?php echo $this->_tpl_vars['reg_config']['ipregctrltime']; ?>
<?php else: ?>72<?php endif; ?>" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"/>
                </td>
                <td class="tip">同一 IP 在本时间间隔内将只能注册一个帐号，0 为不限制</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">限时注册的 IP 列表:</td>
            </tr>
            <tr>
                <td>
                <textarea name="ipregctrl" class="w245" rows="3"><?php echo $this->_tpl_vars['reg_config']['ipregctrl']; ?>
</textarea>
                </td>
                <td class="tip">当用户处于本列表中的 IP 地址时，在限时注册IP注册间隔限制内将至多只允许注册一个帐号。每个 IP 一行。</td>
            </tr>
            
            <tr>
                <td class="td" colspan="2">注册协议:</td>
            </tr>
            <tr>
                <td colspan="2">
                <script charset="utf-8" src="../lib/kindeditor/kindeditor-min.js"></script>			
				<script>
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="association"]', {
					});
				});
				</script>
                <textarea name="association" style="width:98%;" rows="20"><?php echo $this->_tpl_vars['reg_config']['association']; ?>
</textarea>
                </td>
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