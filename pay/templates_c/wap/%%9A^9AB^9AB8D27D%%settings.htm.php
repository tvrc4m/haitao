<?php /* Smarty version 2.6.20, created on 2016-03-03 15:06:13
         compiled from settings.htm */ ?>
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<script src="script/my_lightbox.js" language="javascript"></script>
<link href="templates/wap/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block" style="border: none;background-color: #f1f1f1;padding: 0 1%;">
    <?php if (! $this->_tpl_vars['de']['pay_mobile']): ?>
    <div class="tips"><span></span>温馨提示：请先设置账户信息。</div>
    <?php endif; ?>
    <div class="form">
        <form method="post" id="form">
            <input type="hidden" name="act" value="act" />
            <div class="s_logo">
                <div class="logo_info">
                    <span class="tit">上传头像</span>
                    <span class="des">建议尺寸200*200像素</span>
                </div>
                <div class="logo_div">
                    <div class="logo_show">
                        <input class="hidden" name="logo" type="text" id="logo" value="<?php if ($this->_tpl_vars['de']['logo']): ?><?php echo $this->_tpl_vars['de']['logo']; ?>
<?php else: ?>templates/default/image/avatar.png<?php endif; ?>">
                        <a href="javascript:uploadfile('LOGO','logo',120,120,'member')">
                            <img id="logo_img" src="<?php if ($this->_tpl_vars['de']['logo']): ?><?php echo $this->_tpl_vars['de']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/user_admin/default_user_portrait.gif<?php endif; ?>" width="70px" height="70px" style="border-radius: 50%; "/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="s_list">
                <div class="s_line">
                    <div class="s_text">
                        用户名
                    </div>
                    <div class="s_input">
                        <input type='text' value="<?php echo $this->_tpl_vars['de']['email']; ?>
" class="text" style="width:100%" disabled="disabled">
                    </div>
                </div>
                <div class="s_line">
                    <div class="s_text">
                        手机
                    </div>
                    <div class="s_input">
                        <input type='text' id="pay_mobile"  name="pay_mobile" value="<?php echo $this->_tpl_vars['de']['pay_mobile']; ?>
" class="text" style="width:100%">
                    </div>
                </div>
                <div class="s_des"></div>
            </div>
            <div class="clearfix"></div>
            <p class="shop_step_title clearfix"><input type="button" class="submit" value="确定" onclick="sub_chk()"/></p>
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
                $("#pay_mobile").parent().parent().next().html("<label for='pass' generated='true' class='error'>请输入正确的手机号。</label>");
            }
        }else{
            $("#pay_mobile").parent().parent().next().html("<label for='pass' generated='true' class='error'>请输入手机号。</label>");
        }
    }
</script>