<?php /* Smarty version 2.6.20, created on 2016-03-17 19:57:28
         compiled from space_product_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'space_product_detail.htm', 129, false),array('modifier', 'date_format', 'space_product_detail.htm', 180, false),array('modifier', 'replace', 'space_product_detail.htm', 611, false),array('modifier', 'count', 'space_product_detail.htm', 612, false),array('insert', 'label', 'space_product_detail.htm', 221, false),array('function', 'math', 'space_product_detail.htm', 280, false),)), $this); ?>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/dialog/dialog.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.imagezoom.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".add-cart").click(function(){
        if ('<?php echo $this->_tpl_vars['shop_user']; ?>
'=='<?php echo $_COOKIE['USER']; ?>
')
        {
            alert('不能购买自己店铺的商品！');
            return;
        }
        flag=buy();
        if(flag)
        {
        var price=$('#price').html();
        var num=$('#nums').val();
        var sid=$('#sid').val();
        var pid='<?php echo $_GET['id']; ?>
';
        var dist_user_id='<?php echo $_GET['shop_id']; ?>
';
        $('#cart_show').fadeIn(500);
        $('#cart_show').load('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=cart&add_cart=1&price='+price+'&nums='+num+'&id='+pid+'&sid='+sid+'&dist_user_id='+dist_user_id);
        x=$(".buy_box").offset();
        $("#cart_show").offset({top:x.top,left:x.left});
        return false;
        }
    });
    $("#low_num").click(function(){
        var num=$('#nums').val()*1;
        if(num>1)
          $('#nums').val(num-1);
        check_nums()
    });
    $("#add_num").click(function(){
        var num=$('#nums').val()*1;
        if(num<$('#stock').html())
            $('#nums').val(num+1);
        check_nums()
    });
});
function collect_goods(id){
    var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/ajax_update.php';
    var uname='<?php echo $_COOKIE['USER']; ?>
';
    if(uname=='')
    {
        alert('请先登录！');
        window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=shop.php?uid=<?php echo $_GET['uid']; ?>
';
        return false;
    }
    var pars = 'pid='+id+'&uname='+uname;
    $.post(url, pars,showResponse);
    function showResponse(originalRequest)
    {
        if(originalRequest>1)
            alert('成功添加至我的收藏夹!');
        else if (originalRequest>0)
            alert('该内容已经在你的收藏中心，请勿重复添加！');
        else
            alert('参数传递错误，无法完成操作!');
    }
}
function distribute_goods(id){
    var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/distribution/add.php';
    var uname='<?php echo $_COOKIE['USER']; ?>
';
    if(uname=='')
    {
        alert('请先登录！');
        window.location.href='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/login.php?forward=shop.php?uid=<?php echo $_GET['uid']; ?>
';
        return false;
    }
    var pars = 'pid='+id+'&uname='+uname;
    $.post(url, pars,showResponse);
    function showResponse(originalRequest)
    {
        if(originalRequest>1)
            alert('成功添加至我的分销!');
        else if (originalRequest>0)
            alert('该内容已经在你的分销中心，请勿重复添加！');
        else
            alert('参数传递错误，无法完成操作!');
    }
}
function buy()
{
    var flag = false;
    $('ul[genre="property"]').each(function(){
        if(!$(this).find('a').hasClass('checked')){
            flag = true;
        }
    });
    if (goodsspec.getSpec() == null || flag)
    {
        alert('请选择相关规格');
        return !flag;
    }
    else
    {
        return !flag;
    }
}
</script>
<div class="detail">
    <div class="detail-bd clearfix">
        <div class="summary clearfix">
            <div class="item-info clearfix">
                <div class="left">
                    <div class="gallery">
                        <div class="main-pic">
                            <a target="_blank" href="<?php echo $this->_tpl_vars['de']['pic']; ?>
"><img class="jqzoom" height="400" width="400" alt="<?php echo $this->_tpl_vars['de']['pname']; ?>
" src="<?php echo $this->_tpl_vars['de']['pic']; ?>
" rel="<?php echo $this->_tpl_vars['de']['pic']; ?>
" title="<?php echo $this->_tpl_vars['de']['pname']; ?>
"></a>
                        </div>
                        <ul id="jqzoom" class="clearfix">
                            <?php $_from = $this->_tpl_vars['de']['pic_more']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['pic']):
?>
                            <li class="<?php if ($this->_tpl_vars['num'] == 0): ?>hover<?php endif; ?>"><img src="<?php echo $this->_tpl_vars['pic']; ?>
_60X60.jpg" big="<?php echo $this->_tpl_vars['pic']; ?>
" height="60" width="60"></li>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="wrap">
                        <div class="title">
                            <h3><?php echo $this->_tpl_vars['de']['name']; ?>
</h3>
                            <?php if ($this->_tpl_vars['de']['subhead']): ?><p><?php echo $this->_tpl_vars['de']['subhead']; ?>
</p><?php endif; ?>
                        </div>
                        <ul class="promo-meta clearfix">
                            <?php if ($this->_tpl_vars['de']['market_price'] > 0): ?>
                            <li>
                                <span>价格</span>
                                <strong class="del">
                                    <em class="rmb"><?php echo $this->_tpl_vars['config']['money']; ?>
</em>
                                    <em class="rmb-num"><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['market_price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</em>
                                </strong>
                            </li>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['de']['discounts']): ?>
                            <li>
                                <span>会员价</span>
                                <strong class="promo-price">
                                    <em class="rmb"><?php echo $this->_tpl_vars['config']['money']; ?>
</em>
                                    <em id="price" class="rmb-num"><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</em>
                                </strong>(<?php echo $this->_tpl_vars['de']['discounts']; ?>
折)
                            </li>
                            <?php else: ?>
                            <li>
                                <span><?php if ($this->_tpl_vars['de']['market_price'] > 0): ?>促销<?php else: ?>价格<?php endif; ?></span>
                                <?php if ($this->_tpl_vars['de']['is_tg'] == 'true'): ?>
                                <b class="promo-type">团购</b>
                                <?php endif; ?>
                                <strong class="promo-price">
                                    <em class="rmb"><?php echo $this->_tpl_vars['config']['money']; ?>
</em>
                                    <em id="price" class="rmb-num"><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</em>
                                </strong>
                            </li>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['de']['is_virtual'] != 1): ?>
                            <li>
                                <span>配送</span>
                                <p>
                                    <?php echo $this->_tpl_vars['de']['district']['0']; ?>
<?php echo $this->_tpl_vars['de']['district']['1']; ?>
 至
                                    <a class="region" href="javascript:void(0);"><?php echo $this->_tpl_vars['de']['user_ip']; ?>
</a>
                                    <?php if ($this->_tpl_vars['de']['freight_type'] == 0): ?>卖家承担运费
                                    <?php else: ?>
                                </p>
								<p style="margin-left:60px;">
                               <!--  <?php if (! $this->_tpl_vars['de']['freight_id']): ?>
                                快递:&nbsp; <?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo $this->_tpl_vars['de']['express_price']; ?>

                                平邮:&nbsp; <?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo $this->_tpl_vars['de']['post_price']; ?>

                                EMS:&nbsp; <?php echo $this->_tpl_vars['config']['money']; ?>
 <?php echo $this->_tpl_vars['de']['ems_price']; ?>

                                <?php else: ?>
                                <?php echo $this->_tpl_vars['de']['freight_count']; ?>

                                <?php endif; ?> -->
                                <?php endif; ?>
								</p>
                            </li>
                            <?php else: ?>
                            <li>
                                <span>促销信息</span>
                                <p><?php echo $this->_tpl_vars['de']['promotion_msg']; ?>
</p>
                            </li>
                            <li>
                                <span>有 效 期</span>
                                <p><?php echo ((is_array($_tmp=$this->_tpl_vars['de']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 至 <?php echo ((is_array($_tmp=$this->_tpl_vars['de']['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p>
                            </li>
                            <?php endif; ?>
                            <li class="counter">
                                <div class="sell-counter clearfix">
                                    <a href="javascript:;">
                                        <b><?php echo $this->_tpl_vars['de']['sales']; ?>
</b><span>交易成功</span>
                                    </a>
                                </div>
                                <div class="rate-counter clearfix">
                                    <a href="javascript:;">
                                        <b><?php echo $this->_tpl_vars['de']['count']; ?>
</b><span>累计评论</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
						<?php if ($this->_tpl_vars['de']['activity_list']): ?>
							<ul class="promo-meta clearfix">
								<li><span>活动</span></li>
								<li>
									<strong style="font-size:16px;"><?php echo $this->_tpl_vars['de']['activity_list']['title']; ?>
</strong>
									<p>活动时间：<?php echo ((is_array($_tmp=$this->_tpl_vars['de']['activity_list']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 至 <?php echo ((is_array($_tmp=$this->_tpl_vars['de']['activity_list']['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p>
								</li>
							</ul>
						<?php endif; ?>
						
                        <?php if ($this->_tpl_vars['de']['down'] == 1 || $this->_tpl_vars['shop_user'] == $_COOKIE['USER']): ?>
                        <div class="shelves">
                        <?php if ($this->_tpl_vars['shop_user'] == $_COOKIE['USER']): ?>
                            <p>1. 你可以对 <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?edit=<?php echo $this->_tpl_vars['de']['id']; ?>
&m=product&s=admin_product">商品编辑</a></p>
                            <p>2. 你可以 <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['de']['member_id']; ?>
">进入店铺</a></p>
                        	<?php else: ?>
                            <h5>此商品已下架</h5>
                            <div class="sep-line clearfix"></div>
                            <p>1. 联系卖家咨询</p>
                            <p>2. 你可以 <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php?uid=<?php echo $this->_tpl_vars['de']['member_id']; ?>
">进入店铺</a></p>
                           <?php endif; ?>

                            <div class="m">
                                <div class="mt">本店相似的宝贝有</div>
                                <div class="mc clearfix">
                                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'product', 'uid' => $this->_tpl_vars['de']['member_id'], 'temp' => 'product_list_li', 'limit' => 3)), $this); ?>

                                </div>
                            </div>
                        </div>
                        <?php else: ?>
							<div class="buy_box clearfix">
								<form id="form" onsubmit="return buy()" action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=<?php if ($this->_tpl_vars['de']['is_virtual']): ?>confirm_virtual_order<?php else: ?>confirm_order<?php endif; ?><?php if ($_GET['shop_id']): ?>&dist_user_id=<?php echo $_GET['shop_id']; ?>
<?php endif; ?>" method="post">
									<input name="dist_user_id" type="hidden" value="<?php echo $_GET['shop_id']; ?>
" />
									<input name="id" type="hidden" value="<?php echo $this->_tpl_vars['de']['id']; ?>
" />
									<input name="sid" id="sid" type="hidden" value="0" />
									<?php if ($this->_tpl_vars['de']['is_virtual']): ?>
									<input name="is_virtual" type="hidden" value="1" />
									<?php if ($this->_tpl_vars['de']['discounts']): ?>
									<input name="discounts" type="hidden" value="<?php echo $this->_tpl_vars['de']['discounts']; ?>
" />
									<?php endif; ?>
									<?php endif; ?>
									<div class="select_style clearfix">
										<?php if ($this->_tpl_vars['de']['porperty']): ?>
										<?php $_from = $this->_tpl_vars['de']['extfiled']['d']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
										<?php echo $this->_tpl_vars['list']; ?>

										<?php endforeach; endif; unset($_from); ?>
										<?php endif; ?>
										<?php if ($this->_tpl_vars['de']['rest'] == 0): ?>
										<dl>
											<dt>数量</dt>
											<dd class="stock">
												<a href="javascript:void(0);" id="low_num">-</a>
												<input onkeyup="check_nums();" size="3" name="nums" id="nums" type="text" value="1" />
												<a href="javascript:void(0);" id="add_num">+</a>
												<em>件 （库存 <span id="stock"><?php echo $this->_tpl_vars['de']['stock']; ?>
</span> 件<?php if ($this->_tpl_vars['de']['is_virtual'] == 1 && $this->_tpl_vars['de']['maxbuy'] < $this->_tpl_vars['de']['stock'] && $this->_tpl_vars['de']['maxbuy'] > 0): ?>，每人限购<strong style='color:#f40'><?php echo $this->_tpl_vars['de']['maxbuy']; ?>
件<?php endif; ?></strong>） </em>
											</dd>
										</dl>
										<?php endif; ?>
									</div>
									<?php if ($this->_tpl_vars['de']['rest'] > 0): ?>
									<div class="rest">
										<span class="btn">即将开始</span> 距离开售 还剩 <span id="endtime"><?php echo $this->_tpl_vars['de']['rest']; ?>
</span>，请先<a href="javascript:collect_goods('<?php echo $this->_tpl_vars['de']['id']; ?>
');">收藏商品</a>
									</div>
									<?php else: ?>
									<div class="choose_result"></div>
									<div class="clear"></div>
									<div class="choose_btn">
										<a href="javascript:void(0);" class="btn-buy"></a>
										<?php if ($this->_tpl_vars['de']['is_virtual'] != 1): ?>
										<a href="javascript:void(0);" class="add-cart"></a>
										<?php endif; ?>
									</div>
									<?php endif; ?>
								</form>
							</div>
                        <?php endif; ?>
                        <div class="sep-line clearfix"></div>
                        <ul class="social clearfix">
                            <li class="like"><a href="javascript:void(0);"><i></i>喜欢商品</a></li>
                            <li class="fav"><a href="javascript:collect_goods('<?php echo $this->_tpl_vars['de']['id']; ?>
');"><i></i>收藏商品</a></li>
                            <?php if ($this->_tpl_vars['dist_user_row']['distribution_user_state'] == -3 && $this->_tpl_vars['is_distribution_product'] == true): ?><li class="fav"><a href="javascript:distribute_goods('<?php echo $this->_tpl_vars['de']['id']; ?>
');"><i></i>立即分销赚佣金</a></li><?php endif; ?>
                            <li class="share"><a href="javascript:void(0);"><i></i>分享</a></li>
                            <li class="ercode iconfont"><a href="javascript:void(0);" style="padding-left: 0"><span style="color:orange">&#xe626</span> 二维码</a></li>
                        </ul>
                        <div class="qrcode" style="float: right; padding-right: 70px;display: none"><img src="api/share_qrcode.php?type=product&pid=<?php echo $_GET['id']; ?>
&rand=<?php echo smarty_function_math(array('equation' => "rand(1,10000)"), $this);?>
"></div>
                        <div class="bshare-custom icon-medium hidden">
                            <div class="bsPromo bsPromo2"></div>
                            <a title="分享到微信" class="bshare-weixin" href="javascript:void(0);"></a>
                            <a title="分享到QQ空间" class="bshare-qzone"></a>
                            <a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
                            <a title="分享到人人网" class="bshare-renren"></a>
                            <a title="分享到腾讯微博" class="bshare-qqmb"></a>
                            <a title="分享到网易微博" class="bshare-neteasemb"></a>
                            <a title="分享到凤凰微博" class="bshare-ifengmb" href="javascript:void(0);"></a>
                            <a title="分享到搜狐微博" class="bshare-sohuminiblog" href="javascript:void(0);"></a>
                            <a title="分享到豆瓣" class="bshare-douban" href="javascript:void(0);"></a>
                            <a title="分享到开心网" class="bshare-kaixin001" href="javascript:void(0);"></a>
                            <a title="分享到天涯" class="bshare-tianya" href="javascript:void(0);"></a>
                            <a title="分享到百度空间" class="bshare-baiduhi" href="javascript:void(0);"></a>
                            <a title="分享到朋友网" class="bshare-qqxiaoyou" href="javascript:void(0);"></a>
                            <a title="分享到淘江湖" class="bshare-taojianghu" href="javascript:void(0);"></a>
                            <a title="分享到飞信" class="bshare-feixin" href="javascript:void(0);"></a>
                            <a title="分享到Facebook" class="bshare-facebook" href="javascript:void(0);"></a>
                            <a title="分享到电子邮件" class="bshare-email" href="javascript:void(0);"></a>
                        </div>
                        <div class="clear"></div>
                        <div id="cart_show"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar clearfix">
            <div class="shop-info">
                <a class="shop-info-bg" href=""><img width="198" height="45" src="image/points/<?php echo $this->_tpl_vars['com']['sellerpointsid']; ?>
.png" /></a>
                <div class="shop-info-wrap clearfix">
                    <div class="shop-info-hd">
                        <dl>
                            <dt>店铺：</dt>
                            <dd><?php echo $this->_tpl_vars['com']['company']; ?>
 <?php if ($this->_tpl_vars['chat_open_flag']): ?>&nbsp; <a href="javascript:void(0);" onclick="return chat(<?php echo $this->_tpl_vars['com']['shop_id']; ?>
);"><span class="iconfont" style="color: #FF6600;font-size: 16px;">&#xe635;</span></a><?php endif; ?></dd>
                        </dl>
                        <dl>
                            <dt>信誉：</dt>
                            <dd><img align="absmiddle" src="image/points/<?php echo $this->_tpl_vars['com']['sellerpointsimg']; ?>
" /></dd>
                        </dl>
                        <dl>
                            <dt>掌柜：</dt>
                            <dd><a target="_blank" href="home.php?uid=<?php echo $this->_tpl_vars['de']['member_id']; ?>
"><?php echo $this->_tpl_vars['com']['name']; ?>
</a></dd>
                        </dl>
                        <dl class="shop-icon">
                            <dt>资质：</dt>
                            <dd>
                                <?php if ($this->_tpl_vars['com']['shop_auth']): ?><a title="个人认证" class="personal" href="javascript:void(0);"></a><?php endif; ?>
                                <?php if ($this->_tpl_vars['com']['shopkeeper_auth']): ?><a class="shop" title="店铺认证" href="javascript:void(0);"></a><?php endif; ?>
                                <span title="已缴纳<?php echo $this->_tpl_vars['com']['earnest']; ?>
元保证金"><?php if ($this->_tpl_vars['com']['earnest'] > 999): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['com']['earnest'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
<?php else: ?><?php echo $this->_tpl_vars['com']['earnest']; ?>
<?php endif; ?> 元</span>
                            </dd>
                        </dl>
                    </div>
                    <div class="shop-info-bd clearfix">
                        <div class="shop-rate clearfix">
                            <dl>
                                <dt>描述&nbsp;&nbsp;</dt>
                                <dd><b><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['a'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</b></dd>
                            </dl>
                            <dl>
                                <dt>物流&nbsp;&nbsp;</dt>
                                <dd><b><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['c'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</b></dd>
                            </dl>
                            <dl>
                                <dt>服务&nbsp;&nbsp;</dt>
                                <dd><b><?php echo ((is_array($_tmp=$this->_tpl_vars['score']['b'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 1) : number_format($_tmp, 1)); ?>
</b></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="shop-info-fd clearfix">
                        <a target="_blank" href="shop.php?uid=<?php echo $_GET['uid']; ?>
">进入店铺</a>
                        <a class="fr" href="javascript:void(0);" onclick="javascript:getfavshop();">收藏店铺</a>
                    </div>
                </div>
            </div>
            <div class="pine">
                <div class="pine-hd clearfix">看了又看</div>
                <div class="pine-bd clearfix">
                    <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'product', 'uid' => $this->_tpl_vars['de']['member_id'], 'o' => '1', 'noid' => $this->_tpl_vars['de']['id'], 'temp' => 'product_list_li', 'limit' => 4)), $this); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="tabbar-wrap clearfix">
    <div class="shop-search">
        <div class="search-panel">
            <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/shop.php" method="get">
                <div class="search-btn">
                    <input type="submit" value="">
                </div>
                <div class="search-fields">
                    <input type="text" value="<?php echo $_GET['keyword']; ?>
" name="keyword">
                </div>
                <input id="search" type="hidden" name="search" value="search" />
                <input id="uid" name="uid" type="hidden" value="<?php echo $_GET['uid']; ?>
" />
                <input id="action" name="action" type="hidden" value="product_list" />
                <input id="m" name="m" type="hidden" value="product" />
            </form>
        </div>
    </div>
    <div class="inner-wrap">
        <ul class="clearfix">
            <li class="cur"><a href="javascript:void(0);">商品详情</a></li>
            <li><a href="javascript:void(0);">累计评论</a></li>
            <li><a href="javascript:void(0);">成交记录</a></li>
            <li><a href="javascript:void(0);">商品问答</a></li>
        </ul>
    </div>
</div>
<div class="layout clearfix">
    <div class="left">
        <div class="m">
            <div class="mt"><h3>热销产品</h3></div>
            <div class="mc">
                <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'product', 'uid' => $this->_tpl_vars['de']['member_id'], 'o' => '1', 'temp' => 'product_list_li', 'limit' => 5)), $this); ?>

            </div>
        </div>
    </div>
    <div class="con clearfix">
        <div class="i-con">
            <?php if ($this->_tpl_vars['de']['brand'] || $this->_tpl_vars['de']['extfiled']['s']): ?>
            <div class="attributes clearfix">
                <ul class="clearfix">
                    <li>品牌：<?php echo $this->_tpl_vars['de']['brand']; ?>
</li>
                    <?php $_from = $this->_tpl_vars['de']['extfiled']['s']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?><?php echo $this->_tpl_vars['list']; ?>
<?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="description"><?php echo $this->_tpl_vars['de']['detail']; ?>
</div>
        </div>
        <div id="reviews" class="i-con hidden"></div>
        <div id="deal-record" class="i-con hidden"></div>
        <div id="consult" class="i-con hidden"></div>
    </div>
    <div class="right"><ul></ul></div>
</div>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
<script type="text/javascript">
$(".sell-counter").click(function(){
    $("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
    $(".inner-wrap li").eq(2).addClass("cur").siblings().removeClass("cur");
    $(".con .i-con").eq(2).show().siblings(".i-con").hide();
});
$(".rate-counter").click(function(){
    $("body,html").animate({scrollTop:$(".inner-wrap").offset().top});
    $(".inner-wrap li").eq(1).addClass("cur").siblings().removeClass("cur");
    $(".con .i-con").eq(1).show().siblings(".i-con").hide();
});
$('#jqzoom li').hover(function(){
    $(this).addClass("hover").siblings().removeClass("hover");;
});
$(".jqzoom").imagezoom();
$("#jqzoom li").mouseover(function(){
    $(".jqzoom").attr('src',$(this).find("img").attr("big"));
    $(".jqzoom").attr('rel',$(this).find("img").attr("big"));
});
$('.ercode a').click(function(){
    if($('.qrcode').css('display')=='block')
        $('.qrcode').hide();
    else
        $('.qrcode').show();
});
$('.like a').click(function(){
    alert("你已经喜欢过了。");
});
$('.share a').click(function(){
    if($('.bshare-custom').css('display')=='block')
        $('.bshare-custom').hide();
    else
        $('.bshare-custom').show();
});
<?php if ($this->_tpl_vars['de']['rest'] > 0): ?>
    var CID = "endtime";
    if(window.CID != null)
    {
        var iTime = document.getElementById(CID).innerHTML;
        var Account;
        RemainTime();
    }
    function RemainTime()
    {
        var iDay,iHour,iMinute,iSecond;
        var sDay="",sHour="",sMinute="",sSecond="",sTime="";
        if (iTime >= 0)
        {
            iDay = parseInt(iTime/24/3600);
            if (iDay > 0)
                sDay = "<em>" + iDay + "</em>天";
            iHour = parseInt((iTime/3600)%24);
            if (iHour > 0)
                sHour = "<em>" + iHour + "</em>小时";
            iMinute = parseInt((iTime/60)%60);
            if (iMinute > 0)
                sMinute = "<em>" + iMinute + "</em>分钟";
            iSecond = parseInt(iTime%60);
            if (iSecond >= 0)
                sSecond = "<em>" + iSecond + "</em>秒";

            sTime=sDay+sHour+sMinute+ sSecond;
            if(iTime==0)
            {
                clearTimeout(Account);
                location.reload();
            }
            else
                Account = setTimeout("RemainTime()",1000);
            iTime=iTime-1;
        }
        if($("#"+CID)) $("#"+CID).html(sTime);
    }
<?php endif; ?>
<?php if ($this->_tpl_vars['de']['down'] != 1): ?>
        $(".btn-buy").click(function(){
            $("#form").submit();
        });
        function check_nums()
        {
            var v=document.getElementById('nums').value*1;
            var stock = $('#stock').html()*1;
            var maxbuy = "<?php echo $this->_tpl_vars['de']['maxbuy']; ?>
"

            if(maxbuy > 0 && maxbuy<stock)
            {
                stock = maxbuy;
            }
            if(!v)
                document.getElementById('nums').value=1;
            if(v>stock)
            {
                document.getElementById('nums').value=stock;
                return false;
            }
        }
        function spec(id, spec, price, stock)
        {
            this.id    = id;
            this.spec  = spec;
            this.price = price;
            this.stock = stock;
        }
        function goodsspec(specs, specQty, defSpec)
        {
            this.specs = specs;
            this.specQty = specQty;
            this.defSpec = defSpec;
            this.spec1 = null;
            this.spec2 = null;
            if (this.specQty >= 1)
            {
                for(var i = 0; i < this.specs.length; i++)
                {
                    if (this.specs[i].id == this.defSpec)
                    {
                    <?php $_from = $this->_tpl_vars['de']['extfiled']['d']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                        this.spec<?php echo $this->_tpl_vars['num']+1; ?>
 = this.specs[i].spec[<?php echo $this->_tpl_vars['num']; ?>
];
                    <?php endforeach; endif; unset($_from); ?>
                        break;
                    }
                }
            }
            this.getSpec = function()
            {
                for (var i = 0; i < this.specs.length; i++)
                {
                    <?php $_from = $this->_tpl_vars['de']['extfiled']['d']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                        if (this.specs[i].spec[<?php echo $this->_tpl_vars['num']; ?>
] != this.spec<?php echo $this->_tpl_vars['num']+1; ?>
) continue;
                    <?php endforeach; endif; unset($_from); ?>
                    return this.specs[i];
                }
                return null;
            }
        }
        function selectSpec(num,obj, SID)
        {
            goodsspec['spec' + num] = SID;
            var id = $(obj).parent().parent().parent().parent().attr('id');
            if(id=='color')
            {
                var data_str = $(obj).attr('data-param');
                if(data_str)
                {
                    eval("data_str = "+data_str);
                    $('.jqzoom').attr("src",data_str.src);
                    $('.jqzoom').attr("rel",data_str.src);
                }
                else{
                    var src="<?php echo $this->_tpl_vars['de']['pic']; ?>
";
                    $('.jqzoom').attr("src",src);
                    $('.jqzoom').attr("rel",src);
                }
            }

            $(obj).addClass("checked");
            $(obj).parents('li').siblings().find('a').removeClass("checked");

            var spec = goodsspec.getSpec();
            var sign = 't';
            $('ul[genre="property"]').each(function(){
                if(!$(this).find('a').hasClass('checked')){
                    sign = 'f';
                }
            });
            if (spec != null && sign == 't')
            {
                $('#stock').html(spec.stock);
                $('#price').html(spec.price.toFixed(2));
                $('#sid').val(spec.id);

                if(parseInt(spec.stock) == 0)
                {
                    $('.choose_result').show().html('<div class="dd"><em>库存量不足，请选择其它。</em></div>');
                    $('#addcart_submit').attr('disabled',true).css('cursor','pointer');
                }
                else
                {
                    SP_V = '';
                    $('ul[genre="property"]').find('li > .checked').each(function(i){
                        SP_V += '<strong>"'+$(this).text()+'"</strong>，';
                    });
                    SP_V = SP_V.substr(0,SP_V.length-1);
                    $('.choose_result').show().html('<em>您选择了：</em>'+SP_V+'');
                    $('#addcart_submit').attr('disabled',false).css('cursor','auto');
                    $('#nums').val("1");
                }
            }

        }
        var specs = new Array();
        <?php $_from = $this->_tpl_vars['de']['porperty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
            specs.push(new spec(<?php echo $this->_tpl_vars['list']['id']; ?>
, ['<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['property_value_id'])) ? $this->_run_mod_handler('replace', true, $_tmp, ",", "','") : smarty_modifier_replace($_tmp, ",", "','")); ?>
'], <?php echo $this->_tpl_vars['list']['price']; ?>
, <?php echo $this->_tpl_vars['list']['stock']; ?>
));
            var specQty = <?php echo count($this->_tpl_vars['de']['extfiled']['d']); ?>
;
            var defSpec = <?php echo $this->_tpl_vars['de']['porperty']['0']['id']; ?>
;
        <?php endforeach; else: ?>
            specs.push(new spec('', '', '', '', ''));
            var specQty = 0;
            var defSpec = 0;
        <?php endif; unset($_from); ?>
        var goodsspec = new goodsspec(specs, specQty, defSpec);
<?php endif; ?>
$(".inner-wrap li").click(function(){
    var b=$(".inner-wrap li").index($(this));
    $(this).addClass("cur").siblings().removeClass("cur");
    $(".con .i-con").eq(b).show().siblings(".i-con").hide();
});
$('#reviews').load('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['de']['id']; ?>
&ajax=reviews');
$('#deal-record').load('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['de']['id']; ?>
&ajax=deal-record');
$('#consult').load('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['de']['id']; ?>
&ajax=consult');
</script>