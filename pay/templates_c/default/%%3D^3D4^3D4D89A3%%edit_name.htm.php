<?php /* Smarty version 2.6.20, created on 2016-04-22 16:42:37
         compiled from edit_name.htm */ ?>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
<script>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.nextAll('.form-error').append(error);
		},
		rules:{
			real_name:{
				required:true
			},
			identity_card:{
				required:true
			}
		},
		messages:{
			real_name:{
				required:'请输入真实姓名。'
			},
			identity_card:{
				required:'请输入身份证号码。'
			}
		}
	});
});

function formSubmit() {
    $.ajax({
        type: "POST",
        url:ajaxCallUrl,
        data:$('#form').serialize(),
        async: false,
        error: function(request) {
        },
        success: function(data) {
            //-1真实姓名不能为空！-2身份证号不能为空！-3请填写正确身份证号！-4姓名和身份证不一致！
            switch(data.erry){
                case -1:
                    $("#real_name").nextAll(".form-error").html('<label for="real_name" generated="true" class="error">真实姓名不能为空！</label>');
                    break;
                case -2:
                    $("#identity_card").nextAll(".form-error").html('<label for="identity_card" generated="true" class="error">身份证号不能为空！</label>');
                    break;
                case -3:
                    $("#identity_card").nextAll(".form-error").html('<label for="identity_card" generated="true" class="error">请填写正确身份证号！</label>');
                    break;
                case -4:
                    $("#identity_card").nextAll(".form-error").html('<label for="identity_card" generated="true" class="error">姓名和身份证不一致！</label>');
                    break;
                default:
                    $("#real_name").attr("readonly","readonly");
                    $("#identity_card").attr("readonly","readonly");
                    $("#form dl:last").remove();
            }
            if(data.url){
                window.location.href(url);
            }
        }
    });
}
window.onload=function(){
    var refer = document.referrer;
    $("input[name='url']").val(refer);
}
</script>
<div class="block">
	<div class="i-block">
        <h2>实名认证</h2>
    </div>

    <div class="form">
    <form method="post" id="form">
    <input type="hidden" value="name" name="act" />
    <input type="hidden" value='' name="url">
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
            <dd><input type="submit" onclick="formSubmit();" class="submit" value="确 定" /></dd>
        </dl>
        <?php endif; ?>
    </form>
    </div>
</div>