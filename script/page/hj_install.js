/**
 * 用户登陆
 * @author LiXiongXiong
 * @method hjLogin
 * 
 */
define(["module", "formValid"], function(module, formValid) {
    "use strict";

    function hjInstall() {
        
    }
    var formValid = new formValid();
    /**
     * 表单操作控制
     * @param  {String} form       操作的表单
     * @param  {String} btn        发送验证码按钮
     * @param  {String} sec        验证等待时间
     * @param  {String} url        验证码发送接口地址
     * @param  {String} phoneInput 手机号input框
     * @return {[type]}            [description]
     */
    hjInstall.prototype.formCtrl = function(form, subBtn) {
        formValid.init(form);
        $(subBtn).on("tap", function() {
            var nickVal = $(form).find("input[name=user_nick]").val();
            var isNickValid = formValid.isNick(nickVal);
            if (isNickValid) {
                $(form).submit();
            }
        })
    }
    module.exports = new hjInstall();
});