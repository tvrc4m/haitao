/**
 * 密码管理
 * @author LiXiongXiong
 * @method hjSetCashPwd
 * 
 */
define(["module", "formValid", "utility"], function(module, formValid, Util) {
    "use strict";

    function hjSetCashPwd() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjSetCashPwd.prototype.init = function() {};
    hjSetCashPwd.prototype.setCashPwd = function(form, btn) {
        $(btn).on("tap", function() {
            var isReset = $(this).attr("data-isreset");
            var oldPwdVal = $(form).find("input[name=old_pwd]").val() || $(form).find("input[name=old_password]").val(),
                pwdVal = $(form).find("input[name=password]").val(),
                rePwdVal = $(form).find("input[name=re_password]").val();

            //验证表单
            var pwdValid = formValid.isPwd(pwdVal);
            var rePwdValid = formValid.isRepwd(rePwdVal,pwdVal);
            if(isReset == "true"){
                //重置提现密码
                var oldwdValid = formValid.isPwd(oldPwdVal,"原密码");
                if(pwdValid && rePwdValid && oldwdValid){
                    $(form).submit();
                }
            }else{
                //设置提现密码
                if(pwdValid && rePwdValid){
                    $(form).submit();
                }
            }
        })
    }
    module.exports = new hjSetCashPwd();
});