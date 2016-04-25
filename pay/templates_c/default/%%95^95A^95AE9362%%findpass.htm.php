<?php /* Smarty version 2.6.20, created on 2016-04-25 13:55:47
         compiled from findpass.htm */ ?>
<script type="text/javascript" src="script/jquery.validation.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#form').validate({
            errorPlacement: function(error, element){
                element.next('.form-error').append(error);
            },
            rules : {
                yzm:{
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
                yzm:{
                    required:'请输入验证码。'
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
<link href="templates/default/css/pay.css" rel="stylesheet" type="text/css" />
<div class="block">
    <div class="i-block">
        <h2>找回密码</h2>
    </div>
    <?php if (! $this->_tpl_vars['de']['pay_mobile']): ?>
    <div class="tips"><span></span>温馨提示：请先设置
        <?php if (! $this->_tpl_vars['de']['pay_mobile']): ?>手机号<?php endif; ?>。</div>
    <?php endif; ?>
    <div class="form">
        <form method="post" id="form">
            <input type="hidden" name="act" value="act" />
            <fieldset>
                <?php if ($this->_tpl_vars['de']['pay_mobile']): ?>
                <dl class="getyzm">
                    <dt>手机号：</dt>
                    <dd>
                        <input style="float: left" type="text" class="text" name="pay_mobile" id="pay_mobile" readonly value="<?php echo $this->_tpl_vars['de']['pay_mobile']; ?>
"/>
                        <input type="button" class="button" onclick="getyzm()" value="获取验证码">
                    </dd>
                </dl>

                <dl class="oldpass">
                    <dt>验证码：</dt>
                    <dd>
                        <input type="text" class="text" name="yzm" id="yzm" onblur="chk_yzm()"/>
                        <div class="form-error"></div>
                    </dd>
                </dl>
                <dl>
                    <dt>设置支付密码：</dt>
                    <dd><input type="password" class="text" name="pass" id="pass" /><div class="form-error"></div></dd>
                </dl>

                <dl>
                    <dt>确认支付密码：</dt>
                    <dd><input type="password" class="text" name="re_pass" id="re_pass" /><div class="form-error"></div></dd>
                </dl>
                <?php endif; ?>
            </fieldset>
            <dl>
                <dt></dt>
                <dd>
                    <input type="button" class="submit" value="确定"  onclick="chk_yzm();"/>
                </dd>
            </dl>
        </form>
    </div>
</div>
<script>
    function getyzm(){
        tiktok();
        var val = "<?php echo $this->_tpl_vars['de']['pay_mobile']; ?>
";
        var url = '<?php echo $this->_tpl_vars['config']['web_url']; ?>
/ajax_back_end.php';
        var sj = new Date();
        var pars = 'shuiji=' + sj +'&mobile='+val;
        $.post(url, pars, function (originalRequest){
            //alert(originalRequest);
        })
    }
    var wait=60;
    function tiktok(){
        if (wait == 0) {
            $(".button").val("获取验证码");
            $(".button").attr("disabled",false);
            $(".button").css("background","#ff5c5c");
            wait = 60;
        } else {
            $(".button").val("再次发送(" + wait + ")");
            $(".button").attr("disabled",true);
            $(".button").css("background","#ccc");
            wait--;
            setTimeout(function(){tiktok()},1000);
        }
    }
    function chk_yzm(){
        var flag = true;
        var yzm = $("#yzm").val();
        if(yzm){
            var url = '<?php echo $this->_tpl_vars['config']['web_url']; ?>
/ajax_back_end.php';
            var sj = new Date();
            var pars = 'shuiji=' + sj+'&yzm='+yzm;
            $.get(url, pars, function(originalRequest){
                //alert(originalRequest);
                if(originalRequest){
                    $("#yzm").siblings(".form-error").html("<label for='yzm' generated='true' class='error'>验证码错误，请重新输入</label>");
                    $("#yzm").focus();
                    flag = false;
                }else{
                    $("#yzm").siblings(".form-error").html("");
                }
            })
        }else{
            $("#yzm").siblings(".form-error").html("<label for='yzm' generated='true' class='error'>请输入验证码</label>");
            $("#yzm").focus();
            flag = false;
        }
        if(flag){
            if(!$("#pass").val()){
                $("#pass").next().html("<label for='pass' generated='true' class='error'>请输入支付密码。</label>");
            }
            else if(!$("#re_pass").val()){
                $("#re_pass").next().html("<label for='re_pass' generated='true' class='error'>请确认支付密码。</label>");
            }
            else{
                $("#form").submit();
            }
        }
    }
</script>