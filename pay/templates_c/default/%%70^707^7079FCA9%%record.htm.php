<?php /* Smarty version 2.6.20, created on 2016-07-19 14:44:16
         compiled from record.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'record.htm', 42, false),)), $this); ?>
<div class="block fn-clear">
	<div class="record">
        <h2>
            <?php if ($_GET['mold'] == 1): ?>充值记录<?php elseif ($_GET['mold'] == 2): ?>提现记录<?php else: ?>交易记录<?php endif; ?>
            <span>可用余额<strong><?php echo $this->_tpl_vars['de']['cash']; ?>
</strong>元</span>
        </h2>
    	<?php if (! $_GET['mold']): ?>
   		<div class="filter">
    	<div class="date"></div>
        <dl class="fn-clear">
        	<dt>交易分类：</dt>
            <dd>
            <a <?php if (! $_GET['type']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record<?php if ($_GET['status']): ?>&status=<?php echo $_GET['status']; ?>
<?php endif; ?>">全部</a>
            <a <?php if ($_GET['type'] == 1): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&type=1<?php if ($_GET['status']): ?>&status=<?php echo $_GET['status']; ?>
<?php endif; ?>">付款</a>
            <a <?php if ($_GET['type'] == 2): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&type=2<?php if ($_GET['status']): ?>&status=<?php echo $_GET['status']; ?>
<?php endif; ?>">收款</a>
            </dd>
        </dl>
        <dl class="fn-clear">
        	<dt>交易状态：</dt>
            <dd>
            <a <?php if (! $_GET['status']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">全部</a>
            <a <?php if ($_GET['status'] == 1): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=1<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">未付款</a>
            <a <?php if ($_GET['status'] == 2): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=2<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">等待发货</a>
            <a <?php if ($_GET['status'] == 3): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=3<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">未确认收货</a>
			<a <?php if ($_GET['status'] == 4): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=4<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">成功</a>
            <a <?php if ($_GET['status'] == 10): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&status=10<?php if ($_GET['type']): ?>&type=<?php echo $_GET['type']; ?>
<?php endif; ?>">失败</a>
            </dd>
        </dl>
    </div>
    <?php endif; ?>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <th class="al" width="80">创建时间</th>
                <th class="al">名称 | 交易号</td>
                <?php if (! $_GET['mold']): ?><th class="al" width="120">对方</th><?php endif; ?>
                <th width="100">金额(元)</th>
                <th width="80">状态</th>
                <th width="60">操作</th>
            </tr>
            <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
                <td class="al" <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan="2"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
                <td class="al">
                <?php echo $this->_tpl_vars['list']['note']; ?>

                <div>
                    交易号
                    <?php if ($this->_tpl_vars['list']['order_id'] && $this->_tpl_vars['list']['mold'] != 8): ?>
                        <?php echo $this->_tpl_vars['list']['order_id']; ?>

                    <?php else: ?>
                        <?php echo $this->_tpl_vars['list']['flow_id']; ?>

               		<?php endif; ?>
             	</div>
                </td>
                <?php if (! $_GET['mold']): ?><td class="al"><?php echo $this->_tpl_vars['list']['name']['real_name']; ?>
</td><?php endif; ?>
                <td class="price<?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?> minus<?php endif; ?>"><?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?>+<?php endif; ?><?php echo $this->_tpl_vars['list']['price']; ?>
</td>
                <td <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan="2"<?php endif; ?>>
                <?php if ($this->_tpl_vars['list']['statu'] == 1): ?><?php if ($this->_tpl_vars['list']['mold'] == 8): ?>进行中<?php else: ?>等待付款<?php endif; ?>
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
                </td>
                <td <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>rowspan="2"<?php endif; ?>>
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
                </td>
            </tr>
            <?php if ($this->_tpl_vars['list']['is_refund'] == 'true'): ?>
            <tr>
            	<td class="al">退款</td>
                <td></td>
            	<td class="price <?php if ($this->_tpl_vars['list']['minus'] != 'T'): ?> minus<?php endif; ?>">
                	<?php if ($this->_tpl_vars['list']['minus'] == 'T'): ?>+<?php else: ?>-<?php endif; ?><?php echo $this->_tpl_vars['list']['refund_amount']; ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="99">
                <div class="none fn-clear">
                    <img class="fn-left" src="templates/default/image/none.jpg" />
                    <span class="fn-left">没有找到记录，请调整搜索条件</span>
                </div>
                </td>
            </tr>
            <?php endif; unset($_from); ?>
            <?php if ($this->_tpl_vars['re']['page'] && $this->_tpl_vars['re']['page'] != '   '): ?>
            <tr>
                <td colspan="99">
                <div class="page"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
                </td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
</div>