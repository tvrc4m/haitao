/**
 * 用户登陆
 * @author LiXiongXiong
 * @method hjLogin
 * 
 */
define(["module", "utility", "formValid"], function(module, Util, formValid) {
    "use strict";

    function hjRegister() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    hjRegister.prototype.init = function() {
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
    hjRegister.prototype.formCtrl = function(form, subbtn, btn, sec, url, phoneInput) {
        formValid.init(form);
        formValid.sendValidCode(btn, sec, url, phoneInput);
        
        $(subbtn).on("tap",function(){
            var mobileVal = $(form).find("input[name=mobile]").val(),
                vcodeVal = $(form).find("input[name=smsvode]").val(),
                pwdVal = $(form).find("input[name=password]").val();

            var isPwdValid = formValid.isPwd(pwdVal);
            var isSMSCodeValid = formValid.isSMSCode(vcodeVal);
            var isMobileValid = formValid.isMobile(mobileVal);
            var isChk = $(form).find(".chk").hasClass('seled');
            if(!isChk){
                utility.tipsWarn("注册用户需阅读并同意网站协议");
                return false;
            }
            if(isMobileValid && isSMSCodeValid && isPwdValid){
                $(form).submit();  
            }
        })
    }
    hjRegister.prototype.checker = function(obj) {
        $(obj).on("tap", function() {
            var _this = $(this);
            if (_this.hasClass("seled")) {
                _this.removeClass("seled");
            } else {
                _this.addClass("seled");
            }
        });
    }
    module.exports = new hjRegister();
});