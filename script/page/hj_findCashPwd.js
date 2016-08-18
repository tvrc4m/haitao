/**
 * 找回提现密码
 * @author LiXiongXiong
 * @method hjFindCashPwd
 * 
 */
define(["module", "formValid"], function(module, formValid) {
    "use strict";

    function hjFindCashPwd() {
        this.init();
    }
    var formValid = new formValid();
    /**
     * 初始化页面
     */
    hjFindCashPwd.prototype.init = function() {
        var _self = this;
    };
    /**
     * 表单操作控制
     * @param  {String} form       操作的表单
     * @param  {String} btn        发送验证码按钮
     * @param  {String} sec        验证等待时间
     * @param  {String} url        验证码发送接口地址
     * @param  {String} phoneInput 手机号input框
     * @return {[type]}            [description]
     */
    hjFindCashPwd.prototype.formCtrl = function(form, subbtn, btn, sec, url, phoneInput) {
        formValid.init(form);
        formValid.sendValidCode(btn, sec, url, phoneInput);
        $(subbtn).on("tap", function() {
            var mobileVal = $(form).find("input[name=mobile]").val(),
                vcodeVal = $(form).find("input[name=smsvode]").val(),
                pwdVal = $(form).find("input[name=password]").val();
                
            var isPwdValid = formValid.isPwd(pwdVal);              
            var isSMSCodeValid = formValid.isSMSCode(vcodeVal);
            var isMobileValid = formValid.isMobile(mobileVal);
            
           
            if (isMobileValid && isSMSCodeValid && isPwdValid) {
                $(form).submit();
            }
        })
    }
    module.exports = new hjFindCashPwd();
});