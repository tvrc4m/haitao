<?php /* Smarty version 2.6.20, created on 2016-05-13 15:27:31
         compiled from transfer.htm */ ?>
<script type="text/javascript" src="script/Validator.js"></script>
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block">
	<div class="i-block">
    	 <h2>转账到账户</h2>
    </div>
	<div class="form">
    <form method="post" id="form" onSubmit="return Validator.Validate(this,3);">
    <input type="hidden" name="act" value="transfer" />
    	<fieldset>
    	<dl>
        	<dt>收款人：</dt>
            <dd><input type="text" class="text w210" name="email" id="email" placeholder="收款人帐号" dataType="Require" msg="请填写收款人"/></dd>
        </dl>    
        </fieldset>
        <fieldset>
        <dl>
        	<dt>付款金额：</dt>
            <dd><input type="text" class="text w100" name="amount" id="amount" dataType="Double" msg="请填写付款金额"/> 元</dd>
        </dl>
      	</fieldset>
        <fieldset>
        <dl>
        	<dt>付款说明：</dt>
            <dd><input type="text" class="text w210" name="reason" id="reason" placeholder="可选" /></dd>
        </dl>
        </fieldset>
        <fieldset>
            <dl>
                <dt>确认支付密码：</dt>
                <dd><input type="password" class="text w210" name="pay_passwd" id="pay_passwd" placeholder="支付密码" /></dd>
            </dl>
        </fieldset>
        <dl>
            <dt></dt>
            <dd>
            <input type="button" class="submit" value="确定信息并付款" />
            </dd>
        </dl>
    </form>    
    </div>
</div>
<script>
$(".submit").click(function(){
	
	if($("#email").val() && $("#amount").val())
	{
		$(".submit").attr("disabled","true");
		$(".submit").val('正在提交 ，请等待...');
	}
	$("#form").submit();
});
</script>