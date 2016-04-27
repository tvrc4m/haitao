<<<<<<< HEAD
<?php /* Smarty version 2.6.20, created on 2016-04-27 18:41:22
=======
<?php /* Smarty version 2.6.20, created on 2016-04-27 18:57:11
>>>>>>> b6717d188edb9406d92d0792f86e0c7fe8b14fb4
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
<<<<<<< HEAD
        <form method="post" id="form" id="form" action="">
=======
        <form method="post" id="form" id="form" onsubmit="return commit()" action="">
>>>>>>> b6717d188edb9406d92d0792f86e0c7fe8b14fb4
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
                    <input type="submit" class="submit" value="确定" />
                </dd>
            </dl>
        </form>
    </div>
</div>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/../script/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/../script/layer/layer.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/../script/layer/skin/layer.ext.css" id="layui_layer_skinlayerextcss">
<script type="text/javascript">
function commit () {
    $.ajax({
        type: "POST",
        data:$('#form').serialize(),
<<<<<<< HEAD
        error: function(request) {
        },
        success: function(data) {
        }
    });
=======
        async: false,
        error: function(request) {
        },
        success: function(data) {
            if(data){
                layer.msg("修改成功",{icon:0});
            }
        }
    });
    return false;
>>>>>>> b6717d188edb9406d92d0792f86e0c7fe8b14fb4
}
</script>