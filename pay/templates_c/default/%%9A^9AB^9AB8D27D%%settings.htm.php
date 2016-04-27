<?php /* Smarty version 2.6.20, created on 2016-04-27 18:27:03
         compiled from settings.htm */ ?>
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
        <form method="post" id="form" id="form">
            <input type="hidden" name="act" value="act" />
            <fieldset>
                <dl class="email">
                    <dt>用户名：</dt>
                    <dd><?php echo $this->_tpl_vars['de']['email']; ?>
</dd>
                </dl>
                <dl class="email">
                    <dt>手机号：</dt>
                    <dd>
                        <?php if ($this->_tpl_vars['de']['pay_mobile']): ?>
                            <?php echo $this->_tpl_vars['de']['pay_mobile']; ?>

                        <?php else: ?>
                            <input type="text" class="text" name="pay_mobile" id="pay_mobile" value="<?php echo $this->_tpl_vars['de']['pay_mobile']; ?>
"/>
                        <?php endif; ?>
                        <div class="form-error"></div>
                    </dd>
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
                    <input type="button" class="submit" value="确定" onclick="commit()" />
                </dd>
            </dl>
        </form>
    </div>
</div>
<script type="text/javascript">
function commit () {
$.ajax({
    type: "POST",
    data:$('#form').serialize(),
    async: false,
    error: function(request) {
    },
    success: function(data) {
    }
});
}
</script>