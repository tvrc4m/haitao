/**
 * 用户登陆
 * @author LiXiongXiong
 * @method hjLogin
 * 
 */
define(["module", "formValid"], function(module, formValid) {
    "use strict";

    function hjMyshop() {
        
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
    hjMyshop.prototype.formCtrl = function(form, subBtn ,btn ,btnInp) {
        formValid.init(form);
        formValid.uploadPicture(btn ,btnInp)
        $(subBtn).on("tap", function() {
            var mobileVal = $(form).find("input[name=mobile]").val(),
                addrVal = $(form).find("input[name=addr]").val(),
                companyVal = $(form).find("input[name=company]").val();

            var isMobileValid = formValid.isMobile(mobileVal);   
            var isNull2Valid = formValid.isNull(addrVal ,"请填写详细地址"); 
            var isNull1Valid = formValid.isNull(companyVal ,"请填写店铺名称");

            if (isNull1Valid && isNull2Valid &&isMobileValid) {
                $(form).submit();
            }
        })
    }
    module.exports = new hjMyshop();
});