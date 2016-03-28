<?php /* Smarty version 2.6.20, created on 2016-03-25 09:49:59
         compiled from settings.htm */ ?>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<script src="script/my_lightbox.js" language="javascript"></script>
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block">
    <div class="i-block">
        <h2>账户信息</h2>
    </div>
    <?php if (! $this->_tpl_vars['de']['pay_mobile']): ?>
    <div class="tips"><span></span>温馨提示：请先设置账户信息。</div>
    <?php endif; ?>
    <div class="form">
        <form method="post" id="form">
            <input type="hidden" name="act" value="act" />
            <fieldset>
                <dl class="email">
                    <dt>用户名：</dt>
                    <dd><?php echo $this->_tpl_vars['de']['email']; ?>
</dd>
                </dl>
                <dl class="email">
                    <dt>手机号：</dt>
                    <dd><input type="text" class="text" name="pay_mobile" id="pay_mobile" value="<?php echo $this->_tpl_vars['de']['pay_mobile']; ?>
"/><div class="form-error"></div></dd>
                </dl>
                <dl>
                    <dt>当前头像：</dt>
                    <dd>
                        <p class="pic" style=" width:120px; height:120px; "><img id="logo_img" src="<?php if ($this->_tpl_vars['de']['logo']): ?><?php echo $this->_tpl_vars['de']['logo']; ?>
<?php else: ?>templates/default/image/avatar.png<?php endif; ?>" height="120" width="120" /></p>
                        <p><input style="width:300px" class="text" name="logo" type="text" id="logo" value="<?php if ($this->_tpl_vars['de']['logo']): ?><?php echo $this->_tpl_vars['de']['logo']; ?>
<?php else: ?>templates/default/image/avatar.png<?php endif; ?>"> <a class="upload-button" href="javascript:uploadfile('LOGO','logo',120,120,'member')">上传</a></p>
                    </dd>
                </dl>
            </fieldset>
            <dl>
                <dt></dt>
                <dd>
                    <input type="button" class="submit" value="确定" onclick="sub_chk()"/>
                </dd>
            </dl>
        </form>
    </div>
</div>
<script>
    function checkmo(m){  //手机号拦截器
        if(!(/^1[3|4|5|7|8][0-9]\d{8}$/.test(m))){
            return false;
        }
        else{
            return true;
        }
    }
    function sub_chk(){
        if($('#pay_mobile').val()){
            if(checkmo($('#pay_mobile').val())){
                $("#pay_mobile").next().html("");
                $("#form").submit();
            }else{
                $("#pay_mobile").next().html("<label for='pass' generated='true' class='error'>请输入正确的手机号。</label>");
            }
        }else{
            $("#pay_mobile").next().html("<label for='pass' generated='true' class='error'>请输入手机号。</label>");
        }
    }
</script>