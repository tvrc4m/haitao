/**
 * 产品详情页 投资控制
 * @author LiXiongXiong
 * @method hjDetail
 * 
 */
define(["module", "formValid", "utility"], function(module, formValid, Util) {
    "use strict";

    function hjDetail() {
        this.init();
    }
    var formValid = new formValid();
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjDetail.prototype.init = function() {
        utility.inputFocus(".inputFocus");
        utility.tab("#clu_1_nav","#clu_1_con");
        utility.historyHandler("#go_back","/invest/process","/invest/lister");
    };
    hjDetail.prototype.countTimeFn = function(str,btn,text){
        utility.countTime(str, btn, text);
    }
    /**
     * investHandler 立即投资控制
     * @param  {String} form       投资表单
     * @param  {String} btn        提交按钮
     * @param  {String} balanceNum 余额隐藏input
     * @param  {String} minAmount  最小起投金额input
     * @return {[type]}            [description]
     */
    hjDetail.prototype.investHandler = function(form, btn, balanceNum, minAmount, need_account) {
            var investInput = $(form).find("input[name='money_num']"),$earMoney = $("#earMoney");
            
            var balanceVal = $(balanceNum).val(),
                minAmountVal = $(minAmount).val(),
                needAccountVal = $(need_account).val(),
                pRateVal = $(form).find("input[name=p_rate]").val(),
                pDaysVal = $(form).find("input[name=p_days]").val(),
                earWmoney = $earMoney.attr("data-ear"),
                _isnew = investInput.attr("data-isnew"),
                _iscash = investInput.attr("data-iscash");
            balanceVal = utility.formatNumber(balanceVal);
            needAccountVal = utility.formatNumber(needAccountVal);
            formValid.mustDigital(investInput, false, "投资金额需为整数");
            //剩余可投 起投金额判断
            if ((needAccountVal - minAmountVal) < 0 && Math.abs(needAccountVal - minAmountVal) < minAmountVal) {
                investInput.val(needAccountVal);
                investInput.on("change", function() {
                    var _this = $(this);
                    if (_this.val() > needAccountVal) {
                        utility.tipsWarn("剩余可投金额为" + needAccountVal + "元", 3000);
                        _this.val(needAccountVal);
                    }
                })
            }
            investInput.on("keydown", function() {
                var _this = $(this);
                var _val = _this.val();
                if(needAccountVal - _val < 0 ){
                    utility.tipsWarn("剩余可投金额为" + needAccountVal + "元", 3000);
                    _this.val(needAccountVal);
                    return false;
                }
            })
            investInput.on("keyup", function() {
                var _this = $(this);
                var _val = _this.val();
                if(needAccountVal - _val < 0 ){
                    utility.tipsWarn("剩余可投金额为" + needAccountVal + "元", 3000);
                    _this.val(needAccountVal);
                    _val = needAccountVal;
                }
                var earMoney = utility.CalculateEarnings(_val, pRateVal, pDaysVal).toFixed(2);
                var cashMoney = utility.CalculateCashNum(_val,0.01).toFixed(2);
                var mTips = "预期收益"+earMoney+"元 <b class='c_3'>返现"+cashMoney+"元</b>";
                var mTips_default = "万元预期收益："+earWmoney+"元 <b class='c_3'>返现100元</b>";
                
                if(_iscash == "false"){
                    mTips = "预期收益"+earMoney+"元";
                    mTips_default = "万元预期收益："+earWmoney+"元";
                }

                if(_val - minAmountVal >= 0){
                    $earMoney.html(mTips);
                }else{
                    $earMoney.html(mTips_default);
                } 
            })
            $(btn).on("tap", function(e) {
                var _this = $(this);
                var _href = _this.attr("data-href"),
                    _status = _this.attr("data-status"),
                    _iscan = _this.attr("data-iscan");
                var lowInp = Number($("#card_extend").attr("data-low")),cardMoney = Number($("#card_extend").attr("data-money")),isCard = false;
                if(_isnew == "5"){
                    utility.tipsWarn("该项目为新手专享，您不能投资！", 2500);
                    return false
                }
                if(_iscan != "yes") return false;

                //现金券使用
                if(lowInp != "" && lowInp != undefined) isCard = true;


                if (_href == "" || _href == undefined) {
                    if (_status == "yes") {
                        var actionVal = $(form).find("input[name=action]").val(),
                            borrowIdVal = $(form).find("input[name=borrow_id]").val(),
                            userIdVal = $(form).find("input[name=user_id]").val(),
                            moneyNumVal = Number($(form).find("input[name=money_num]").val()),
                            cardIdVal = $(form).find("input[name=card_id]").val(),
                            cardTypeVal = $(form).find("input[name=card_type]").val();

                        var moneyNumValid = formValid.isDigital(moneyNumVal, "投资金额必须为整数数字");
                        var postdata = {};
                        if (moneyNumValid) {
                            //起投金额和剩余可投资金额  剩余可投资小于起投金额时可以低于起投金额
                            if ((needAccountVal - minAmountVal) < 0 && Math.abs(needAccountVal - minAmountVal) < minAmountVal) {
                                $(form).find("input[name=money_num]").val(needAccountVal);
                                moneyNumVal = needAccountVal;
                            } else {
                                if ((moneyNumVal - minAmountVal) < 0) {
                                    utility.tipsWarn("起投金额为" + minAmountVal + "元", 2500);
                                    return false;
                                }
                            }
                            if ((moneyNumVal - needAccountVal) > 0) {
                                utility.tipsWarn("可投资金额为" + needAccountVal + "元", 2500);
                                $(form).find("input[name=money_num]").val(needAccountVal);
                                moneyNumVal = needAccountVal;
                                return false;
                            }

                            investInput.blur();
                            //余额判断
                            if ((moneyNumVal - balanceVal) > 0) {
                                var investTipsBox = '<div class="form_2"><ul>\
                                                    <li class="alg_c"><em class="c_3">余额不足</em><br>当前可用余额为' + balanceVal + '元</li>\
                                                    <li><a href="/recharge" class="y_btn" >去充值</a></li>\
                                                </ul>\
                                                </div>';
                                utility.dialogFn("invest", "余额不足提示", investTipsBox,true);
                            } else {
                                var cardTipsTxt = "",investTipsTxt = "";
                                var eMoney = utility.CalculateEarnings(moneyNumVal, pRateVal, pDaysVal);

                                //判断现金券是否可用
                                if(isCard){
                                    if(moneyNumVal < lowInp){
                                        cardTipsTxt = "投资金额未满"+lowInp+"，现金券不可用";
                                        investTipsTxt = "";
                                        cardIdVal = "";
                                        cardTypeVal = "";
                                        
                                    }else{
                                        if((moneyNumVal + cardMoney) - needAccountVal > 0){
                                            cardTipsTxt = "支付金额+现金券金额超出剩余可投金额<br>现金券不可用";
                                            investTipsTxt = "";
                                        }else{
                                            cardTipsTxt = "投资金额为实际支付金额+现金券金额";
                                            investTipsTxt = " + "+cardMoney+"元现金券";
                                            eMoney = utility.CalculateEarnings(moneyNumVal+cardMoney, pRateVal, pDaysVal);
                                        }
                                        
                                    }
                                }
                                var investSureTips = '<div class="form_2"><ul>\
                                                    <li class="alg_c"><em class="c_3">投资' + moneyNumVal + '元'+investTipsTxt+'</em><br>预期收益' + eMoney.toFixed(2) + '元</li>\
                                                    <li class="alg_c c_2">'+cardTipsTxt+'</li>\
                                                    <li><div class="y_btn dia_btn" id="sure_btn">确认</div></li>\
                                                </ul>\
                                                </div>';
                                utility.dialogFn("sure", "投资确认", investSureTips,true);

                                postdata = {
                                    action: actionVal,
                                    borrow_id: borrowIdVal,
                                    user_id: userIdVal,
                                    money_num: moneyNumVal,
                                    card_id:cardIdVal,
                                    card_type:cardTypeVal
                                }
                                $("#sure_btn").on("tap", function() {
                                    $.ajax({
                                        url: '/ajax/borrows/tender',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: postdata,
                                        beforeSend: function() {
                                            utility.hjLoading("body");
                                        },
                                        success: function(data) {
                                            if (data != "" && data != undefined) {
                                                if (data.statusCode == 200) {
                                                    if(Number(data.message) > 0){
                                                        window.location.href = "/invest/process/" + data.message;
                                                    }else{
                                                        utility.tipsWarn("投资请求失败！", 3000);
                                                        setTimeout(function() {
                                                            window.location.reload();
                                                        }, 2000);
                                                    }
                                                }
                                                if (data.statusCode == 300) {
                                                    // if (data.content) {
                                                    //     utility.dialogFn("invest", "余额不足提示", investTipsBox);
                                                    // } else {
                                                    //     utility.tipsWarn(data.message, 3000);
                                                    // }
                                                    utility.tipsWarn(data.message, 3000);
                                                    setTimeout(function() {
                                                        window.location.reload();
                                                    }, 2000);
                                                }
                                            } else {
                                                utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                                            }
                                        },
                                        complete: function() {
                                            utility.hjLoadingClose("#loading_box");
                                        },
                                        error: function(data) {
                                            utility.hjLoadingClose("#loading_box");
                                            utility.tipsWarn("服务器请求失败，请稍后再试", 3000);
                                        }
                                    });
                                })
                            }
                        }
                    } else {
                        var investTipsBox = '<div class="form_2"><ul>\
                                            <li class="alg_c"><em class="c_3">该产品已售罄</em></li>\
                                            <li><a href="/invest/lister" class="y_btn" >产品列表</a></li>\
                                        </ul>\
                                        </div>';
                        utility.dialogFn("invest", "提示", investTipsBox,true);
                    }
                } else {
                    window.location.href = _href;
                }
            })
        }
    hjDetail.prototype.evevtExtend = function(obj){
        var isOpen = false;
        $(obj).on("tap",function(){
            var _this = $(this);
            isOpen = !isOpen;
            if(isOpen){
                _this.find(".txt_extend").show();
                _this.find(".p_switch").addClass("up");
            }else{
                _this.find(".txt_extend").hide();
                _this.find(".p_switch").removeClass("up");
            }
        })
    }
        /**
         * [rightPager description]
         * @param  {[type]} title      [description]
         * @param  {[type]} btn        [description]
         * @param  {[type]} extendWrap [description]
         * @param  {[type]} content    [description]
         * @return {[type]}            [description]
         */
    hjDetail.prototype.rightPager = function(extendWrap) {
        utility.pageRightEffect(extendWrap);
    }
    /**
     * [useCard description]
     * @param  {[type]} card [description]
     * @return {[type]}      [description]
     */
    hjDetail.prototype.useCard = function(card) {
        var $card = $(card),idInp = $("input[name=card_id]"),lowInp = $("#card_extend"),cardTips = $("#card_tips");
        var $extendWrapPage = $(".extend_wrap_page"),$extendWrap = $("#extend_wrapper");
        $extendWrap.delegate(card,"tap",function(){
            var _this = $(this);
            var id = _this.attr("data-id"),lowNum = _this.attr("data-low"),money = _this.attr("data-money");
            lowNum = lowNum.replace(new RegExp(/,/g), '');
            money = money.replace(new RegExp(/,/g), '');
            idInp.val(id);
            lowInp.attr({"data-low":lowNum,"data-money":money});
            cardTips.html("您选择了"+money+"元的现金券");
            $extendWrapPage.find(".wrap_til").css({"top":0});
            $extendWrapPage.attr({
                "data-status": "off"
            }).removeClass('on');
            setTimeout(function(){
                $extendWrapPage.hide();
            }, 500);
        })
        $extendWrap.delegate(card,"mousedown",function(){
            $(this).trigger("tap");
        })
    }
    module.exports = new hjDetail();
});