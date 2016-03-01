<?php /* Smarty version 2.6.20, created on 2016-03-01 09:42:41
         compiled from upload_config.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>上传设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
</head>
<body>
	<div class="container">
        <div class="flow">
            <div class="itemtitle">
                <h3>上传设置</h3>
                <ul>
                    <li <?php if ($_GET['operation'] == ''): ?>class="current"<?php endif; ?> ><a href="upload_config.php"><span>图片设置</span></a></li>
                    <li <?php if ($_GET['operation'] == 'watermark'): ?>class="current"<?php endif; ?> ><a href="upload_config.php?operation=watermark"><span>水印设置</span></a></li>
                    <li <?php if ($_GET['operation'] == 'remote'): ?>class="current"<?php endif; ?> ><a href="upload_config.php?operation=remote"><span>远程图片</span></a></li>
                </ul>
            </div>
        </div>
        <div class="h35"></div>  
        <?php if ($_GET['operation'] == 'watermark'): ?>
            <form name="form" id="form" method="post">
            <table class="table2">
            	<tbody>
                <tr>
                    <td class="td" colspan="2">水印</td>
                </tr>
                <tr>
                	<td width="300">
                   		<table style="margin-bottom: 3px; margin-top:3px;">
                        	<tr>
                            	<td colspan="3"><input type="radio" name="wmark_locaction" id="wl0" value="0" <?php if (! $this->_tpl_vars['watermark_config']['wmark_locaction']): ?>checked="checked"<?php endif; ?> /><label for="wl0">不启用水印功能</label></td>
                            </tr>
                            <tr>
                            <?php $_from = $this->_tpl_vars['watermark_locaction']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                           		<td><input type="radio" name="wmark_locaction" id="wl<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['watermark_config']['wmark_locaction'] == $this->_tpl_vars['key']): ?>checked="checked"<?php endif; ?> /><label for="wl<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['list']; ?>
</label></td>
                            <?php if ($this->_tpl_vars['key']%3 == 0 && $this->_tpl_vars['key'] != 9): ?>
                            </tr><tr>
                            <?php endif; ?>    
                            <?php endforeach; endif; unset($_from); ?>	
                            </tr>
                            
                        </table>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="td" colspan="2">水印类型</td>
                </tr>
                <tr>
                	<td>
                 	<ul class="nofloat">
                        <li><input type="radio" onclick="document.getElementById('wmark_type').style.display='none'" <?php if ($this->_tpl_vars['watermark_config']['wmark_type'] == 1 || ! $this->_tpl_vars['watermark_config']['wmark_type']): ?>checked="checked"<?php endif; ?> id="wt_1" name="wmark_type" value="1" /><label for="wt_1">图片类型水印</label></li>
                        <li><input type="radio" onclick="document.getElementById('wmark_type').style.display=''" <?php if ($this->_tpl_vars['watermark_config']['wmark_type'] == 2): ?>checked="checked"<?php endif; ?> id="wt_2" name="wmark_type" value="2" /><label for="wt_2">文字类型水印</label></li>
					</ul>
                    </td>
                    <td class="tip"></td>
                </tr>
                </tbody>
                
                <tbody id="wmark_type" <?php if ($this->_tpl_vars['watermark_config']['wmark_type'] != 2): ?>style="display:none"<?php endif; ?>>
                <tr>
                    <td class="td" colspan="2">文本水印文字</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="wmark_words" class="w250" value="<?php if ($this->_tpl_vars['watermark_config']['wmark_words']): ?><?php echo $this->_tpl_vars['watermark_config']['wmark_words']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['company']; ?>
<?php endif; ?>" />
                    </td>
                    <td class="tip">只限于英文字符</td>
                </tr>
                <tr>
                    <td class="td" colspan="2">文本水印文字</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="wmark_words_color" class="w250" value="<?php if ($this->_tpl_vars['watermark_config']['wmark_words_color']): ?><?php echo $this->_tpl_vars['watermark_config']['wmark_words_color']; ?>
<?php else: ?>#000000<?php endif; ?>" />
                    </td>
                    <td class="tip">16进制颜色代码，比如#339900</td>
                </tr>
                </tbody>
                
                <?php if ($this->_tpl_vars['watermark']): ?>
                <tr>
                    <td class="td" colspan="2">预览</td>
                </tr>
                <tr>
                	<td colspan="2">
                 	<img src="../uploadfile/preview/cat_preview.jpg?<?php echo $this->_tpl_vars['rand']; ?>
" />
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td class="td" colspan="99">
                    <input class="submit" type="submit" value="提交">
                    <input name="act" type="hidden" id="action" value="save">
                    </td>
                </tr>
            </table>
            </form>
        <?php elseif ($_GET['operation'] == 'remote'): ?>
        	<form name="form" id="form" method="post">
            <table class="table2">
                <tr>
                    <td class="td" colspan="2">图片远程存储</td>
                </tr>
                <tr>
                	<td width="300">
                    <ul class="nofloat">
                    <li><input type="radio" name="image_remote_storage" value="1" id="open" <?php if ($this->_tpl_vars['remote_config']['image_remote_storage'] == 1): ?>checked="checked"<?php endif; ?>/><label for="open">开启</label></li>
                    <li><input type="radio" name="image_remote_storage" value="0" id="close" <?php if ($this->_tpl_vars['remote_config']['image_remote_storage'] != 1): ?>checked="checked"<?php endif; ?>/><label for="close">关闭</label></li>
					</ul>
                    </td>
                    <td></td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">FTP服务器地址</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="ftp_server" class="w250" value="<?php echo $this->_tpl_vars['remote_config']['ftp_server']; ?>
" />
                    </td>
                    <td class="tip"></td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">空间名</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="space_name" class="w250" value="<?php echo $this->_tpl_vars['remote_config']['space_name']; ?>
" />
                    </td>
                    <td class="tip"></td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">FTP帐号</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="ftp_name" class="w250" value="<?php echo $this->_tpl_vars['remote_config']['ftp_name']; ?>
" />
                    </td>
                    <td class="tip"></td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">FTP密码</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="ftp_password" class="w250" value="<?php echo $this->_tpl_vars['remote_config']['ftp_password']; ?>
" />
                    </td>
                    <td class="tip"></td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">远程附件目录</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="remote_directory" class="w250" value="<?php echo $this->_tpl_vars['remote_config']['remote_directory']; ?>
" />
                    </td>
                    <td class="tip"></td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">远程访问URL</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="remote_access_url" class="w250" value="<?php echo $this->_tpl_vars['remote_config']['remote_access_url']; ?>
" />
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
        <?php else: ?>
			<form name="form" id="form" method="post">
            <table class="table2">
                <tr>
                    <td class="td" colspan="2">图片存放类型</td>
                </tr>
                <tr>
                	<td width="300">
                    <ul class="nofloat">
                        <?php $_from = $this->_tpl_vars['image_storage_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                        <li><input type="radio" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['image_config']['image_storage_type'] || $this->_tpl_vars['key'] == 1): ?>checked="checked"<?php endif; ?> id="ist_<?php echo $this->_tpl_vars['key']; ?>
" name="image_storage_type" value="<?php echo $this->_tpl_vars['key']; ?>
" /><label for="ist_<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['list']; ?>
</label></li>
                        <?php endforeach; endif; unset($_from); ?>
					</ul>
                    </td>
                    <td></td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">图片文件大小</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="image_size" class="" value="<?php if ($this->_tpl_vars['image_config']['image_size']): ?><?php echo $this->_tpl_vars['image_config']['image_size']; ?>
<?php else: ?>1024<?php endif; ?>" />&nbsp;&nbsp;KB
                    </td>
                    <td class="tip">当前服务器环境,最大允许上传<?php echo $this->_tpl_vars['upload_max_filesize']; ?>
(1024KB=1M)</td>
                </tr>
                
                <tr>
                    <td class="td" colspan="2">图片扩展名</td>
                </tr>
                <tr>
                	<td>
                 	<input type="text" name="image_extension" class="w250" value="<?php if ($this->_tpl_vars['image_config']['image_extension']): ?><?php echo $this->_tpl_vars['image_config']['image_extension']; ?>
<?php else: ?>gif,jpg,jpeg,bmg,png,tbi<?php endif; ?>" />
                    </td>
                    <td class="tip">图片扩展名,用于上传图片是否为后台允许,多个后缀名名用","隔开</td>
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