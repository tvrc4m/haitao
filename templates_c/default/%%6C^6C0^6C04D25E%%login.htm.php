<?php /* Smarty version 2.6.20, created on 2016-03-19 19:31:06
         compiled from login.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'login.htm', 67, false),array('modifier', 'cat', 'login.htm', 86, false),array('modifier', 'urlencode', 'login.htm', 86, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录<?php echo $this->_tpl_vars['config']['company']; ?>
</title>
<meta name="description" content="<?php echo $this->_tpl_vars['config']['description']; ?>
" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['config']['keyword']; ?>
" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/templates/default/page.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/base.js" type="text/javascript"></script>
<script src="script/login.js" type=text/javascript></script>
<script type=text/javascript>
var nousername='<?php echo $this->_tpl_vars['lang']['nouname']; ?>
';
var nouserpass='<?php echo $this->_tpl_vars['lang']['noupass']; ?>
';
var norandcode='<?php echo $this->_tpl_vars['lang']['nocode']; ?>
';
</script>
</head>
<body class="login">

<div id="header">
	<div class="w header">
    	<div class="logo ld">
        <a hidefocus="true" title="<?php echo $this->_tpl_vars['config']['company']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
"><img src="image/default/Logo.png" /></a>
        <b></b>
        </div>
        <div class="welcome">欢迎登录</div>
	</div>
</div>

<div class="wl">
    <div class="mc">
       
        <div class="form">
            <ul class="tabs-nav clearfix">
                <li class="text-left">蚂蚁会员</li>
                <li class="text-right"><img src="image/default/icon1.png"><a href="<?php echo $this->_tpl_vars['config']['regname']; ?>
" class="register">立即注册</a></li>
            </ul>
            <form id="login" name="login" action="login.php" method="post">
                <dl>
                    <dt><img src="image/default/icon2.png"></dt>
                   <!--  <dt>账&nbsp;&nbsp;&nbsp;号：</dt> -->
                    <dd>
                        <input type="text" class="text" autocomplete="off" name="user" tabindex="1" placeholder="可使用已注册的用户名或手机号登录" id="user">
                    </dd>
                </dl>
                <?php if ($_GET['erry'] == "-1"): ?><font color="red" class="clearfix"><?php echo $this->_tpl_vars['lang']['noname']; ?>
</font>
                <?php elseif ($_GET['erry'] == "-5"): ?><font color="red" class="clearfix">用户被禁止访问</font>
                <?php elseif ($_GET['erry'] == "-4"): ?><font color="red" class="clearfix"><?php echo $this->_tpl_vars['lang']['have_restpass']; ?>
</font><?php endif; ?>
                <dl>
                    <dt><img src="image/default/icon3.png"></dt>
                    <!-- <dt>密&nbsp;&nbsp;&nbsp;码：</dt> -->
                    <dd>
                        <input class="text" type="password" name="password" id="password" tabindex="2" autocomplete="off" placeholder="6-20个大小写英文字母、符号或数字"/>
                    </dd>
                </dl>
                <?php if ($_GET['erry'] == "-2"): ?>
                <font color="red" class="clearfix"><?php echo $this->_tpl_vars['lang']['passerr']; ?>
</font>
                <?php endif; ?>
                <!-- <div class="code-div mt15">
                <dl>
                    <dt>验证码：</dt>
                    <dd>
                        <input type="text" maxlength="4" class="text w100" name="randcode" id="randcode" autocomplete="off" tabindex="3" placeholder="输入验证码"/>
                    </dd>
                </dl>
                <span><img onclick="get_randfunc(this);" src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/includes/rand_func.php?rand_num=<?php echo smarty_function_math(array('equation' => "rand(1,9999)"), $this);?>
'/></span>
                    <?php if ($_GET['erry'] == "-3"): ?>
                    <font color="red" class="clearfix"><?php echo $this->_tpl_vars['lang']['codeerr']; ?>
</font>
                    <?php endif; ?>
                </div> -->
                <div class="item fore4">
                    <div class="item-ifo mt15">
                        <a href="lostpass.php" class="">忘记密码?</a>
                    </div>
                </div>
                <div class="item login-btn">
                    <input name="action" type="hidden" value="submit" />
                    <input name="forward" type="hidden" id="forward" value="<?php echo $_GET['forward']; ?>
" />
                    <input type="submit" tabindex="4" value="登录" onclick="return do_login();">
                </div>

                <div class="item extra">
                    <h4>使用合作网站账号登录：</h4>
                    <?php if ($this->_tpl_vars['config']['qq_connect'] == 1): ?>
                    <a target="_blank" class="qq" href="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=<?php echo $this->_tpl_vars['config']['qq_app_id']; ?>
&redirect_uri=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['config']['weburl'])) ? $this->_run_mod_handler('cat', true, $_tmp, '/login.php') : smarty_modifier_cat($_tmp, '/login.php')))) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&state=<?php echo $this->_tpl_vars['config']['company']; ?>
&client_secret=<?php echo $this->_tpl_vars['config']['qq_key']; ?>
"><i></i>QQ</a>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['config']['sina_connect'] == 1): ?>
                    <a class="sina" href="<?php echo $this->_tpl_vars['sina_login_url']; ?>
"><i></i>新浪微博</a>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['config']['weixin_connect'] == 1): ?>
                    <a class="weixin" href="<?php echo $this->_tpl_vars['wechat_url']; ?>
"><i></i>微信</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="footer w">
        <ul class="icon clearfix">
            <li class="clearfix">
                <div class="footer_img"><img src="image/default/login1.png"/></div>
                <div class="footer_text">
                    <p class="font18">品质保证</p>
                    <p class="font14">蚂蚁在线 平台信誉</p>
                </div>
            </li>
            <li class="clearfix">
                <div class="footer_img"><img src="image/default/login2.png"/></div>
                <div class="footer_text">
                    <p class="font18">海外直供</p>
                    <p class="font14">全球资源 购物无境</p>
                </div>
            </li>
            <li class="clearfix">
                <div class="footer_img"><img src="image/default/login3.png"/></div>
                <div class="footer_text">
                    <p class="font18">优质品牌</p>
                    <p class="font14">名品荟萃 质优大牌</p>
                </div>
            </li>
            <li class="clearfix">
                <div class="footer_img"><img src="image/default/login4.png"/></div>
                <div class="footer_text">
                    <p class="font18">售后保障</p>
                    <p class="font14">专业客服 售后无忧</p>
                </div>
            </li>
        </ul>
        <ul class="text">
            <li>关于我们</li>
            <li>联系我们</li>
            <li>人才招聘</li>
            <li>商家入驻</li>
            <li>广告服务</li>
            <li>手机蚂蚁</li>
            <li>友情链接</li>
            <li>销售联盟</li>
            <li>蚂蚁社区</li>
            <li>蚂蚁公益</li>
            <li>English Site</li>
        </ul>
        <p class="copytight">Copyright@2014-2016 mayizaixian.cn版权所有</p>
</div>
<!-- <div class="footer clearfix">
    <div class="w">
        <div class="links"><?php echo $this->_tpl_vars['web_con']; ?>
</div>
        <div class="copyright"><?php echo $this->_tpl_vars['bt']; ?>
</div>
    </div>
</div> -->
</body>
</html>