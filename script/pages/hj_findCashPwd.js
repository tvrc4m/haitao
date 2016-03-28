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
        // var wrapper = document.getElementById("wrapper");
        // new iscrollFn("#box_scroll", {
        //  top:48,
        //     up:false,
        //     pullDownHeight: 48,
        //     fadeWrap: ".fade_wrap",
        // });
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
                vcodeVal = $(form).find("input[name=v_code]").val(),
                pwdVal = $(form).find("input[name=password]").val(),
                rePwdVal = $(form).find("input[name=re_password]").val();

            var isRePwdValid = formValid.isRepwd(rePwdVal,pwdVal);
            var isPwdValid = formValid.isPwd(pwdVal);
            var isSMSCodeValid = formValid.isSMSCode(vcodeVal);
            var isMobileValid = formValid.isMobile(mobileVal);

        
            if (isMobileValid && isSMSCodeValid && isPwdValid && isRePwdValid) {
                $(form).submit();
            }
        })
    }
    module.exports = new hjFindCashPwd();
});