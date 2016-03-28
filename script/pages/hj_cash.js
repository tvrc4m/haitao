/**
 * 用户注册
 * @author LiXiongXiong
 * @method hjCash
 * 
 */
define(["module", "formValid", "utility"], function(module, formValid, Util) {
    "use strict";

    function hjCash() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjCash.prototype.init = function() {
        utility.inputFocus("#cash_num",250);
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
    hjCash.prototype.formSubmit = function(form, btn) {
        var cashInput = $(form).find("input[name='cashNum']");
        formValid.mustDigital(cashInput,true,"请输入正确的提现金额");
        $(btn).on("tap", function() {
            var _this = $(this);
            if(_this.hasClass('no')){
                return false;
            }
            var cashNumVal = $(form).find("input[name='cashNum']").val(),
                moneyRealVal = $(form).find("input[name='money_real']").val(),
                cashTimesVal = parseFloat($(form).find("input[name='can_cash_times']").val()),
                postdata = {};
            moneyRealVal = parseFloat(utility.formatNumber(moneyRealVal));
            if (cashNumVal != "" && cashNumVal != undefined) {
                var isDigitalSure = formValid.isDigital(cashNumVal, "请输入正确的提现金额", true);
                if (isDigitalSure) {
                    var dotPos = cashNumVal.indexOf("."),dotTxt;
                    if (dotPos != -1) {
                        dotTxt = utility.subString(cashNumVal, dotPos + 1);
                        if (dotTxt.length > 2) {
                            utility.tipsWarn("提现金额只能保留小数点后两位", 3000);
                            return false;
                        }
                    }
                    if(moneyRealVal == 0){
                        utility.tipsWarn("您的可提现余额为0!", 3000);
                        return false;
                    }
                    if (moneyRealVal <= 100 && moneyRealVal > 0) {
                        if (moneyRealVal != cashNumVal) {
                            utility.tipsWarn("余额小于100时需全部提现", 3000);
                            $(form).find("input[name='cashNum']").attr("value", moneyRealVal).val(moneyRealVal);
                            cashNumVal = parseFloat($(form).find("input[name='cashNum']").val());
                        }
                    }
                    if (cashNumVal > moneyRealVal) {
                        utility.tipsWarn("提现金额超出余额", 3000);
                        return false;
                    }
                    if (cashTimesVal <= 0) {
                        utility.tipsWarn("今日提现次数达到上限", 3000);
                        return false;
                    }
                    cashInput.blur();
                    postdata.cashNum = cashNumVal;
                    var sendCashPwd = '<div class="form_2"><ul>\
                                           <li class="alg_c">提现' + cashNumVal + '元</li>\
                                           <li class="inp_bor"><input type="password" name="cash_pass" placeholder="请输入提现密码"></li>\
                                           <li><div class="y_btn" id="cash_pwd_sub">提交</div></li>\
                                       </ul>\
                                       </div>';
                    //短信验证控制
                    utility.dialogFn("cash", "请输入提现密码", sendCashPwd,true);
                    $("#cash_pwd_sub").on("tap", function() {
                            var cashPass = $("input[name=cash_pass]").val();
                            if (cashPass != "" && cashPass != undefined) {
                                var isCashPass = formValid.isPwd(cashPass);
                                if (isCashPass) {
                                    postdata.cash_pass = cashPass;
                                    $.ajax({
                                        url: '/ajax/cash/cash_sure',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: postdata,
                                        beforeSend: function() {
                                            utility.hjLoading("body");
                                        },
                                        success: function(data) {
                                            if (data != "" && data != undefined) {
                                                if (data.statusCode == 200) {
                                                    utility.tipsWarn("提现申请成功", 3000);
                                                    setTimeout(function() {
                                                        window.location.href = data.content.jump_url;
                                                    }, 500);
                                                } else {
                                                    utility.tipsWarn(data.message, 3000);
                                                }
                                            } else {
                                                utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                                            }
                                        },
                                        complete: function() {
                                            utility.hjLoadingClose("#loading_box");
                                        },
                                        error: function(data) {
                                            utility.tipsWarn(data.message, 3000);
                                        }
                                    });
                                }
                            } else {
                                utility.tipsWarn("提现密码不能为空", 3000);
                            }
                        })
                        // $(form).submit();
                } else {
                    console.log("fail");
                }
            } else {
                utility.tipsWarn("请输入提现金额", 3000);
            }
        });
    }
    module.exports = new hjCash();
});