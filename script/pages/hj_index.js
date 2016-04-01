/**
 * 首页交互控制
 * @author LiXiongXiong
 * @method hjIndex
 */
define(["module", "utility"], function(module, Util) {
    "use strict";
    var $j = jQuery.noConflict();
    function hjIndex() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjIndex.prototype.init = function() {
        var _self = this;
        // window.location.hash = "#/index";
        // var wrapper = document.getElementById("wrapper");
        //侧面导航控制
        utility.textSlide("#end_pro", 3000);
        utility.appDown("#y_wrap");
        // setTimeout(function(){
        //     $("#cash_event_box").removeClass('anim');
        // }, 3200);

        // setTimeout(function(){
        //     _self.hjEvt38();
        // }, 2000)
        
    }
    hjIndex.prototype.countTimeFn = function(str, btn,text) {
            utility.countTime(str, btn, text);
        }
        /**
         * 返现倒计时活动
         * @param  {[type]} str [description]
         * @param  {[type]} obj [description]
         * @return {[type]}     [description]
         */
    hjIndex.prototype.cashEvent = function(obj) {
            var _obj = $(obj),_eleTime = _obj.find(".c_time_box"),
                _isIng, _isCur,_nowTime, _endTime, _isTimeShow, ctimmer;
            _isIng = _obj.attr("data-ising"),
                _isCur = _obj.attr("data-iscur"),
                _nowTime = Number(_obj.attr("data-now")),
                _endTime = Number(_obj.attr("data-endtime")),
                _isTimeShow = _obj.attr("data-timeshow");
            if (_isIng == "1") {
                if(_isCur == "1"){
                    timeHandler();
                    ctimmer = setInterval(function() {
                        timeHandler();
                    }, 1000);
                }else{
                    _obj.addClass("pause");
                    _eleTime.html("<em></em><b class='c_3'>"+_isTimeShow+"</b>开始");
                }
            }

            function timeHandler() {
                var _countTime, $days, $hours, $minutes, $second;
                _nowTime += 1000;
                _countTime = _endTime - _nowTime;
                if (_countTime > 0) {
                    $days = Math.floor(_countTime / (1000 * 60 * 60 * 24)),
                        $hours = Math.floor(_countTime / (1000 * 60 * 60) % 24),
                        $minutes = Math.floor(_countTime / (1000 * 60) % 60),
                        $second = Math.floor(_countTime / 1000 % 60);
                    $days = ($days > 0) ? $days + "天" : "";
                    // $hours = ($hours > 0) ? $hours+"小时" : "";
                    $minutes = ($minutes >= 0 && $minutes < 10) ? "0" + $minutes : $minutes;
                    $second = ($second >= 0 && $second < 10) ? "0" + $second : $second;
                    _eleTime.html('<em>剩余</em><span><var>'+$minutes+'</var><b>:</b><var>'+$second+'</var></span>');
                } else {
                    clearInterval(ctimmer);
                    _obj.addClass("pause");
                    _eleTime.html("<em></em><b class='c_3'>"+_isTimeShow+"</b>开始");
                }
            }
        }
        /**
         * 图片轮播控制
         * @param {string} slideBox 轮播dom
         * @param {number} tiem 间隔时间
         * @type {hjIndex}
         */
    hjIndex.prototype.hjSlide = function(slideBox, time) {
        $(slideBox).on("swipeLeft", function(e) {
            utility.stopPropagation(e);
        });
        $(slideBox).on("swipeRight", function(e) {
            utility.stopPropagation(e);
        });
        $(slideBox).swipeSlide({
            continuousScroll: true,
            lazyLoad : true,
            speed: time,
            firstCallback: function(i, sum, me) {
                me.parent().find(".dot").children().first().addClass('cur');
            },
            callback: function(i, sum, me) {
                me.parent().find(".dot").children().eq(i).addClass('cur').siblings().removeClass('cur');
            }
        });
    }
    hjIndex.prototype.hjEvt38 = function() {
        var isEvt = utility.getCookie("m_evt_38");
        var evt_38_box = '<div class="evt_38_index pos_re">\
                                <img src="/resources/images/evt_38_page.png">\
                                <a href="/activity/women_day"></a>\
                            </div>';
        if(isEvt != "open"){
            utility.dialogFn("evt_38", "", evt_38_box,true);
            $("#evt_38_open").animate({"right":"-100%"},1500);
        }

        $("#evt_38_open").on("tap",function(){
            $(this).animate({"right":"-100%"},1500);
            utility.dialogFn("evt_38", "", evt_38_box,true);
            $("#hj_dialog_evt_38").delegate(".ic_close","tap",function(){
                $("#evt_38_open").animate({"right":"0"},1500);
            })
        })
        $("#hj_dialog_evt_38").delegate(".ic_close","tap",function(){
            $("#evt_38_open").animate({"right":"0"},1500);
            utility.setCookie("m_evt_38","open",1);
        })
    }
    module.exports = new hjIndex();
});