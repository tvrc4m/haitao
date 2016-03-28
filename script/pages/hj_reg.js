/**
 * 用户注册
 * @author LiXiongXiong
 * @method hjRegister
 * 
 */
define(["module", "utility", "formValid"], function(module,Util, formValid) {
    "use strict";

    function hjRegister() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjRegister.prototype.init = function() {
        var _self = this;
        utility.inputFocus(".inputFocus");
        // var wrapper = document.getElementById("wrapper");
        // new iscrollFn("#box_scroll", {
        //  top:48,
        //     up:false,
        //     pullDownHeight: 48,
        //     fadeWrap: ".fade_wrap",
        // });
        var $isCoupons = $("#isCoupons");
        var isCoupons = $isCoupons.val(),card_money = $isCoupons.attr("data-money"),card_num = $isCoupons.attr("data-card");
        if(isCoupons == "true"){
            var couponsTipsBox = '<div class="form_2"><ul>\
            <li class="alg_c">您参加了“新春纳福”活动<br>获得<em class="c_3">'+card_num+'</em>张现金券</li>\
                                <li><a href="/cards/lister" class="y_btn" >立即使用</a></li>\
                            </ul>\
                            </div>';
            utility.dialogFn("cardTips", "温馨提示", couponsTipsBox,true);
        }
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
    hjRegister.prototype.formCtrl = function(form, btn, sec, url, phoneInput) {
            formValid.init(form);
            formValid.sendValidCode(btn, sec, url, phoneInput);
            
            $("#reg_sub").on("tap",function(){
                var mobileVal = $(form).find("input[name=mobile]").val(),
                    vcodeVal = $(form).find("input[name=v_code]").val(),
                    pwdVal = $(form).find("input[name=pwd]").val(),
                    inviteCodeVal = $(form).find("input[name=invite_code]").val();

                var isInviteCodeValid = formValid.isInviteCode(inviteCodeVal);
                var isPwdValid = formValid.isPwd(pwdVal);
                var isSMSCodeValid = formValid.isSMSCode(vcodeVal);
                var isMobileValid = formValid.isMobile(mobileVal);
                var isChk = $(form).find(".chk").hasClass('seled');
                if(!isChk){
                    utility.tipsWarn("注册用户需阅读并同意网站协议");
                    return false;
                }
                if(isMobileValid && isSMSCodeValid && isPwdValid){
                    if(inviteCodeVal != "" && inviteCodeVal != undefined){
                        if(isInviteCodeValid){
                            $(form).submit();
                        }
                    }else{
                        $(form).submit();
                    }
                    
                }
            })
        }
        /**
         * checkbox 改写控制
         * @param  {String} obj div checkbox元素
         * @return {[type]}     [description]
         */
    hjRegister.prototype.checker = function(obj) {
            $(obj).on("tap", function() {
                var _this = $(this);
                if (_this.hasClass("seled")) {
                    _this.removeClass("seled");
                } else {
                    _this.addClass("seled");
                }
            });
        }
        /**
         * 页面进出效果控制
         * @param  {string} extendWrap Ajax load 的页面Dom
         * @return {[type]}  [description]
         */
    hjRegister.prototype.pageEffect = function(title, extendWrap) {
            var _self = this;
            var extendWrapContent = $("body").find(".extend_content").html();
            _self.isTap = true;
            var extendCtrl = $(".extend_swicth"),
                $extendWrap = $(extendWrap);
            $extendWrap.find("#extend_wrap_content").html(extendWrapContent);
            $extendWrap.find("#extend_wrap_title").html(title);
            extendCtrl.on("tap", function() {
                var _this = $(this);
                var _thisData = _this.attr("data-code");
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
                        _self.setExtendOff($extendWrap);
                        setTimeout(function(){
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
    hjRegister.prototype.setExtendOn = function(extend) {
            extend.show();
            setTimeout(function() {
                extend.attr("data-status", "on").addClass('on');
            }, 100);
        }
        /**
         * 设置层隐藏状态
         * @param {string} extend 划出层
         */
    hjRegister.prototype.setExtendOff = function(extend) {
        var _self = this;
        extend.attr({
            "data-status": "off"
        }).removeClass('on');
    }
    module.exports = new hjRegister();
});