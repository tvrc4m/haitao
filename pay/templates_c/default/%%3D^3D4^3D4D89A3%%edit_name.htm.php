<?php /* Smarty version 2.6.20, created on 2016-05-11 19:19:46
         compiled from edit_name.htm */ ?>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<script type="text/javascript" src="script/my_lightbox.js"></script>
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
<script>
function formSubmit() {
    $.ajax({
        type: "POST",
        url:"https://www.mayihaitao.com/api/real.php",
        data:$('#form').serialize(),
        async: false,
        error: function(request) {
        },
        success: function(data) {
            //-1真实姓名不能为空！-2身份证号不能为空！-3请填写正确身份证号！-4姓名和身份证不一致！
            var data = JSON.parse(data);
            $(".form-error").html('');
            switch(data.erry){
                case -1:
                    $("#real_name").nextAll(".form-error").html('<label>真实姓名不能为空！</label>');
                    break;
                case -2:
                    $("#identity_card").nextAll(".form-error").html('<label>身份证号不能为空！</label>');
                    break;
                case -3:
                    $("#identity_card").nextAll(".form-error").html('<label>请填写正确身份证号！</label>');
                    break;
                case -4:
                    $("#identity_card").nextAll(".form-error").html('<label>姓名和身份证不一致！</label>');
                    break;
                case -5:
                    window.location.href=data.url;
                default:
                    $("#real_name").attr("readonly","readonly");
                    $("#identity_card").attr("readonly","readonly");
                    $("#form dl:last").remove();
            }
        }
    });
    return false;
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
    <form method="post" id="form" onsubmit="return formSubmit();">
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
        <dl>
            <dt>上传身份证：</dt>
            <dd>
                <div class="logo_show uplode">
                    <input class="text w300 hidden" name="logo" type="text" id="logo" value="<?php echo $this->_tpl_vars['de']['logo']; ?>
">
                    <a href="javascript:uploadfile('LOGO','logo',120,120,'member')">
                        <img id="logo_img" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/pay/templates/default/image/icon9.png">
                    </a>
                </div>
                <div class="logo_show uplode">
                    <input class="text w300 hidden" name="logo1" type="text" id="logo1" value="<?php echo $this->_tpl_vars['de']['logo']; ?>
">
                    <a href="javascript:uploadfile('LOGO','logo1',120,120,'member')">
                        <img id="logo1_img" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/pay/templates/default/image/icon8.png">
                    </a>
                </div>
            </dd>
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