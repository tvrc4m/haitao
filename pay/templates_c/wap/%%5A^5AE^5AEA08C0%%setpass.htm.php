<?php /* Smarty version 2.6.20, created on 2016-04-06 14:51:54
         compiled from setpass.htm */ ?>
<script type="text/javascript" src="script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#form').validate({
            errorPlacement: function(error, element){
                element.next('.form-error').append(error);
            },
            rules : {
                oldpass:{
                    required:true
                },
                pass:{
                    required:true,
                    minlength:"6",
                    maxlength:"16"
                },
                re_pass:{
                    equalTo: "#pass"
                }
            },
            messages : {
                oldpass:{
                    required:'请输入原始支付密码。'
                },
                pass:{
                    required:'请输入支付密码。',
                    minlength:"支付登录长度应为6-16个字符。",
                    maxlength:"支付登录长度应为6-16个字符。"
                },
                re_pass:{
                    equalTo:'两次密码输入不一致。'
                }
            }
        });
    });
</script>
<link href="templates/wap/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block">
    <div class="i-block">
        <h2>支付密码</h2>
    </div>
    <?php if (! $this->_tpl_vars['de']['pay_pass']): ?>
    <div class="tips"><span></span>温馨提示：请先设置
        <?php if (! $this->_tpl_vars['de']['pay_pass']): ?>支付密码<?php endif; ?>。</div>
    <?php endif; ?>
    <div class="form">
        <form method="post" id="form">
            <input type="hidden" name="act" value="act" />
            <fieldset>
                <?php if ($this->_tpl_vars['de']['pay_pass']): ?>
                <dl class="oldpass">
                    <dt>原始支付密码：</dt>
                    <dd>
                        <input style="float: left" type="password" class="text" name="oldpass" id="oldpass" onblur="chk_oldpass()"/>
                        <div class="findpass"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=findpass">忘记密码？</a></div>
                        <div class="form-error" style="clear:both;"></div>
                    </dd>
                </dl>
                <?php endif; ?>
                <dl>
                    <dt>设置支付密码：</dt>
                    <dd><input type="password" class="text" name="pass" id="pass" /><div class="form-error"></div></dd>
                </dl>

                <dl>
                    <dt>确认支付密码：</dt>
                    <dd><input type="password" class="text" name="re_pass" id="re_pass" /><div class="form-error"></div></dd>
                </dl>
            </fieldset>
            <dl>
                <dt></dt>
                <dd>
                    <input type="button" class="submit" value="确定"  onclick="chk_oldpass();"/>
                </dd>
            </dl>
        </form>
    </div>
</div>
<script>
    function chk_oldpass(){
        var flag = true;
        if($("#oldpass").is(":visible")){
            var oldpass = $("#oldpass").val();
            var pay_id = "<?php echo $this->_tpl_vars['de']['pay_id']; ?>
";
            var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/member.php';
            var pars = 'action=check_oldpass&pay_id=' + pay_id +'&pass='+oldpass;
            $.post(url, pars, function (result){
                if(!result||result==0){
                    $("#oldpass").siblings(".form-error").html("<label for='oldpass' generated='true' class='error'>原始密码错误，请重新输入</label>");
                    $("#oldpass").focus();
                    flag = false;
                }else{
                    $("#oldpass").siblings(".form-error").html("");
                }
            })
        }
        if(flag){
            if(!$("#pass").val())
                $("#pass").next().html("<label for='pass' generated='true' class='error'>请输入支付密码。</label>");
            else if(!$("#pass").val())
                $("#re_pass").next().html("<label for='re_pass' generated='true' class='error'>请确认支付密码。</label>");
            else
                $("#form").submit();
        }
    }
</script>