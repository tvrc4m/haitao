/**
 * 表单验证方法
 * Create by hw
 */
;
define(['module', "utility"], function(module, Util) {
    /**
     * 表单验证
     * @type {Object}
     */
    function formValid() {}
    var utility = new Util();
    formValid.prototype.formObj = function(form) {
        var _self = this;
        _self.tel = $(form).find("input[name='mobile'],input[name='reserve_phone']");
        _self.pwd = $(form).find("input[name='pwd']");
        _self.repwd = $(form).find("input[name='repwd']");
        _self.sub = $(form).find("input[name='sub_btn']") || $(".sub_btn");
        _self.seat = $(form).find("input[name='seat_num']");
        _self.num = $(form).find("input[name='num']");
    }
    formValid.prototype.init = function(form) {
        // var _self = this;
        // _self.formObj(form);
        // var ml = _self.tel.length,
        //     pl = _self.pwd.length,
        //     rpl = _self.repwd.length,
        //     sl = _self.sub.length;
        // _self.tel.on("blur", function() {
        //     var v = $(this).val();
        //     _self.isMobile(v);
        // });
        // _self.pwd.on("blur", function() {
        //     var v = $(this).val();
        //     _self.isPwd(v);
        // });
        // _self.repwd.on("blur", function() {
        //     var v = $(this).val();
        //     _self.isRepwd(v);
        // });
    };
    /**
     * 手机号码验证
    */
    formValid.prototype.isMobile = function(s) {
        var _self = this;
        var patrn = /^(0|86|17951)?(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("请输入正确的手机号码！");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("手机号码不能为空！");
            return false
        }
    };
    /**
     * 密码验证
    */
    formValid.prototype.isPwd = function(s, tip) {
        var _self = this;
        var patrn = /^(?=.{6,16}$)[0-9a-zA-Z#@^&\[\]_]+$/;
        tip = tip || "密码";
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn(tip + "需为6-20个字母、数字和一些常用特殊字符");
                return false;
            } else {
                return true;
            }
        } else {
            utility.tipsWarn(tip + "不能为空！");
            return false;
        }
    };
    /**
     * 密码是否一致验证
    */
    formValid.prototype.isRepwd = function(s, pwd) {
        var _self = this;
        var patrn = /^(?=.{6,16}$)[0-9a-zA-Z#@^&\[\]_]+$/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s) || !patrn.exec(pwd)) {
                utility.tipsWarn("请输入6-20个字母、数字和一些常用特殊字符");
                return false
            } else if (s != pwd) {
                utility.tipsWarn("确认密码不一致！");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("密码不能为空！");
            return false
        }
    };
    /**
     * 验证码验证
    */
    formValid.prototype.isSMSCode = function(s) {
        var _self = this;
        var patrn = /^\d{6}$/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("请输入6位数字验证码");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("验证码不能为空！");
            return false
        }
    };
    /**
     * 昵称验证
    */
    formValid.prototype.isNick = function(s) {
        var _self = this;
        var patrn = /^[\u4e00-\u9fff\w]{6,12}$/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("请输入正确的昵称格式！");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("昵称不能为空！");
            return false
        }
    };
    /**
     * qq验证
    */
    formValid.prototype.isQq = function(s) {
        var _self = this;
        var patrn = /^[1-9]\d{4,8}$/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("请输入正确的QQ号！");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("QQ号不能为空！");
            return false
        }
    };
    /**
     * 身份证号码验证
    */
    formValid.prototype.isCardNo = function(s) {
        var _self = this;
        var patrn = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("请输入正确的身份证号码！");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("身份证号码不能为空！");
            return false
        }
    };
    /**
     * 正确的姓名格式验证
    */
    formValid.prototype.isRealName = function(s) {
        var _self = this;
        var patrn = /^[\u4E00-\u9FA5]{2,16}(?:·[\u4E00-\u9FA5]{2,16})*$/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("请输入正确的姓名格式！");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("真实姓名不能为空！");
            return false
        }
    };
    /**
     * 是否为空验证
    */
    formValid.prototype.isNull = function(s , txt) {
        var _self = this;
        if (s != "" && s != undefined) {
           return true
        } else {
            utility.tipsWarn(txt);
            return false
        }
    };
    formValid.prototype.isZero = function(s , txt) {
        var _self = this;
        if (s == 0) {
            utility.tipsWarn(txt);
            return false
           
        } else {
            return true
        }
    };
    /**
     * 邀请码验证
    */
    formValid.prototype.isInviteCode = function(s) {
        var _self = this;
        var patrn = /^(\d{8}|\d{11})$/;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("邀请码必须为8位或者11位数字！");
                return false
            } else {
                return true
            }
        }
    }
    /**
     * 银行卡号验证
    */
    formValid.prototype.isBankNo = function(s) {
        var _self = this;
        var patrn = /^(\d{16}|\d{18}|\d{19})$/;
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn("请输入正确的银行卡号格式！");
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("银行卡号不能为空！");
            return false
        }
    };
    /**
     * 金额验证
    */
    formValid.prototype.isDigital = function(s, txt, floatNum) {
        var _self = this,
            patrn;
        if (!floatNum) {
            patrn = /^\+?[1-9][0-9]*$/;
        } else {
            patrn = /^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/;
        }
        var nl = $("body").find(".next_btn").length;
        if (s != "" && s != undefined) {
            if (!patrn.exec(s)) {
                utility.tipsWarn(txt);
                return false
            } else {
                if (nl > 0) {
                    $("body").find(".next_btn").addClass("on");
                }
                return true
            }
        } else {
            utility.tipsWarn("金额不能为空！");
            return false
        }
    };
    formValid.prototype.DigitalNum = function(s, txt, floatNum) {
        var _self = this,
            patrn = new RegExp("^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$");
        if (!patrn.test(s)) {
            utility.tipsWarn(txt);
            return false
        }
    };
    /**
     * 限制数字输入
     * @param  {Object} input   input 输入框
     * @param  {Boolen} isfloat 是否可输入小数
     * @param  {String} txt     提示文字
     * @return {[type]}         [description]
     */
    formValid.prototype.mustDigital = function(input, isfloat, txt) {
            var _self = this;
            var dotTxt, dotPos;
            var ua = new utility.UA();
            if(ua.iphone && !ua.android){
                input.on("keydown", function(e) {
                    var _this = $(this);
                    var _val = _this.val();
                    if (isfloat) {
                        if (e.keyCode != 8 && e.keyCode != 190) {
                            if (e.keyCode < 48 || e.keyCode > 57) {
                                utility.tipsWarn(txt, 3000);
                                return false
                            };
                        }
                        if (_val != "" && _val != undefined) {
                            dotPos = _val.indexOf(".");
                            if (dotPos != -1) {
                                if (e.keyCode == 190) {
                                    return false
                                }
                                dotTxt = utility.subString(_val, dotPos + 1);
                                if (e.keyCode != 8) {
                                    if (dotTxt.length > 1) {
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        if (e.keyCode != 8) {
                            if (e.keyCode < 48 || e.keyCode > 57) {
                                utility.tipsWarn(txt, 3000);
                                return false
                            };
                        }
                    }
                })
                input.on("keyup", function() {
                    var _this = $(this);
                    var _nval = _this.val();
                    if (_nval == "" || _nval == undefined) {
                        _this.val("");
                        return false;
                    }
                })
            }
        }
    /**
     * 限制文字输入
    */
    formValid.prototype.limitWord = function(apply_txaa, limit_num, num) {
            var _self = this , maxChars = num;
            $(apply_txaa).on("keyup",function(){
                var textStr=$(".apply_textarea").val().toString() , timer;
                var re1=/[\x00-\xff]/g;
                var re2=/./g;
                if(textStr != ""){
                    if(re1.test(textStr)){
                        textNum=(textStr.match(re2).length)-Math.floor((textStr.match(re1).length)/2);
                    }
                    else{
                        textNum=textStr.match(re2).length;
                    }
                    var surplusNum=parseInt(maxChars-textNum);
                    $(limit_num).html(surplusNum);
                }
                else{
                    $(limit_num).html(maxChars);
                }
            })
        }
    /**
     * 发送短信验证码
     * @param  {String} btn        发送按钮
     * @param  {Number} sec        等待时间
     * @param  {String} url        短息接口地址
     * @param  {String} phoneInput 手机号输入框
     * @return {[type]}            [description]
     */
    // formValid.prototype.sendValidCode = function(btn, sec, url, phoneInput) {
    //     var _self = this;
    //     var isTap = true;
    //     $(btn).on("tap", function() {
    //         var _this = $(this);
    //         if (isTap) {
    //             isTap = false;
    //             if (_this.hasClass("yes")) {
    //                 var phone = $(phoneInput).val();
    //                 if (!_self.isMobile(phone)) {
    //                     isTap = true;
    //                     return false;
    //                 } else {
    //                     var n = sec;
    //                     var timer = null;
    //                     $.ajax({
    //                         url: url + "?" + Math.random(),
    //                         type: "POST",
    //                         dataType: "json",
    //                         data: {
    //                             phone_number: phone
    //                         },
    //                         success: function(data) {
    //                             isTap = true;
    //                             // var data = $.parseJSON(data);
    //                             if (data.statusCode == 200) {
    //                                 _this.removeClass("yes").addClass("no").html('<var>' + n + '</var>s后重发');
    //                                 timer = setInterval(function() {
    //                                     n--;
    //                                     if (n < 0) {
    //                                         isTap = true;
    //                                         clearInterval(timer);
    //                                         _this.removeClass("no").addClass("yes").html("重发验证码");
    //                                     } else {
    //                                         _this.find("var").html(n);
    //                                     }
    //                                 }, 1000);
    //                             } else {
    //                                 isTap = true;
    //                                 utility.tipsWarn(data.warnings.server);
    //                             }
    //                         },
    //                         error: function() {
    //                             isTap = true;
    //                             utility.tipsWarn("抱歉，请求错误，请刷新再试！");
    //                         }
    //                     })
    //                 }
    //             }
    //         }
    //     })
    // }
    /**
     * 上传图片功能/验证
     * @param  {String} btn        发送按钮
     * @param  {Number} sec        等待时间
     * @param  {String} url        短息接口地址
     * @param  {String} phoneInput 手机号输入框
     * @return {[type]}            [description]
     */
    formValid.prototype.uploadPicture = function(btn, btnInp) {
        var _self = this;
        var isTap = true;
        $(btn).on("tap", function (e) {
            e.stopPropagation();
            e.preventDefault();
            var _this=$(this) , b = _this.parent().index();
            a=$(this).attr("data-id");
            if(b>0){
                var c = _this.parent().prev().find("input").val();
                if(c==""){
                    utility.tipsWarn("按顺序上传凭证图片");
                }
                else{
                    _this.parent().find("input").trigger('click');
                }
            }else{
                _this.parent().find("input").trigger('click');
            }
            // _this.parent().find("input").trigger('click');
        });
        $(btnInp).on('change', function (e) {
            var stype = $(this).attr('stype');
            var rename = $(this).attr('rename');
            var fs = e.target.files || e.dataTransfer && e.dataTransfer.files;
            handleFiles(fs,stype,rename);
        })
        function handleFiles (files, stype,rename) {
            var Max_Size = 5000; //5M
            testMaxSize(files);
            function testMaxSize(file){
                if(file[0]){
                    var fileData = file[0];
                    var size = fileData.size;
                    var imgSrc = fileData.name;
                    var isAllow = false;
                    if(!size) isAllow = false;
                    var maxSize = Max_Size;
                    maxSize = maxSize * 1024;
                    isAllow = size <= maxSize;
                    if(!/\.(gif|jpg|jpeg|bmp|png)$/.test(imgSrc)){
                        utility.tipsWarn("图片类型必须是.gif,jpeg,jpg,bmp,png中的一种")
                        return false;
                    }
                    if(!isAllow){
                        utility.tipsWarn("图片大小要求低于5M");
                        return false;
                    }
                    return true;
                }
            }
            var tim = new Date();
            var day = tim.getDate();
            var year = tim.getFullYear();
            var month = tim.getMonth()+1;
            month = month < 10 ? '0' + month : month;
            for (var i = 0; i < files.length; i++) {
                var fd = new FormData();
                if (files[i].type.match('image.*')) {
                    fd.append('file', files[i])
                    if(stype != ''){
                        fd.append('stype', stype)
                    }
                    fd.append('rename', rename)
                    fd.append('fileurl', "uploadfile/member/"+year+month+day + "/")
                    sendFile(fd);
                    break;
                }
            }
        }
        function sendFile (f) {
            // var uploadUrl = '/ajaxupload.php';
            // $.ajax({
            //     url: uploadUrl,
            //     type: 'POST',
            //     contentType: false,
            //     processData: false,
            //     cache: false,
            //     data: f,
            //     success: function (e) {
            //         console.log(e)
            //         msg = JSON.parse(e);
                    $("input[name=img"+a+"]").attr("value","https://haitao-resource.b0.upaiyun.com/product/44/1469000782578f2c4e0b33d.jpg");
                    $("input[name=img"+a+"]").next().attr("src", "https://haitao-resource.b0.upaiyun.com/product/44/1469000782578f2c4e0b33d.jpg");


            //     },
            //     error: function (e) {
            //     }
            // });
        }
    }
    module.exports = formValid;
})