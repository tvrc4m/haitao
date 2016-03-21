<?php /* Smarty version 2.6.20, created on 2016-03-19 18:41:17
         compiled from header.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'header.htm', 48, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "site_nav.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!--header start-->
    <div class="newheader">
        <!--top start-->
        <div class="top">
            <div class="w newclear">
                <span class="fl"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" title="蚂蚁海淘">蚂蚁海淘首页</a><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php" title="登陆">登陆</a><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/register.php"">注册</a></span>
                <span class="fr"><a href="" title="">蚂蚁海淘App</a><a href="" title="">我的订单</a><a href="" title="">个人中心</a><a href="aboutus.php?type=8" title="">联系客服</a><a href="" title="">蚂蚁在线</a></span>
            </div>
        </div>
        <!--top end-->
        <!--顶部广告位 start-->
        <div class="m_top_ban"></div>
        <!--顶部广告位 end-->
        <!--head start-->
        <div class="w head newclear">
            <a href="" class="icon_logo ml10 mid"></a>
            <ul class="m_commitment ml60 newclear mid">
                <li><i class="icon_commitment_01"></i><em class="mid">品质<br>保证</em></li>
                <li><i class="icon_commitment_02"></i><em class="mid">全球<br>直供</em></li>
                <li><i class="icon_commitment_03"></i><em class="mid">无忧<br>售后</em></li>
            </ul>
            <div class="m_t_search ml40 mid">
                <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
" method="get" accept-charset="utf-8">
                    <input type="hidden" value="product" name="m" id="m">
                    <input type="hidden" value="list" name="s" id="s">
                    <input type="text" id="key" name="key" autocomplete="off" placeholder="搜索您需要的商品" onkeyup="get_search_word(this.value);" value="<?php echo $_GET['key']; ?>
"><input type="submit" name="s_submit" value="搜索">
                </form>
            </div>
            <div class="m_shop_cart mid pos_re">
                <div class="cart_box"><span class="mid">我的购物车</span><i class="icon_cart"></i></div>
                <div class="cart_list">
                    
                </div>
            </div>
        </div>
        <!--head end-->
        <!--导航 start-->
        <div class="m_nav">
            <div class="w pos_re">
                <!--menu start-->
                <dl class="m_menu">
                    <dt><i class="icon_menu"></i><span class="mid">全部商品分类</span></dt>
                    <dd class="newclear">
                        <div class="m_goods_list">
                            <ul <?php if ($_GET['m'] == 'product' && $_GET['s'] == 'index'): ?><?php endif; ?>>
                                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'cat', 'temp' => 'pro_cat_shop_left')), $this); ?>

                               <!--  <li>
                                    <label><i class="icon_menu_01"></i><b class="mid">母婴专区</b></label>
                                    <p><a href="" title="">奶粉</a><a href="" title="">纸尿裤</a><a href="" title="">孕产必备</a></p>
                                </li>
                                <li>
                                    <label><i class="icon_menu_02"></i><b class="mid">美妆个护</b></label>
                                    <p><a href="" title="">奶粉</a><a href="" title="">纸尿裤</a><a href="" title="">孕产必备</a></p>
                                </li>
                                <li>
                                    <label><i class="icon_menu_03"></i><b class="mid">健康生活</b></label>
                                    <p><a href="" title="">奶粉</a><a href="" title="">纸尿裤</a><a href="" title="">孕产必备</a></p>
                                </li>
                                <li>
                                    <label><i class="icon_menu_04"></i><b class="mid">潮流生活</b></label>
                                    <p><a href="" title="">奶粉</a><a href="" title="">纸尿裤</a><a href="" title="">孕产必备</a></p>
                                </li> -->
                            </ul>
                        </div>
                    </dd>
                </dl>
                <!--menu end-->
                <!--nav start-->
                <ul class="nav ml20 newclear">
                    <li><a href="" title="">首页</a></li>
                    <li><a href="" title="">海外直邮</a></li>
                    <li><a href="" title="">母婴专区</a></li>
                    <li><a href="" title="">美妆个护</a></li>
                    <li><a href="" title="">健康生活</a></li>
                    <li><a href="" title="">潮流生活</a></li>
                </ul>
                <!--nav end-->
                <div class="m_gz"><i class="icon_wx_gray"></i><span class="mid">关注蚂蚁在线</span></div>
            </div>
        </div>
        <!--导航 end-->
    </div>
    <!--header end-->
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