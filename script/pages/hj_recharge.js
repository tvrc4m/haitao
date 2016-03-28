/**
 * 充值
 * @author LiXiongXiong
 * @method hjCharge
 * 
 */
define(["module", "formValid", "utility"], function(module, formValid, Util) {
    "use strict";

    function hjCharge() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjCharge.prototype.init = function() {
        utility.inputFocus("#recharge_num",80);
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
    hjCharge.prototype.formSubmit = function(form, btn) {
        var rechargeInput = $(form).find("input[name='rechargeNum']");
        var rechargeLimit = $("#rechargeLimit").val();
        formValid.mustDigital(rechargeInput,false,"请输入正确的充值金额");
        window.isSending = true;
        $(btn).on("tap", function() {
            if (window.isSending) {
                window.isSending = false;
                var rechargeNum = Number($(form).find("input[name='rechargeNum']").val()),
                    postdata = {};
                var isDigitalSure = formValid.isDigital(rechargeNum, "充值金额必须为整数");
                if (isDigitalSure) {
                    if (rechargeNum < 100) {
                        utility.tipsWarn("充值金额必须大于100", 3000);
                        window.isSending = true;
                        return false;
                    }
                    if (rechargeNum > rechargeLimit) {
                        utility.tipsWarn("抱歉，该银行支付限额目前为"+rechargeLimit+"元", 3000);
                        $(form).find("input[name='rechargeNum']").val(rechargeLimit);
                        window.isSending = true;
                        return false;
                    }
                    rechargeInput.blur();
                    postdata = {
                        rechargeNum: rechargeNum
                    }
                    $.ajax({
                        url: '/ajax/recharge/index',
                        type: 'POST',
                        dataType: 'json',
                        data: postdata,
                        beforeSend: function() {
                            utility.hjLoading("#wrapper");
                        },
                        success: function(data) {
                            if (data.statusCode == 200) {
                                // $("body").html(data.content);
                                window.location.href = data.content;
                                // var sendcodeBox = '<div class="form_2"><ul>'
                                // if (data.content.is_need_code) {
                                //     sendcodeBox += '<li class="alg_c">已向尾号：' + data.content.phone_last + '的手机号<br>发送短信验证码</li>\
                                //         <li><input type="text" id="verify_code" name="verify_code" placeholder="请输入6位验证码"><b id="code_send" class="code_send yes">获取验证码</b></li>';
                                // }
                                // sendcodeBox += '<li><h2>确认充值' + rechargeNum + '元</h2></li>\
                                //                 <li><div class="y_btn" id="recharge_sure">确定</div></li>\
                                //               </ul>\
                                //             </div>';
                                // //短信验证控制
                                // utility.dialogFn("recharge_box", "充值提示", sendcodeBox,true);
                                // window.isSending = true;
                                // var isLen = $("#recharge_box").find("#verify_code").length;
                                // if (isLen > 0) {
                                //     sendYiBaoCode("#code_send", 90);
                                //     $("#code_send").on("tap", function() {
                                //         var _this = this;
                                //         $.ajax({
                                //             url: '/ajax/recharge/recharge_send_code',
                                //             type: 'POST',
                                //             dataType: 'json',
                                //             data: {
                                //                 order_id: data.content.order_id
                                //             },
                                //             beforeSend: function() {
                                //                 utility.hjLoading("#wrapper");
                                //             },
                                //             success: function(data) {
                                //                 if (data.statusCode == 200) {
                                //                     sendYiBaoCode(_this, 90);
                                //                 }
                                //             },
                                //             complete: function() {
                                //                 utility.hjLoadingClose("#loading_box");
                                //             },
                                //             error: function(data) {
                                //                 utility.tipsWarn(data.message, 3000);
                                //             }
                                //         });
                                //     })
                                // }
                                // //短信验证码提交
                                // var bankSetSuccess = $("#recharge_sure");
                                // bankSetSuccess.on("tap", function() {
                                //     var rechargeData = {
                                //             order_id: data.content.order_id
                                //         },
                                //         verifyCode;
                                //     if (isLen > 0) {
                                //         verifyCode = $("#verify_code").val();
                                //         if (verifyCode == "" || verifyCode == undefined) {
                                //             utility.tipsWarn("短信验证码不能为空", 3000);
                                //             return false;
                                //         }
                                //         rechargeData.verify_code = verifyCode;
                                //     }
                                //     $.ajax({
                                //         url: '/ajax/recharge/recharge_sure',
                                //         type: 'POST',
                                //         dataType: 'json',
                                //         data: rechargeData,
                                //         success: function(data) {
                                //             if (data != "" && data != undefined) {
                                //                 if (data.statusCode == 200) {
                                //                     window.location.href = "/recharge/process/" + rechargeData.order_id;
                                //                 } else {
                                //                     utility.tipsWarn(data.message, 3000);
                                //                 }
                                //             } else {
                                //                 utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                                //             }
                                //         },
                                //         error: function(data) {
                                //             utility.tipsWarn(data.message, 3000);
                                //         }
                                //     });
                                // });
                            } else {
                                window.isSending = true;
                                utility.tipsWarn(data.message, 3000);
                            }
                        },
                        complete: function() {
                            utility.hjLoadingClose("#loading_box");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            window.isSending = true;
                            utility.hjLoadingClose("#loading_box");
                            utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                        }
                    })
                } else {
                    window.isSending = true;
                    console.log("fail");
                }
            }
            setTimeout(function() {
                window.isSending = true;
            }, 10000);
        });

        function sendYiBaoCode(btn, sec) {
            $(btn).removeClass("yes").addClass("no").html('<var>' + sec + '</var>s后重发');
            var timer = setInterval(function() {
                sec--;
                if (sec < 0) {
                    clearInterval(timer);
                    $(btn).removeClass("no").addClass("yes").html("重发验证码");
                } else {
                    $(btn).find("var").html(sec);
                }
            }, 1000);
        }
    }
    module.exports = new hjCharge();
});