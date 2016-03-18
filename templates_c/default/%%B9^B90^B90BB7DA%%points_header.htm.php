<?php /* Smarty version 2.6.20, created on 2016-03-16 14:31:30
         compiled from points_header.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_tpl_vars['title']): ?><?php echo $this->_tpl_vars['title']; ?>
,<?php echo $this->_tpl_vars['config']['company']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['title']; ?>
,<?php echo $this->_tpl_vars['config']['company']; ?>
<?php endif; ?></title>
<meta name="description" content="<?php echo $this->_tpl_vars['config']['description']; ?>
" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['config']['keyword']; ?>
" />
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/base.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.flexslider-min.js"></script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/points/templates/points.css">
</head>
<body>
<div id="shortcut">
    <div class="w clearfix">
        <ul class="fl">
            <li><script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login_statu.php"></script></li>
        </ul>
        <ul class="fr">
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">首页</a></li>
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=2">我的商城</a></li>
            <li><a class="active" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=points">积分商城</a></li>
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=points&s=admin_points">我的积分</a></li>
            <li><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?cg_u_type=1&m=points&s=admin_points_order">我的礼品</a></li>
        </ul>
    </div>
</div>
<div class="logobar clearfix">
	<div class="w">
    	<div class="fl">
            <a title="<?php echo $this->_tpl_vars['config']['company']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><img src="<?php if ($this->_tpl_vars['config']['logo']): ?><?php echo $this->_tpl_vars['config']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/logo.gif<?php endif; ?>" /></a>
            <s></s>
            <b></b>
        </div>
        <div class="fr">
            <div class="search">
            <form method="get" class="form" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/">
                <input id="m" name="m" type="hidden" value="points" />
                <input id="s" name="s" type="hidden" value="list" />
                <input type="text" autocomplete="off" placeholder="请输入关键字" value="<?php echo $_GET['key']; ?>
" id="key" name="key" class="text">
                <input type="submit" class="search_button" value="搜&nbsp;索">
			</form>
            </div>
        </div>
    </div>
</div>
<div class="menubar clearfix">
    <div class="w">
        <div class="categorys fl">
			<h2><a href="javascript:void(0);">全部商品分类<b></b></a></h2>
            <div class="list" <?php if ($_GET['s'] == 'index' || $_GET['type'] == 'voucher'): ?>style="display:block;"<?php endif; ?> >    
				<div class="i_list">
                    <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                    <ul>
                    	<li class="tit"><b><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=points&s=list&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['catname']; ?>
</a></b></li>
                        <?php if ($this->_tpl_vars['list']['scat']): ?>
                        <li class="i-tit">
                            <?php $_from = $this->_tpl_vars['list']['scat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['slist']):
?>
                            <?php if (( $this->_tpl_vars['key'] < 4 && ( $this->_tpl_vars['num']+1 ) % 3 != 0 ) || ( $this->_tpl_vars['key'] < 2 && ( $this->_tpl_vars['num']+1 ) % 3 == 0 )): ?>
                            	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=points&s=list&id=<?php echo $this->_tpl_vars['slist']['id']; ?>
"><?php echo $this->_tpl_vars['slist']['catname']; ?>
</a>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </div>
        </div>
        
        <ul class="items fl">
            <li <?php if (! $_GET['id']): ?>class="current"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=points">首页</a></li>
            <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                <li <?php if ($_GET['id'] == $this->_tpl_vars['list']['id']): ?>class="current"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=points&s=list&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['catname']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
         </ul>
    </div>
</div>