<?php /* Smarty version 2.6.20, created on 2016-03-01 11:02:27
         compiled from shop_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'shop_index.htm', 32, false),array('modifier', 'getdistrictname', 'shop_index.htm', 45, false),array('modifier', 'number_format', 'shop_index.htm', 98, false),array('modifier', 'truncate', 'shop_index.htm', 117, false),array('function', 'geturl', 'shop_index.htm', 82, false),array('insert', 'label', 'shop_index.htm', 143, false),)), $this); ?>
<link href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/shop/templates/shop.css" rel="stylesheet" type="text/css" />
<div class="w">
    <div class="detailnav">
        <strong><a href="index.php">首页</a></strong>
        <span> > <a href="?m=shop">店铺</a></span>
    </div>
</div>

<div class="w">
	<?php if ($this->_tpl_vars['cat']): ?>
    <div id="select">
        <dl class="first">
            <dt>分类：</dt>
            <dd>
                <?php $this->assign('id', $_GET['id']); ?>
                <?php $_from = $this->_tpl_vars['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <div>
                <a <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['list']['id']): ?>class="curr"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=shop&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"title="<?php echo $this->_tpl_vars['list']['name']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</a>
                </div>
                <?php endforeach; endif; unset($_from); ?>
            </dd>
        </dl>
    </div>     
	<?php endif; ?> 
    <div class="itemSearchList">
        <div class="itemSearchResult">
            <div style="position:relative">
                <div class="filter clearfix">
                    <div class="fore1 clearfix">
                        <div class="order">
                            <?php $this->assign('s', $_GET['orderby']); ?>
                            <a <?php if (! $this->_tpl_vars['s']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
"><span>默认排序</span></a>
                            <a <?php if ($this->_tpl_vars['s'] == 1): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&orderby=".($this->_tpl_vars['s']), "") : smarty_modifier_replace($_tmp, "&orderby=".($this->_tpl_vars['s']), "")); ?>
&orderby=1"><span>好评率</span><b></b></a>
                        </div>
                        <div class="i-search">
                        <form action="<?php echo $this->_tpl_vars['config']['weburl']; ?>
">
                        <input name="m" id="m" type="hidden" value="<?php echo $_GET['m']; ?>
" />
                        <input class="text" type="text" value="<?php echo $_GET['keys']; ?>
" size="20" name="keys" />
                        <input type="submit" value="搜索" />
                        </form>
                        </div>
                    </div>
            	</div>
				<div class="district">
                <div class="area"><span><?php if (((is_array($_tmp=$_GET['province'])) ? $this->_run_mod_handler('getdistrictname', true, $_tmp) : getdistrictname($_tmp))): ?><?php echo ((is_array($_tmp=$_GET['province'])) ? $this->_run_mod_handler('getdistrictname', true, $_tmp) : getdistrictname($_tmp)); ?>
<?php else: ?>所在区<?php endif; ?></span><b></b></div>
                <div style="display:none;" class="i-area">
                    <ul>
                        <?php $_from = $this->_tpl_vars['province']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                        <li key="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>
            </div>
            </div>
            <?php $this->assign('p', $_GET['province']); ?>
			<script>
			$(function(){
				$(".area").click(function(){ 
					var obj=$(this);
					$(this).next().slideToggle("fast",function(){
					if($(obj).next().is(":visible")){
						$(document).one('click',function(){
							$(".area").next().slideUp("fast");
						});
					}});
				});
				$(".i-area li").click(function(){
					var str=$(this).html();
					$(this).parent().parent().prev().children("span").html(str);
					$(this).parent().parent().slideToggle();
					var id=$(this).attr("key");
					window.location='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=shop&id=<?php echo $_GET['id']; ?>
&province='+id;
				});
			});
			</script>
        
			<?php if ($this->_tpl_vars['info']['list']): ?>
                <?php $_from = $this->_tpl_vars['info']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <div class="item clearfix">
                    <div class="left">
                        <div class="pic">
                            <a target="_blank" href="<?php echo smarty_function_geturl(array('uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'com' => $this->_tpl_vars['list']['company']), $this);?>
">
                                <?php if ($this->_tpl_vars['list']['logo']): ?>
                                    <img width="100" height="100" src="<?php echo $this->_tpl_vars['list']['logo']; ?>
">
                                <?php else: ?>
                                    <img src="image/default/nopic.gif" width="100" height="100" />
                                <?php endif; ?>
                            </a>
                        </div>	
                        <div class="info">
                            <dl>
                                <dt><a target="_blank" href="<?php echo smarty_function_geturl(array('uid' => $this->_tpl_vars['list']['userid'],'user' => $this->_tpl_vars['list']['user'],'com' => $this->_tpl_vars['list']['company']), $this);?>
"><?php echo $this->_tpl_vars['list']['company']; ?>
</a></dt>
                                <dd><span class="tit">店主：</span><span><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $this->_tpl_vars['list']['userid']; ?>
"><?php if ($this->_tpl_vars['list']['name']): ?><?php echo $this->_tpl_vars['list']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['list']['user']; ?>
<?php endif; ?></a></span></dd>
                                <dd>
                                <span class="tit">信用度：</span>
                                <span class="tit"><?php if ($this->_tpl_vars['list']['sellerpointsimg']): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/points/<?php echo $this->_tpl_vars['list']['sellerpointsimg']; ?>
"><?php else: ?><?php echo $this->_tpl_vars['list']['sellerpoints']; ?>
<?php endif; ?></span>
                                <span class="tit">&nbsp;&nbsp;好评率：</span>
                                <span><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['favorablerate'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%</span>
                                </dd>
								<dd><span class="tit">主营产品：</span><?php echo $this->_tpl_vars['list']['main_pro']; ?>
</dd>
                                <dd><span class="tit">联系电话：</span><?php echo $this->_tpl_vars['list']['tel']; ?>
</dd>
                                <dd><span class="tit">所在地区：</span><?php echo $this->_tpl_vars['list']['area']; ?>
</dd>
                                <dd><span class="tit">详细地址：</span><?php echo $this->_tpl_vars['list']['addr']; ?>
</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="right">
                        <ul>
                            <?php $_from = $this->_tpl_vars['list']['pro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                            <li>
                                <div class="p-img">            
                                <a target="_blank" title="<?php echo $this->_tpl_vars['slist']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['slist']['id']; ?>
">
                                <img src="<?php echo $this->_tpl_vars['slist']['pic']; ?>
_220X220.jpg" width=100  height=100 alt="<?php echo $this->_tpl_vars['slist']['pname']; ?>
" />
                                </a>
                                </div>
                                <div class="p-name">
                                <a target="_blank" title="<?php echo $this->_tpl_vars['slist']['pname']; ?>
" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&id=<?php echo $this->_tpl_vars['slist']['id']; ?>
"><p><?php echo ((is_array($_tmp=$this->_tpl_vars['slist']['pname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</p>
                                </a>
                                </div>
                                <div class="p-price"><?php echo $this->_tpl_vars['config']['money']; ?>
<?php echo $this->_tpl_vars['slist']['price']; ?>
</div>
                            </li>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </div>
                </div> 
                <?php endforeach; endif; unset($_from); ?>
   				<div class="page"><?php echo $this->_tpl_vars['info']['page']; ?>
</div>
            <?php else: ?>
            <div class="itemsNull">
                <h3>很抱歉，没有找到符合条件的店铺</h3>
                <p>
                    <em>建议您：</em>
                    <span>1、适当减少筛选条件，可以获得更多结果</span>
                    <span>2、尝试其他关键字</span>
                </p>
            </div>
            <?php endif; ?>
        </div>
        <div class="shop">
        	<div class="m">
            	<div class="mt"><h3>热门店铺</h3></div>
            	<div class="mc">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'shop', 'o' => '1', 'temp' => 'shop_list_li', 'limit' => 9)), $this); ?>

                </div>
            </div>
            <div class="ad235"><script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=8'></script></div>
        </div>
    </div>
</div>