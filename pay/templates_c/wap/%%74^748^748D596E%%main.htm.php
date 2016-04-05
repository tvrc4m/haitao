<<<<<<< HEAD
<<<<<<< HEAD
<?php /* Smarty version 2.6.20, created on 2016-03-25 13:15:39
=======
<?php /* Smarty version 2.6.20, created on 2016-03-25 13:40:30
>>>>>>> 7312265edf19ae6214b40415a77164f944fcc85e
=======
<?php /* Smarty version 2.6.20, created on 2016-03-31 09:30:42
>>>>>>> 4741dc70199675e6b1ede86d304d73c7832c9beb
         compiled from main.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'main.htm', 35, false),)), $this); ?>
<div class="block fn-clear">
	<div class="balance account">
    	<p>
        账户余额
        <!--<a target="_blank" href="">百度金融火热抢购中！</a>-->
        </p>
        <div>
            <span class="wallet">
                <em><strong><?php echo $this->_tpl_vars['de']['cash']; ?>
</strong></em>
                <span> 元</span>
            </span>
            <a class="btn" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=recharge">充 值</a>
            <a class="btn" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=withdraw">提 现</a>
            <a class="btn1" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=transfer">转 账</a>
        </div>
    </div>
</div>
<div class="block">
	<div class="record">
        <p>
            交易记录
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record">收支明细</a></li>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&mold=1">充值记录</a>
            <a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&mold=2">提现记录</a>
        </p>
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
                <th class="al">名称 | 交易号</td>
                <th width="20%">金额(元)</th>
                <th width="25%">状态</th>
                <!--<th width="15%">操作</th>-->
            </tr>
        	<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
            	<td class="al"><?php echo $this->_tpl_vars['list']['note']; ?>
<br><br>时间：<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
            	<td class="price <?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?> minus<?php endif; ?>">
                	<?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?>+<?php endif; ?><?php echo $this->_tpl_vars['list']['price']; ?>

                </td>
            	<td <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan="2"<?php endif; ?>>
                <?php if ($this->_tpl_vars['list']['statu'] == 1): ?>
                	<?php if ($this->_tpl_vars['list']['mold'] == 8): ?>进行中<?php else: ?>等待付款<?php endif; ?>
                <?php elseif ($this->_tpl_vars['list']['statu'] == 2): ?>
                    <?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>
                    已付款
                    <?php else: ?>
                    等待发货
                    <?php endif; ?>
                <?php elseif ($this->_tpl_vars['list']['statu'] == 3): ?>
                <?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>
                等待确认收货
                <?php else: ?>
                已发货
                <?php endif; ?>
                <?php elseif ($this->_tpl_vars['list']['statu'] == 4): ?>交易成功
                <?php elseif ($this->_tpl_vars['list']['statu'] == 5): ?>
                <?php if ($this->_tpl_vars['list']['buyer_email'] == ''): ?>
                已审请退货
                <?php else: ?>
                要求退货
                <?php endif; ?>
                	<?php elseif ($this->_tpl_vars['list']['statu'] == 6): ?>
                	已退货
                	<?php else: ?>已取消
                <?php endif; ?>
                <br>
            	<p <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan="2"<?php endif; ?>>
                <?php if ($this->_tpl_vars['list']['statu'] == 1 && $this->_tpl_vars['list']['seller_email'] && ( $this->_tpl_vars['list']['mold'] == 3 || $this->_tpl_vars['list']['mold'] == 0 )): ?>
                	<a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=payment&s=pay&tradeNo=<?php echo $this->_tpl_vars['list']['order_id']; ?>
">付款</a>
                <?php else: ?>
                	<a target="_blank" href="<?php if ($this->_tpl_vars['list']['return_url']): ?><?php echo $this->_tpl_vars['list']['return_url']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
?m=payment&s=detail&tradeNo=<?php echo $this->_tpl_vars['list']['flow_id']; ?>
<?php endif; ?>">详情</a>
                <?php endif; ?>
                </p>
                </td>
            </tr>
            <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>
            <tr>
            	<td class="al">退款</td>
            	<td class="price <?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?> minus<?php endif; ?>">
                	<?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?>+<?php else: ?>-<?php endif; ?><?php echo $this->_tpl_vars['list']['refund_amount']; ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="5">
                <div class="none">
                    <img src="templates/default/image/none.jpg" />
                    <span>没有找到记录</span>
                </div>   
                </td>
            </tr>
            <?php endif; unset($_from); ?>
        </table>
    </div> 
</div>