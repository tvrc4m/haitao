/**
 * 用户登陆注册找回密码
 * @author hw
 * @method hjLogin
*/
define(["module", "utility",  "formValid"], function(module, Util, formValid) {
    "use strict";
    function hjLogin() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    /**
     * 表单初始化   
    */
    hjLogin.prototype.init = function() {
        var _self = this;
        fixedInputBlur ();
        function fixedInputBlur () {
            var beforeIpt=null;
            $("input").on("focus", function (e) {
                utility.stopPropagation(e);
                beforeIpt=this;
            });
            $(document).on("tap", function (e) {
                utility.stopPropagation(e);
                if(e.target.nodeName.toLowerCase() != "input") {
                    if(beforeIpt) {
                        beforeIpt.blur();
                        beforeIpt=null;
                    }
                }
            });
        }
    };
    /**
     * 删除表单内容
     * @param  {String} form      操作的外层包裹元素
     * @param  {String} obj1      需要遍历的表单内容 
     * @param  {String} obj2      删除按钮  
     * @param  {String} obj3      删除增加类
    */
    hjLogin.prototype.formtap = function(form, obj1, obj2 ,obj3) {
        $(form).find(obj1).each(function(){
            $(this).on('input propertychange', function(){
                var val=$(this).val();
                if(val !=""){
                    $(this).parent().find(obj2).addClass(obj3);
                }
                else{
                     $(this).parent().find(obj2).removeClass(obj3);
                }           
            }); 
            $(this).on("focus",function(){
                var val=$(this).val();
                if(val !=""){
                    $(this).parent().find(obj2).addClass(obj3);
                }else{
                    $(this).parent().find(obj2).removeClass(obj3);
                }
            });
            $(this).on("blur",function(){
                $(this).parent().find(obj2).removeClass(obj3);
            });  
        });
        $(obj2).on("tap", function(){ 
            $(this).parent().find("input").val("").focus();
            $(this).removeClass(obj3);     
        });  
    }
    /**
     * 登录操作控制
     * @param  {String} form       操作的外层包裹元素
     * @param  {String} subBtn     操作提交按钮
     * @param  {String} ajaxUrl    交互接口
     * @param  {String} skipUrl    成功后跳转链接
    */
    hjLogin.prototype.loginCtrl = function(form, subBtn , ajaxUrl ,skipUrl ,connect_id) {
        $(subBtn).on("tap", function() {
            var url = skipUrl,
                connect_id = connect_id,
                userVal = $(form).find("input[name=user]").val(),
                pwdVal = $(form).find("input[name=password]").val();

            var isPwdValid = formValid.isPwd(pwdVal);
            var isMobileValid = formValid.isMobile(userVal);
            if (isMobileValid && isPwdValid) {
                $.ajax({
                    url: ajaxUrl + "?" + Math.random(),
                    type: "POST",
                    dataType: "json",
                    data: {
                        username:userVal,
                        password:pwdVal,
                        action:"login",
                        forword:url,
                        connect_id:connect_id
                    },
                    success: function(data) {
                        if(!data.url){
                            utility.tipsWarn(data.errmsg);
                        
                        }else{
                            window.location.href = data.url;  
                        } 
                    },
                    error: function() {
                        utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                    }
                })
            }
        })
    }
    /**
     * 注册操作控制
     * @param  {String} form       操作的外层包裹元素
     * @param  {String} subBtn     操作提交按钮
     * @param  {String} ajaxUrl    交互接口
     * @param  {String} skipUrl    成功后跳转链接
    */
    hjLogin.prototype.registerCtrl = function(form, subBtn , ajaxUrl, skipUrl ,connect_id) {
        $(subBtn).on("tap", function() {
            var url = skipUrl,
                connect_id = connect_id,
                mobileVal = $(form).find("input[name=mobile]").val(),
                svodeVal = $(form).find("input[name=smsvode]").val(),
                pwdVal = $(form).find("input[name=password]").val();

            var isPwdValid = formValid.isPwd(pwdVal);
            var isSMSCodeValid = formValid.isSMSCode(svodeVal);
            var isMobileValid = formValid.isMobile(mobileVal);
            var isChk = $(form).find(".chk").hasClass('seled');
            if(!isChk){
                utility.tipsWarn("注册用户需阅读并同意网站协议");
                return false;
            }

            if(isMobileValid && isSMSCodeValid && isPwdValid){
                $.ajax({
                    url: ajaxUrl + "?" + Math.random(),
                    type: "POST",
                    dataType: "json",
                    data: {
                        username:mobileVal,
                        smsvode:svodeVal,
                        password:pwdVal,
                        action:"register",
                        forword:url,
                        connect_id:connect_id
                    },
                    success: function(data) {
                        if(!data.url){
                            utility.tipsWarn(data.errmsg);
                        
                        }else{
                            window.location.href = data.url;  
                        } 
                    },
                    error: function() {
                        utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                    }
                })
            }
        })
    }
    /**
     * 找回密码操作控制
     * @param  {String} form       操作的外层包裹元素
     * @param  {String} subBtn     操作提交按钮
     * @param  {String} ajaxUrl    交互接口
     * @param  {String} skipUrl    成功后跳转链接
    */
    hjLogin.prototype.lostpassCtrl = function(form, subBtn , ajaxUrl, skipUrl) {
        $(subBtn).on("tap", function() {
            var url = skipUrl,
                mobileVal = $(form).find("input[name=mobile]").val(),
                svodeVal = $(form).find("input[name=smsvode]").val(),
                pwdVal = $(form).find("input[name=password]").val();

            var isPwdValid = formValid.isPwd(pwdVal);              
            var isSMSCodeValid = formValid.isSMSCode(svodeVal);
            var isMobileValid = formValid.isMobile(mobileVal);
  
            if (isMobileValid && isSMSCodeValid && isPwdValid) {
                $.ajax({
                    url: ajaxUrl + "?" + Math.random(),
                    type: "POST",
                    dataType: "json",
                    data: {
                        username:mobileVal,
                        smsvode:svodeVal,
                        password:pwdVal,
                        action:"lostpass",
                        forword:url
                    },
                    success: function(data) {
                        if(!data.url){
                            utility.tipsWarn(data.errmsg);
                        
                        }else{
                            window.location.href = data.url;  
                        } 
                    },
                    error: function() {
                        utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                    }
                })
            }
        })
    }
    /**
     * 发送短信验证码
     * @param  {String} isForm     判断从哪里发出的验证码
     * @param  {String} form       操作的外层包裹元素
     * @param  {String} sedBtn     操作提交按钮
     * @param  {String} ajaxUrl    交互接口
     * @param  {String} sec        发送停留时间
    */
    hjLogin.prototype.sendValidCode = function(isForm ,form, sedBtn, sec, ajaxUrl) {
        var _self = this, num = sec ,timer = null;
        var type = isForm ? isForm : "lostpass"
        $(sedBtn).on("tap",function(){
            var _this = $(this) , mobileVal = $(form).find("input[name=mobile]").val();
            
            var isMobileValid = formValid.isMobile(mobileVal);
            if (isMobileValid) {
                $.ajax({
                    url: ajaxUrl + "?" + Math.random(),
                    type: "POST",
                    dataType: "json",
                    data: {
                        username:mobileVal,
                        action:"yzCode",
                        type:type
                    },
                    success: function(data) {
                        utility.tipsWarn(data.errmsg);
                        if(data.status == '10017'){
                            _this.attr("disabled",true);
                            _this.removeClass("yes").addClass("no").html('<var>' + num + '</var>秒后重新发送');
                            timer = setInterval(function() {
                                num--;
                                if (num < 0) {
                                    clearInterval(timer);
                                    _this.attr("disabled",false);
                                    _this.removeClass("no").addClass("yes").html("发送短信验证码");
                                    num = sec;
                                } else {
                                    _this.find("var").html(num);
                                }
                            }, 1000);
                        }
                    },
                    error: function() {
                        utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                    }
                })
            }
            return false;
        });
    }
    /**
     * 协议切换状态
     * @param  {String} obj     切换按钮
    */
    hjLogin.prototype.checker = function(obj) {
        $(obj).on("tap", function() {
            var _this = $(this), icon=String("&#xe712;") ,icon2=String("&#xe738;");
            if (_this.hasClass("seled")) {
                _this.removeClass("seled");
                _this.find("i.txt_icon6").html(icon2)
            } else {
                _this.addClass("seled");
                _this.find("i.txt_icon6").html(icon)
            }
        });
    }
    /**
     * 实名认证
     * @param  {String} form       操作的外层包裹元素
     * @param  {String} subBtn     操作提交按钮
    */
    hjLogin.prototype.realCtrl = function(form, subBtn) {
        formValid.init(form);
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
                // $.ajax({
                //     url: ajaxUrl + "?" + Math.random(),
                //     type: "POST",
                //     dataType: "json",
                //     data: {
                //         username:mobileVal,
                //         smsvode:svodeVal,
                //         password:pwdVal,
                //         action:"lostpass",
                //         forword:url
                //     },
                //     success: function(data) {
                //         if(!data.url){
                //             utility.tipsWarn(data.errmsg);
                        
                //         }else{
                //             window.location.href = data.url;  
                //         } 
                //     },
                //     error: function() {
                //         utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                //     }
                // })
            }
        })
    }
    module.exports = new hjLogin();
});