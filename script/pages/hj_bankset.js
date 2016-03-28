/**
 * 用户注册
 * @author LiXiongXiong
 * @method hjCertify
 * 
 */
define(["module", "formValid", "utility"], function(module, formValid, Util) {
    "use strict";

    function hjCertify() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    hjCertify.prototype.init = function(){
        utility.inputFocus(".inputFocus");
    }
    /**
     * 表单操作控制
     * @param  {String} form       操作的表单
     * @param  {String} btn        发送验证码按钮
     * @param  {String} sec        验证等待时间
     * @param  {String} url        验证码发送接口地址
     * @param  {String} phoneInput 手机号input框
     * @return {[type]}            [description]
     */
    hjCertify.prototype.formSubmit = function(form, btn) {
            var _self = this,bankInput = $(form).find("input[name='bank']");
            _self.isTap = true;
            window.isSending = true;
            var bankInputVal = bankInput.val();
            if(bankInputVal != "" && bankInputVal != undefined){
                bankInputVal = bankInputVal.replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
                bankInput.val(bankInputVal);
            }
            bankInput.keyup(function(){
                var _this = $(this);
                var _val=_this.val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");  
                _this.val(_val);
            });
            $(btn).on("tap", function() {
                var _href = $(this).attr("data-href");
                if (window.isSending) {
                    window.isSending = false;
                    var username = $(form).find("input[name='realname']").val(),
                        userid = $(form).find("input[name='card_id']").val(),
                        bankName = $(form).find("input[name='bank_code']").val(),
                        bankcode = $(form).find("input[name='bank']").val(),
                        reservePhone = $(form).find("input[name='reserve_phone']").val(),
                        postdata = {};
                        bankcode = bankcode.replace(/\s/g,"");
                    var isMobileValid = formValid.isMobile(reservePhone);
                    var isBankNoValid = formValid.isBankNo(bankcode);
                    var isCardNoValid = formValid.isCardNo(userid);
                    var isRealNameValid = formValid.isRealName(username);
                    if(bankName == "" || bankName == undefined){
                        utility.tipsWarn("请选择银行！", 3000);
                        window.isSending = true;
                        return false;
                    }
                    if (isRealNameValid && isCardNoValid && isBankNoValid && isMobileValid) {
                        postdata = {
                            realname: username,
                            card_id: userid,
                            bank_code:bankName,
                            bank: bankcode,
                            reserve_phone: reservePhone
                        }
                        $.ajax({
                            url: '/ajax/users/bankset',
                            type: 'POST',
                            timeout: 100000,
                            dataType: 'json',
                            data: postdata,
                            beforeSend: function() {
                                utility.hjLoading("#wrapper");
                            },
                            success: function(data) {
                                window.isSending = true;
                                if (data != "" && data != undefined) {
                                    if (data.statusCode == 200) {
                                        utility.tipsWarn("绑卡成功，跳转中...", 3000);
                                        setTimeout(function() {
                                            window.location.href = _href;
                                        }, 500);

                                        // var phoneStr = utility.subString(reservePhone, 7);
                                        // var sendcodeBox = '<div class="form_2"><ul>\
                                        //                        <li class="alg_c">已向尾号：' + phoneStr + '的手机号<br>发送短信验证码</li>\
                                        //                        <li><input type="text" id="verify_code" name="verify_code" placeholder="请输入6位验证码"><b id="code_send" class="code_send yes">获取验证码</b></li>\
                                        //                        <li><div class="y_btn" id="bank_set_success">确定</div></li>\
                                        //                    </ul>\
                                        //                    </div>';
                                        // //短信验证控制
                                        // utility.dialogFn("bankset_box", "请输入短信验证码", sendcodeBox,false);
                                        // sendYiBaoCode("#code_send", 90);
                                        // $("#code_send").on("tap", function() {
                                        //         var _this = this;
                                        //         if (_self.isTap) {
                                        //             _self.isTap = false;
                                        //             $.ajax({
                                        //                 url: '/ajax/users/bankset',
                                        //                 type: 'POST',
                                        //                 dataType: 'json',
                                        //                 data: postdata,
                                        //                 success: function(data) {
                                        //                     if (data != "" && data != undefined) {
                                        //                         if (data.statusCode == 200) {
                                        //                             sendYiBaoCode(_this, 90);
                                        //                         } else {
                                        //                             _self.isTap = true;
                                        //                             utility.tipsWarn(data.message, 3000);
                                        //                         }
                                        //                     } else {
                                        //                         _self.isTap = true;
                                        //                         utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                                        //                     }
                                        //                 },
                                        //                 error: function(data) {
                                        //                     _self.isTap = true;
                                        //                     utility.tipsWarn(data.message, 3000);
                                        //                 }
                                        //             });
                                        //         }
                                        //     })
                                        //     //短信验证码提交
                                        // var bankSetSuccess = $("#bank_set_success");
                                        // bankSetSuccess.on("tap", function() {
                                        //     var verifyCode = $("#verify_code").val();
                                        //     if (verifyCode != "" && verifyCode != undefined) {
                                        //         postdata.verify_code = verifyCode;
                                        //         $.ajax({
                                        //             url: '/ajax/users/bankset_sure',
                                        //             type: 'POST',
                                        //             dataType: 'json',
                                        //             data: postdata,
                                        //             beforeSend: function() {
                                        //                 utility.hjLoading("body");
                                        //             },
                                        //             success: function(data) {
                                        //                 if (data != "" && data != undefined) {
                                        //                     if (data.statusCode == 200) {
                                        //                         utility.tipsWarn("绑卡成功，跳转中...", 3000);
                                        //                         setTimeout(function() {
                                        //                             window.location.href = _href;
                                        //                         }, 500);
                                        //                     }
                                        //                 } else {
                                        //                     utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                                        //                 }
                                        //             },
                                        //             complete: function() {
                                        //                 utility.hjLoadingClose("#loading_box");
                                        //             },
                                        //             error: function(data) {
                                        //                 utility.tipsWarn(data.message, 3000);
                                        //             }
                                        //         });
                                        //     } else {
                                        //         utility.tipsWarn("短信验证码不能为空", 3000);
                                        //     }
                                        // });
                                    } else {
                                        window.isSending = true;
                                        utility.hjLoadingClose("#loading_box");
                                        utility.tipsWarn(data.message, 3000);
                                    }
                                } else {
                                    window.isSending = true;
                                    utility.hjLoadingClose("#loading_box");
                                    utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                window.isSending = true;
                                console.log(jqXHR + "||||" + textStatus);
                                utility.hjLoadingClose("#loading_box");
                            }
                        })
                    } else {
                        window.isSending = true;
                        console.log("fail");
                    }
                } else {
                    console.log("请求中...");
                }
            });
            setTimeout(function() {
                window.isSending = true;
            }, 10000);

            function sendYiBaoCode(btn, sec) {
                _self.isTap = false;
                $(btn).removeClass("yes").addClass("no").html('<var>' + sec + '</var>s后重发');
                var timer = setInterval(function() {
                    sec--;
                    if (sec < 0) {
                        clearInterval(timer);
                        _self.isTap = true;
                        $(btn).removeClass("no").addClass("yes").html("重发验证码");
                    } else {
                        _self.isTap = false;
                        $(btn).find("var").html(sec);
                    }
                }, 1000);
            }
        }
        /**
         * 页面进出效果控制
         * @param  {string} extendWrap Ajax load 的页面Dom
         * @return {[type]}  [description]
         */
    hjCertify.prototype.pageEffect = function(title, extendWrap) {
            var _self = this;
            var extendWrapContent = $("body").find(".extend_content").html();
            _self.isTap = true;
            var $extendWrap = $(extendWrap);
            $extendWrap.find("#extend_wrap_content").html(extendWrapContent);
            $extendWrap.find("#extend_wrap_title").html(title);
            $(".extend_swicth").on("tap", function() {
                var _this = $(this);
                var _thisData = _this.attr("data-code");
                var _thisName = _this.attr("data-name");
                var _status = $extendWrap.attr("data-status");
                if (_self.isTap) {
                    _self.isTap = false;
                    if (_status == "off") {
                        $extendWrap.show();
                        _self.setExtendOn($extendWrap);
                        $("#header_logo").attr("href", "javascript:void(0);");
                        $("#go_back").attr("href", "javascript:void(0);");
                        utility.otherIscroll("#extend_wrapper");
                    } else {
                        if(_thisData != "" && _thisData != undefined) {
                            $("#bank_name").addClass("c_1").html(_thisName);
                            $("#bank_code").val(_thisData);
                        }
                        _self.setExtendOff($extendWrap);
                        setTimeout(function() {
                            $("#header_logo").attr("href", "/");
                            $("#go_back").attr("href", "javascript:window.history.go(-1)");
                            $extendWrap.hide();
                        }, 600);
                    }
                    setTimeout(function() {
                        _self.isTap = true;
                    }, 500);
                }
            })
        }
        /**
         * 设置层显示状态
         * @param {string} extend 划出层
         */
    hjCertify.prototype.setExtendOn = function(extend) {
            extend.show();
            setTimeout(function() {
                extend.attr("data-status", "on").addClass('on');
            }, 100);
        }
        /**
         * 设置层隐藏状态
         * @param {string} extend 划出层
         */
    hjCertify.prototype.setExtendOff = function(extend) {
        var _self = this;
        extend.attr({
            "data-status": "off"
        }).removeClass('on');
    }
    hjCertify.prototype.spinningWheelCtrl = function(sel) {
        var _self = this;
        console.log(PROVINCELIST['A-G']);
        var letterArr = [],
            firstProvince = {};
        for (var key in PROVINCELIST) {
            letterArr.push(key);
        }
        for (var i = 0; i < PROVINCELIST['A-G'].length; i++) {
            firstProvince[i] = PROVINCELIST['A-G'][i][1];
        }
        $("#" + sel).on("tap", function() {
            SpinningWheel.addSlot(letterArr, 'Letter', 'sw_letter', 'A-G');
            SpinningWheel.addSlot(firstProvince, 'Province', 'sw_provice', '安徽');
            // SpinningWheel.addSlot(days, 'right', 12);
            SpinningWheel.setCancelAction(cancel);
            SpinningWheel.setDoneAction(done);
            SpinningWheel.open();
        })

        function done() {
            var results = SpinningWheel.getSelectedValues();
            console.log("成功");
            // document.getElementById(sel).innerHTML = 'values: ' + results.values.join(' ') + '<br />keys: ' + results.keys.join(', ');
        }

        function cancel() {
            console.log("取消");
        }
    }
    module.exports = new hjCertify();
});