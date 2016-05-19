<?php /* Smarty version 2.6.20, created on 2016-05-18 09:36:48
         compiled from pay.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'pay.htm', 6, false),)), $this); ?>
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block fn-clear">
	<div class="i-block payment">
        
        <div class="title">
       		<span><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['re']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</strong>元</span>
        	<div>
            <h3><?php echo $this->_tpl_vars['re']['note']; ?>
</h3>
            <p>收款方：蚂蚁海淘 <!--<?php if ($this->_tpl_vars['re']['real_name']): ?><?php echo $this->_tpl_vars['re']['real_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['re']['seller_email']; ?>
<?php endif; ?>--></p>
            </div>
        </div>
		
        <?php if ($this->_tpl_vars['re']['statu'] == 1): ?>
        <div class="form">
        <form method="post">
        <input type="hidden" name="act" value="pay" />
        <input type="hidden" name="payment_type" id="payment_type" value="<?php echo $this->_tpl_vars['pay']['0']['payment_type']; ?>
" />
            <fieldset>
            <dl>
                <dt>支付方式：</dt>
                <dd class="pay">
                    <ul class="fn-clear">
                    <?php $_from = $this->_tpl_vars['pay']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                    <li <?php if ($this->_tpl_vars['key'] == 0): ?>class="checked"<?php endif; ?> >
                    <img title="<?php echo $this->_tpl_vars['list']['payment_name']; ?>
" alt="<?php echo $this->_tpl_vars['list']['payment_name']; ?>
" data-param="{'id':'<?php echo $this->_tpl_vars['list']['payment_type']; ?>
'}" src="image/payment/<?php echo $this->_tpl_vars['list']['payment_type']; ?>
.gif" /><i></i>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>  
                    </ul>
                </dd>
            </dl> 
            </fieldset>
            <?php if ($this->_tpl_vars['account'] != 'false'): ?>
            <fieldset class="fieldset">  
            <dl class="free">
                <dt>可用总额：</dt>
                <dd><?php echo $this->_tpl_vars['de']['cash']; ?>
 元</dd>
            </dl> 
            <dl>
                <dt>支付密码：</dt>
                <dd><input type="password" class="text" name="password" value="" /></dd>
            </dl>
            </fieldset>
            <?php endif; ?>
            <dl>
                <dt></dt>
                <dd>
                <input type="submit" class="submit" value="确定支付" />
                </dd>
            </dl>
        </form>   
        </div>
        <?php endif; ?>
    
    </div>
</div>
    
<script>
$(".pay li").bind("click",function(){
	var data = $(this).children('img').attr('data-param');
	eval("data = "+data);
	<?php if ($this->_tpl_vars['account'] != 'false'): ?>
	if(data.id=='account')
	{
		$('.fieldset').show();
	}
	else
	{
		$('.fieldset').hide();
	}
	<?php endif; ?>
	$("#payment_type").val(data.id);
	$(this).addClass("checked").siblings().removeClass("checked");
});
</script>