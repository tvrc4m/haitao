/**
 * 找回提现密码
 * @author LiXiongXiong
 * @method hjReal
 * 
 */
define(["module", "formValid"], function(module, formValid) {
    "use strict";

    function hjReal() {
        this.init();
    }
    var formValid = new formValid();
    /**
     * 初始化页面
     */
    hjReal.prototype.init = function() {
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
    hjReal.prototype.formCtrl = function(form, subBtn , btn ,btnInp) {
        formValid.init(form);
        formValid.uploadPicture(btn ,btnInp)
        $(subBtn).on("tap", function() {
            var usersVal = $(form).find("input[name=users]").val(),
                realVal = $(form).find("input[name=real]").val(),
                Inpimg1Val = $(form).find("input[name=img1]").val(),
                Inpimg2Val = $(form).find("input[name=img2]").val();
   
            var isNull2Valid = formValid.isNull(Inpimg2Val ,"身份证反面不能为空"); 
            var isNull1Valid = formValid.isNull(Inpimg1Val ,"身份证正面不能为空"); 
            var isCardNoValid = formValid.isCardNo(realVal);              
            var isRealNameValid = formValid.isRealName(usersVal);
            if (isRealNameValid && isCardNoValid && isNull1Valid && isNull2Valid) {
                $(form).submit();
            }
        })
    }
    module.exports = new hjReal();
});