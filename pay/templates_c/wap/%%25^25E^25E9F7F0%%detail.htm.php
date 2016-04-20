<?php /* Smarty version 2.6.20, created on 2016-04-20 09:13:01
         compiled from detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'detail.htm', 22, false),array('modifier', 'date_format', 'detail.htm', 23, false),)), $this); ?>
<div class="block fn-clear">
      <div class="balance account balance2">
        <div>
            <span class="wallet">
                  <span>账户余额</span>
                <em><strong class="srt"><?php echo $this->_tpl_vars['de']['cash']; ?>
</strong></em>
                <span> 元</span>
            </span>
            <a class="btn btns" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=withdraw">提 现</a>
        </div>
    </div>
</div>
<div class="block fn-clear">
	<div class="i-block">
		<h2>账单详情</h2>
        <dl class="detail">
            <dt><?php echo $this->_tpl_vars['re']['note']; ?>
</dt>
            <?php if ($this->_tpl_vars['re']['real_name'] || $this->_tpl_vars['re']['seller_email']): ?>
            <dd><span>收款方：</span><?php if ($this->_tpl_vars['re']['real_name']): ?><?php echo $this->_tpl_vars['re']['real_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['re']['seller_email']; ?>
<?php endif; ?></dd>
            <?php endif; ?>
            <dd><span>交易号：</span><?php echo $this->_tpl_vars['re']['flow_id']; ?>
</dd>
            <dd><span>交易金额：</span><?php echo ((is_array($_tmp=$this->_tpl_vars['re']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
元</dd>
            <dd><span>购买时间：</span><?php echo ((is_array($_tmp=$this->_tpl_vars['re']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</dd>
            <dd><span>描述：</span><?php echo $this->_tpl_vars['re']['note']; ?>
</dd>
            <?php if ($this->_tpl_vars['re']['mold'] == 8): ?>
            <dd><span>提现银行：</span><?php echo $this->_tpl_vars['re']['bank']; ?>
</dd>
            <dd><span>银行卡号：</span><?php echo $this->_tpl_vars['re']['cardno']; ?>
</dd>
            <dd><span>开户人：</span><?php echo $this->_tpl_vars['re']['cardname']; ?>
</dd>
            <dd><span>提现金额：</span><?php echo $this->_tpl_vars['re']['amount']; ?>
</dd>
            <dd><span>服务费：</span><?php echo $this->_tpl_vars['re']['fee']; ?>
</dd>
            <dd><span>到账时间：</span><?php echo $this->_tpl_vars['re']['supportTimeName']; ?>
</dd>
            <?php if ($this->_tpl_vars['re']['bankflow']): ?><dd><span>回执流水号：</span><?php echo $this->_tpl_vars['re']['bankflow']; ?>
</dd><?php endif; ?>
            <?php if ($this->_tpl_vars['re']['con']): ?><dd><span>备注：</span><?php echo $this->_tpl_vars['re']['con']; ?>
</dd><?php endif; ?>
            <?php if ($this->_tpl_vars['re']['censor']): ?><dd><span>操作者：</span><?php echo $this->_tpl_vars['re']['censor']; ?>
</dd><?php endif; ?>
            <?php if ($this->_tpl_vars['re']['check_time']): ?><dd><span>操作时间：</span><?php echo ((is_array($_tmp=$this->_tpl_vars['re']['check_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</dd><?php endif; ?>
             <?php endif; ?>
            <dd><span>备注：</span>提款</dd>
        </dl>
	</div>
</div>