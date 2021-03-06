<?php /* Smarty version 2.6.20, created on 2016-06-03 17:41:32
         compiled from recharge.htm */ ?>
<script type="text/javascript" src="script/Validator.js"></script>
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<link href="templates/wap/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block">
	<div class="i-block">
    	 <h2>充值到<?php echo $this->_tpl_vars['config']['company']; ?>
<span><a class="withdraw" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=record&mold=1">充值记录</a></span></h2>
    </div>
    <div style="background-color:#ededed;height:10px;"></div>
	<div class="form">
    <form method="post" onSubmit="return Validator.Validate(this,3)">
    	<fieldset id="bank">
    	<dl>
        	<dt style="margin-left:5px;">请选择充值方式：</dt>
            <dd class="pay">
                <input type="hidden" name="payment_type" id="payment_type" value="<?php echo $this->_tpl_vars['pay']['1']['payment_type']; ?>
" />
                <ul class="fn-clear">  
                <?php $_from = $this->_tpl_vars['pay']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['list']):
?>
                    <?php if ($this->_tpl_vars['list']['payment_type'] != 'account'): ?>
                    <li>
                        <a class="form_zhifu_btn" data-param="{'id':'<?php echo $this->_tpl_vars['list']['payment_type']; ?>
'}"><img src="image/payment/<?php echo $this->_tpl_vars['list']['payment_type']; ?>
.gif" class="form_qianbao_img"><?php echo $this->_tpl_vars['list']['payment_name']; ?>
<i></i></a>
                    </li>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>  
                </ul>
            </dd>
        </dl>
        </fieldset>
        <fieldset class="d1 <?php if ($this->_tpl_vars['pay']['1']['payment_type'] == 'cards'): ?>fn-hide<?php endif; ?>">
        <dl>
        	<dt>付款金额：</dt>
            <dd><input type="number" class="text w100 w100_number" name="amount" id="amount" autocomplete="off" dataType="<?php if ($this->_tpl_vars['pay']['1']['payment_type'] != 'cards'): ?>Double<?php endif; ?>" placeholder="填写充值金额" msg="请填写充值金额" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" onkeyup="value=value.replace(/[^\d]/g,'')"/> 元</dd>
        </dl>
		</fieldset>
        <fieldset class="d2 <?php if ($this->_tpl_vars['pay']['1']['payment_type'] != 'cards'): ?>fn-hide<?php endif; ?>">
        <dl>
            <dt>充值卡帐号：</dt>
            <dd><input type="text" name="card_num" id="card_num" class="w200 text" autocomplete="off" dataType="<?php if ($this->_tpl_vars['pay']['1']['payment_type'] == 'cards'): ?>Require<?php endif; ?>" msg="请填写充值金额" /></dd>
        </dl>
        <dl>
            <dt>充值卡密码：</dt>
            <dd><input type="password" name="password" id="password" class="w200 text" autocomplete="off" dataType="<?php if ($this->_tpl_vars['pay']['1']['payment_type'] == 'cards'): ?>Require<?php endif; ?>" msg="请填写充值金额" /></dd>
        </dl>
		</fieldset>
        <dl>
            <dt></dt>
            <dd>
            <input type="submit" class="submit" value="确定信息并充值" />
            </dd>
        </dl>
    </form>    
    </div>
</div>	
<script type="text/javascript">
$(".pay .fn-clear li:first-of-type").find("i").addClass("formsh")
$(".pay li").bind("click",function(){
	var data = $(this).children('a').attr('data-param');
	eval("data = "+data);
	if(data.id=='cards')
	{
		$("#amount").attr("dataType","");
		$("#card_num").attr("dataType","Require");
		$("#password").attr("dataType","Require");
		$(".d2").removeClass("fn-hide").siblings(".d1").addClass("fn-hide");
	}
	else
	{
		$("#amount").attr("dataType","Double");
		$("#card_num").attr("dataType","");
		$("#password").attr("dataType","");
		$(".d2").addClass("fn-hide").siblings(".d1").removeClass("fn-hide");
	}
	$("#payment_type").val(data.id);
	$(this).find("i").toggleClass("formsh").end().siblings().find("i").removeClass("formsh");
});
</script>
