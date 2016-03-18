<?php /* Smarty version 2.6.20, created on 2016-03-16 14:32:16
         compiled from admin_buyorder.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'admin_buyorder.htm', 186, false),array('modifier', 'date_format', 'admin_buyorder.htm', 195, false),array('modifier', 'truncate', 'admin_buyorder.htm', 198, false),array('modifier', 'number_format', 'admin_buyorder.htm', 219, false),)), $this); ?>
<div class="path">
    <div>
    	<a href="main.php?cg_u_type=1">我的商城</a> <span>&gt;</span>已买到的商品 
    </div>
</div>

<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
                <li class="<?php if (! $_GET['status'] && $_GET['rate'] != '1'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=product&s=admin_buyorder">所有订单</a></li>
                <li class="<?php if ($_GET['status'] == '1'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=product&s=admin_buyorder&status=1">待付款</a></li>
                <li class="<?php if ($_GET['status'] == '3'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=product&s=admin_buyorder&status=3">待收货</a></li>
                <li class="<?php if ($_GET['rate'] == '1'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=product&s=admin_buyorder&rate=1">待评论</a></li>
			</ul>
        </div>
        
        <div class="searchbar">
        <form action="main.php" method="get">
        <input type="hidden" name="m" value="product" />
        <input type="hidden" name="s" value="admin_buyorder" />
        	<div>
            	<input type="text" class="w300" name="key" value="<?php echo $_GET['key']; ?>
" />
            	<span class="search-btn"><input type="submit" value="订单搜索" /></span>
            	<div class="search-opt">
                <a class="show-whole" style="display:none;" href="#">更多筛选条件<i><em></em><span></span></i></a>
                <a class="show-simple" href="#">精简筛选条件<i><em></em><span></span></i></a>
                </div>
            </div>
        	<table width="100%" class="whole ">
            	<tr>
                	<td width="33%">
                    	<label>订单类型：</label>
                        <div class="select_box">
                        	<input type="hidden" value="<?php echo $_GET['type']; ?>
" name="type">
							<div class="search-select">
                                <span><?php if ($_GET['type'] == ''): ?>全部订单<?php elseif ($_GET['type'] == 1): ?>团购订单<?php else: ?>虚拟订单<?php endif; ?></span><b></b>
                            </div>
                            <div style="display:none;" class="i-search-select">
                                <ul>
                                    <li key="" class="sub-line">全部订单</li>
                                    <li key="1" class="sub-line">团购订单</li>
                                    <li key="2" class="sub-line">虚拟订单</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                	<td width="33%">
                    	<label>交易状态：</label>
                        <div class="select_box" style="z-index:99">
                        	<input type="hidden" value="<?php echo $_GET['zt']; ?>
" name="zt">
                            <div class="search-select">
                                <span>
                                <?php if ($_GET['zt']): ?>
                                    <?php $_from = $this->_tpl_vars['order_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                                       <?php if ($this->_tpl_vars['key'] == $_GET['zt']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?> 
                                <?php else: ?>
                                   全部
                                <?php endif; ?>    
                                </span>
                                <b></b>
                            </div>
                            <div style="display:none;" class="i-search-select">
                                <ul>
                                    <li key="" class="sub-line">全部</li>
                                    <?php $_from = $this->_tpl_vars['order_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                                    <li key="<?php echo $this->_tpl_vars['key']; ?>
" class="sub-line"><?php echo $this->_tpl_vars['list']; ?>
</li>
                                    <?php endforeach; endif; unset($_from); ?>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td>
                    	<label>成交时间：</label>
                        <input onFocus="cdr.show(this);" type="text" class="w70 time" name="stime" value="<?php echo $_GET['stime']; ?>
" />
                        &nbsp;到&nbsp;
                        <input onFocus="cdr.show(this);" type="text" class="w70 time" name="etime" value="<?php echo $_GET['etime']; ?>
" />
                    </td>
                </tr>
                <tr>
                    <td>
                    	<label>卖家昵称：</label>
                        <input type="text" class="w90" name="seller" value="<?php echo $_GET['seller']; ?>
" />
                    </td>
                	<td>
                    	<label>评价状态：</label>
                        <div class="select_box" style="z-index:1">
                        	<input type="hidden" value="<?php echo $_GET['rate']; ?>
" name="rate">
                            <div class="search-select">
                                <span>
                                <?php if ($_GET['rate']): ?>
                                    <?php $_from = $this->_tpl_vars['rate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                                       <?php if ($this->_tpl_vars['key'] == $_GET['rate']): ?><?php echo $this->_tpl_vars['list']; ?>
<?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?>
                                <?php else: ?>
                                   全部
                                <?php endif; ?>    
                                </span>
                                <b></b>
                            </div>
                            <div style="display:none;" class="i-search-select">
                                <ul>
                                    <li key="" class="sub-line">全部</li>
                                    <?php $_from = $this->_tpl_vars['rate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                                    <li key="<?php echo $this->_tpl_vars['key']; ?>
" class="sub-line"><?php echo $this->_tpl_vars['list']; ?>
</li>
                                    <?php endforeach; endif; unset($_from); ?>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td>
                    	<label>售后服务：</label>
                        <div class="select_box" style="z-index:1">
                        	<input type="hidden" value="<?php echo $_GET['sh']; ?>
" name="sh">
                            <div class="search-select">
                                <span>全部</span>
                                <b></b>
                            </div>
                            <div style="display:none;" class="i-search-select">
                                <ul>
                                    <li key="" class="sub-line">全部</li>
                                    <li key="1" class="sub-line">退款</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>   
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/Calendar.js"></script>       
		<script type="text/javascript">
		var cdr = new Calendar("cdr");
		document.write(cdr);
		cdr.showMoreDay = true;

		$(function(){
			 $(".search-opt a").click(function(){
				$(this).hide().siblings().show();
				if($(this).attr("class") == 'show-whole')
					$(".whole").show();
				else
					$(".whole").hide();
			})
			$(".search-select").click(function(){ 
				var obj=$(this);
				$(obj).addClass("current");
				$(obj).next().find("li").each(function(){
					var val = $(this).parent().parent().prev().prev().val();
					
						$.each($('li[key="'+val+'"]'),function(i){
							$(this).addClass('selected').siblings().removeClass('selected');						});	
					
				});
				$(this).next().slideToggle("fast",function(){
					if($(obj).next().is(":visible")){
						$(document).one('click',function(){
							$(".search-select").next().slideUp("fast");
							$(obj).removeClass("current");
						});
					}
				});
			});
			$(".i-search-select li").click(function(){
				var str=$(this).html();
				$(this).parent().parent().prev().prev().attr("value",$(this).attr("key"));
				$(this).parent().parent().prev().children("span").html(str);
				//$(this).parent().parent().slideToggle();
			});
		});
		</script>
        </div>
        <table class="table-list-style order">
        	<thead>
                <tr>
                    <th width="*">商品</th>
                    <th width="80">单价(元)</th>
                    <th width="80">数量</th>
                    <th width="100">商品操作</th>
                    <th width="120">实付款(元)</th>
                    <th width="120">交易状态</th>
                    <th width="120">交易操作</th>
                </tr>
            </thead>
            <?php $_from = $this->_tpl_vars['blist']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['buylist']):
?>
            <?php $this->assign('count', count($this->_tpl_vars['buylist']['product'])); ?>
            <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
            <tbody <?php if ($this->_tpl_vars['buylist']['status'] == 0 || $this->_tpl_vars['buylist']['status'] == 4): ?>class="success-order"<?php endif; ?>>
                <tr>
                    <td class="sep-row" colspan="20"></td>
                </tr>
                
                <tr>
                    <th class="bdl">
                    <span class="dealtime"><?php echo ((is_array($_tmp=$this->_tpl_vars['buylist']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</span>
                    <span class="number">订单号：<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
</span>
                    </th>
                    <th colspan="2"><a target="_blank" title="<?php echo $this->_tpl_vars['buylist']['company']; ?>
" href="shop.php?uid=<?php echo $this->_tpl_vars['buylist']['seller_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['buylist']['company'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16) : smarty_modifier_truncate($_tmp, 16)); ?>
</a></th>
                    <th></th>
                    <th class="bdr" colspan="3"></th>
                </tr>
                
                <?php $_from = $this->_tpl_vars['buylist']['product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['plist']):
?>
                <tr> 
                    <td class="bdl product">
                        <a class="pic" target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&order_id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
&pid=<?php echo $this->_tpl_vars['plist']['id']; ?>
&id=<?php echo $this->_tpl_vars['plist']['pid']; ?>
"><img width="80" height="80" src="<?php echo $this->_tpl_vars['plist']['pic']; ?>
_220X220.jpg" /></a>
                        <div class="desc">
                        <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=detail&pid=<?php echo $this->_tpl_vars['plist']['id']; ?>
&id=<?php echo $this->_tpl_vars['plist']['pid']; ?>
&order_id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
"><?php echo $this->_tpl_vars['plist']['name']; ?>
</a>
                        <?php if ($this->_tpl_vars['plist']['is_tg'] == 'true'): ?><p><span class="tg">团购</span></p><?php endif; ?>
                        <?php if ($this->_tpl_vars['plist']['spec']): ?>
                        <p>
                        <?php $_from = $this->_tpl_vars['plist']['spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                        <?php echo $this->_tpl_vars['v']; ?>
&nbsp;
                        <?php endforeach; endif; unset($_from); ?>
                        </p>
                        <?php endif; ?>
                        </div>
                    </td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['plist']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td>
                    <td><?php echo $this->_tpl_vars['plist']['num']; ?>
</td>
                    <td>
                        <?php if ($this->_tpl_vars['plist']['status'] == 4): ?>
                        <a class="org" href="main.php?m=product&s=admin_apply_detail&order_id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
&pid=<?php echo $this->_tpl_vars['plist']['id']; ?>
">退款处理中</a>
                        <?php elseif ($this->_tpl_vars['plist']['status'] == 5): ?>
                        <a class="black" target="_blank" href="main.php?m=product&s=admin_apply_detail&order_id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
&pid=<?php echo $this->_tpl_vars['plist']['id']; ?>
">查看退款</a>
                        <?php else: ?>
                        <?php if ($this->_tpl_vars['buylist']['status'] == 2 || $this->_tpl_vars['buylist']['status'] == 3): ?>
                        <?php if (( $this->_tpl_vars['buylist']['is_virtual'] == 1 && $this->_tpl_vars['buylist']['recate'] != '0' ) || $this->_tpl_vars['buylist']['is_virtual'] == 0): ?>
                        <a href="main.php?m=product&s=admin_apply&requireId=1&order_id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
&id=<?php echo $this->_tpl_vars['plist']['id']; ?>
">退款/退货</a>
                        <?php else: ?>
                        不支持
                        <?php endif; ?>
                        <?php elseif ($this->_tpl_vars['buylist']['status'] == 4 && $this->_tpl_vars['buylist']['is_line'] != 1): ?>
                        <a href="main.php?m=product&s=admin_apply&requireId=1&order_id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
&id=<?php echo $this->_tpl_vars['plist']['id']; ?>
">申请售后</a>
                        <?php endif; ?>
                        <?php endif; ?>
						<?php if ($this->_tpl_vars['buylist']['is_line'] == 1): ?><p style="color:red;">线下订单</p><p style="color:red;"><?php echo $this->_tpl_vars['buylist']['payment_name']; ?>
</p><?php endif; ?>
                    </td>
                
                    <?php if ($this->_tpl_vars['key'] == 0): ?>
                    <td class="bl" rowspan="<?php echo $this->_tpl_vars['count']; ?>
">
						<b><?php echo ((is_array($_tmp=$this->_tpl_vars['buylist']['product_price']+$this->_tpl_vars['buylist']['logistics_price']-$this->_tpl_vars['buylist']['deduction'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</b>
						<?php if ($this->_tpl_vars['buylist']['voucher_price'] > 0): ?><br/>优惠券抵：<b><?php echo ((is_array($_tmp=$this->_tpl_vars['buylist']['voucher_price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</b>元<?php endif; ?>
						<?php if ($this->_tpl_vars['buylist']['discounts'] > 0): ?><br/>店铺会员:<b><?php echo $this->_tpl_vars['buylist']['discounts']; ?>
</b>折<?php endif; ?>
						<?php if ($this->_tpl_vars['buylist']['deduction'] > 0): ?><br/>折扣金额:<b>-<?php echo $this->_tpl_vars['buylist']['deduction']; ?>
</b><?php endif; ?>
						<!-- <?php if ($this->_tpl_vars['buylist']['deduction'] > 0): ?><br/>付款金额:<b><?php echo $this->_tpl_vars['buylist']['product_price']-$this->_tpl_vars['buylist']['deduction']; ?>
</b><?php endif; ?> -->
					</td>
                   
                    <td class="bl" rowspan="<?php echo $this->_tpl_vars['count']; ?>
">
                    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=product&s=admin_orderdetail&id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
"><?php echo $this->_tpl_vars['buylist']['statu_text']; ?>
</a>
                    <a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=product&s=admin_orderdetail&id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
">订单详情</a>
                    
                    <?php if ($this->_tpl_vars['buylist']['status'] == 4 && $this->_tpl_vars['buylist']['buyer_comment'] == 1 && $this->_tpl_vars['buylist']['seller_comment'] != 1): ?>已评
                    <?php elseif ($this->_tpl_vars['buylist']['status'] == 4 && $this->_tpl_vars['buylist']['buyer_comment'] == 1 && $this->_tpl_vars['buylist']['seller_comment'] == 1): ?>双方已评
                    <?php endif; ?>
                    </td>
                    
                    <td class="bl bdr" rowspan="<?php echo $this->_tpl_vars['count']; ?>
">
                    <?php if ($this->_tpl_vars['buylist']['status'] == 1): ?>
                        <a class="button button-pay" href="<?php echo $this->_tpl_vars['config']['pay_url']; ?>
?m=payment&s=pay&tradeNo=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
">立刻付款</a>
                        <a onclick="return confirm('确定是否要取消？');" href="main.php?m=product&s=admin_buyorder&id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
&flag=0">取消订单</a>
                    <?php elseif ($this->_tpl_vars['buylist']['status'] == 3): ?>
                    	<p class="countdown">
                        	<i></i>
                        	<em>还剩<?php echo $this->_tpl_vars['buylist']['time_expand']; ?>
</em>
                        </p>
                    	<a class="button button-confirm" href="main.php?m=product&s=admin_buyorder&id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
&flag=4">确定收货</a>
                    <?php elseif ($this->_tpl_vars['buylist']['status'] == 5): ?>
                    	<!--<a href="main.php?m=product&s=admin_return_step&id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
">退货详情</a>-->
                    <?php elseif ($this->_tpl_vars['buylist']['status'] == 4 && ! $this->_tpl_vars['buylist']['buyer_comment']): ?>
                    	<a class="button button-rate" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=product&s=comment&uid=<?php echo $this->_tpl_vars['buid']; ?>
&id=<?php echo $this->_tpl_vars['buylist']['order_id']; ?>
">评论</a>
                    <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <tr>
                    <?php if ($this->_tpl_vars['buylist']['is_virtual'] == 1): ?>
                    <td colspan="4" class="bdl bdb"><b><font color="red">电子兑换码订单</font></b></td>
                    <?php else: ?>
                    <td class="bdl bdb product">运送方式：<?php echo $this->_tpl_vars['buylist']['logistics_type']; ?>
</td>
                    <td class="bdb"><?php echo ((is_array($_tmp=$this->_tpl_vars['buylist']['logistics_price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td>
                    <td class="bdb">-</td>
                    <td class="bdb">&nbsp;</td>
                    <?php endif; ?>
                </tr>
            </tbody>
			<?php endforeach; else: ?>
                <tr>
                    <td colspan="20" class="norecord">
                        <i></i><span>暂无符合条件的数据记录</span>	
                    </td>
                </tr>
            <?php endif; unset($_from); ?>
            <tfoot>
            <tr>
                <td colspan="20"><div class="pagination"><?php echo $this->_tpl_vars['blist']['page']; ?>
</div></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>