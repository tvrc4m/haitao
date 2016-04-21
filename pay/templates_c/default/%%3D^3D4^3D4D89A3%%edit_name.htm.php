<?php /* Smarty version 2.6.20, created on 2016-04-21 09:34:40
         compiled from edit_name.htm */ ?>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
<script>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.nextAll('.form-error').append(error);
		},      
		rules : {
			real_name:{
				required:true
			},
			identity_card:{
				required:true
			}
		},
		messages : {
			real_name:{
				required:'请输入真实姓名。'
			},
			identity_card:{
				required:'请输入身份证号码。'
			}
		}
	});
});

</script>
<div class="block">
	<div class="i-block">
    	 <h2>实名认证</h2>
    </div>
    <div class="form">
    <form method="post" id="form" action="">
    <input type="hidden" value="name" name="act" />
        <fieldset>
        <dl class="email">
            <dt><?php echo $this->_tpl_vars['config']['company']; ?>
账户名：</dt>
            <dd><?php echo $this->_tpl_vars['de']['pay_email']; ?>
</dd>
        </dl>

        <dl>
            <dt>真实姓名：</dt>
            <dd><input type="text" class="text" name="real_name" id="real_name" value="<?php echo $this->_tpl_vars['de']['real_name']; ?>
" <?php if ($this->_tpl_vars['de']['identity_verify'] == 'true'): ?>readonly<?php endif; ?>/>
            <div class="form-error"></div></dd>
        </dl>

        <dl>
            <dt>身份证号码：</dt>
            <dd><input type="text" class="text" name="identity_card" id="identity_card" value="<?php echo $this->_tpl_vars['de']['identity_card']; ?>
" maxlength="18" <?php if ($this->_tpl_vars['de']['identity_verify'] == 'true'): ?>readonly<?php endif; ?> onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d.]/g,''))" /><div class="form-error"></div></dd>
        </dl>
        </fieldset>
        <?php if ($this->_tpl_vars['de']['identity_verify'] != 'true'): ?>
        <dl>
            <dt></dt>
            <dd><input type="submit" class="submit" value="确 定" /></dd>
        </dl>
        <?php endif; ?>
    </form>
    </div>
</div>