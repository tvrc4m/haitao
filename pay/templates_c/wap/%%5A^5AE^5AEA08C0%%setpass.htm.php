<?php /* Smarty version 2.6.20, created on 2016-04-21 17:04:44
         compiled from setpass.htm */ ?>
<link href="templates/wap/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block">
    <div class="i-block">
        <h2 style="border-bottom:1px solid #f1f1f1;">设置支付密码</h2>
    </div>
    <?php if (! $this->_tpl_vars['de']['pay_pass']): ?>
    <div class="tips"><span></span>温馨提示：请先设置
        <?php if (! $this->_tpl_vars['de']['pay_pass']): ?>支付密码<?php endif; ?>。</div>
    <?php endif; ?>
    <div class="form">
        <form method="post" id="form">
            <input type="hidden" name="act" value="act" />
            <fieldset class="post_lis">
                <?php if ($this->_tpl_vars['de']['pay_pass']): ?>
                <dl class="oldpass">
                    <dt>旧支付密码：</dt>
                    <dd>
                        <input style="float: left" type="password" class="text"  tabindex="2" maxlength="10" autocomplete="off"  name="oldpass" id="oldpass" onblur="chk_oldpass()"/>
                        <!-- <div class="form-error" style="clear:both;"></div> -->
                    </dd>
                </dl>
                <dl>
                    <dt>新支付密码：</dt>
                    <dd><input type="password" class="text"  tabindex="2" maxlength="10" autocomplete="off"  name="pass" id="pass" /><!-- <div class="form-error"></div> --></dd>
                </dl>
                <dl>
                    <dt>确认新密码：</dt>
                    <dd><input type="password" class="text"  tabindex="3" maxlength="10" autocomplete="off"  name="re_pass" id="re_pass" /></dd>
                </dl>
                <div class="form-error"></div>
                <?php else: ?>
                <dl>
                    <dt>支付密码：</dt>
                    <dd><input type="password" class="text"  tabindex="2" maxlength="10" autocomplete="off"  name="pass" id="pass" /><!-- <div class="form-error"></div> --></dd>
                </dl>
                <dl>
                    <dt>确认密码：</dt>
                    <dd><input type="password" class="text"  tabindex="3" maxlength="10" autocomplete="off"  name="re_pass" id="re_pass" /></dd>
                </dl>
                <div class="form-error"></div>
                <?php endif; ?>
            </fieldset>
             <?php if ($this->_tpl_vars['de']['pay_pass']): ?>
            <dl class="dfr">
                <dt></dt>
                <dd><div class="findpass"><a href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/?m=payment&s=findpass">忘记密码？</a></div></dd>
            </dl>
             <?php endif; ?>
            <dl>
                <dt></dt>
                <dd>
                    <input type="button" class="submit" value="确定"  onclick="chk_oldpass();"/>
                </dd>
            </dl>
        </form>
    </div>
</div>
<script type="text/javascript" src="script/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<script type="text/javascript">  
        $('#form').validate({
            errorPlacement: function(error, element){
                $('.form-error').append(error);
            },
            rules : {
                oldpass:{
                    required:true
                },
                pass:{
                    required:true,
                    minlength:"6",
                    maxlength:"10"
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
                    minlength:"支付登录长度应为6-10个字符。",
                    maxlength:"支付登录长度应为6-10个字符。"
                },
                re_pass:{
                    equalTo:'两次密码输入不一致。'
                }
            }
        }); 

</script>
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
                    $(".form-error").html("<label for='oldpass' generated='true' class='error'>原始密码错误，请重新输入</label>");
                    $("#oldpass").focus();
                    flag = false;
                }else{
                    $(".form-error").html("");
                }
            })
        }
        if(flag){
            if(!$("#pass").val())
                $(".form-error").html("<label for='pass' generated='true' class='error'>请输入支付密码。</label>");
            else if(!$("#pass").val())
                $(".form-error").html("<label for='re_pass' generated='true' class='error'>请确认支付密码。</label>");
            else
                $("#form").submit();
        }
    }
</script>