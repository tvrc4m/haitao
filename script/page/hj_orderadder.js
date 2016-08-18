/**
 * 找回提现密码
 * @author LiXiongXiong
 * @method hjReal
 * 
 */
define(["module", "formValid"], function(module, formValid) {
    "use strict";

    function hjOrderadder() {
        this.init();
    }
    var formValid = new formValid();
    /**
     * 初始化页面
     */
    hjOrderadder.prototype.init = function() {
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
    hjOrderadder.prototype.formCtrl = function(form, subBtn) {
        formValid.init(form);
        $(subBtn).on("tap", function() {
            var addressVal = $(form).find("input[name=address]").val(),
                // select3Val = $(form).find("select[name='select_3']").val(),
                // select2Val = $(form).find("select[name='select_2']").val(),
                // select1Val = $(form).find("select[name='select_1']").val(),
                mobileVal = $(form).find("input[name=mobile]").val(),
                nameVal = $(form).find("input[name=name]").val();

            var isNullValid = formValid.isNull(addressVal ,"请填写街道地址");
            // var isZero3Valid = formValid.isZero(select3Val ,"请选择区县");
            // var isZero2Valid = formValid.isZero(select2Val ,"请选择城市");
            // var isZero1Valid = formValid.isZero(select1Val ,"请选择省份"); 
            var isMobileValid = formValid.isMobile(mobileVal);  
            var isRealNameValid = formValid.isRealName(nameVal);

            if (isRealNameValid && isMobileValid && isNullValid) {
                $(form).submit();
            }
        })
    }
    hjOrderadder.prototype.checker = function(obj) {
        $(obj).on("tap", function() {
            var _this = $(this);
            if (_this.hasClass("seled")) {
                _this.removeClass("seled");
            } else {
                _this.addClass("seled");
            }
        });
    }
    module.exports = new hjOrderadder();
});