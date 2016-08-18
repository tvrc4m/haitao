/**
 * 找回提现密码
 * @author LiXiongXiong
 * @method hjReal
 * 
 */
define(["module", "formValid"], function(module, formValid) {
    "use strict";

    function hjApply() {
        this.init();
    }
    var formValid = new formValid();
    /**
     * 初始化页面
     */
    hjApply.prototype.init = function() {
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
    hjApply.prototype.formCtrl = function(form, subBtn ,btn ,btnInp ,apply_txaa, limit_num, num) {
        formValid.init(form);
        formValid.limitWord(apply_txaa, limit_num, num);
        formValid.uploadPicture(btn ,btnInp);
        $(subBtn).on("tap", function() {
            var reasonTypeVal = $(form).find("select[name='reason_type']").val(),
                reasonVal = $(form).find("textarea[name='reason']").val(),
                InpimgVal = $(form).find(".logo_show input[type=hidden]").val();

            var isNull2Valid = formValid.isNull(InpimgVal ,"请上传凭证!"); 
            var isNullValid = formValid.isNull(reasonVal ,"请填写退款说明!");   
            var isZeroValid = formValid.isZero(reasonTypeVal ,"请选择退款原因!");

            if (isZeroValid && isNullValid && isNull2Valid) {
                $(form).submit();
            }
        })
    }
    module.exports = new hjApply();
});