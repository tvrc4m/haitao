/**
 * 首页交互控制
 * @author huwei
 * @method hjIndex
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjIndex() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjIndex.prototype.init = function() {
        var _self = this;
        // utility.textSlide("#end_pro", 3000);       
    }
    /**
     * 活动谈层提示(公共)
     * @method actsWarnFn
    */
    hjIndex.prototype.actsWarnFn = function(imgsrc) {
            utility.actsWarn(imgsrc);
        }
    /**
    * 图片延迟加载
    * @menthod scrollLoading
    * @returns {object}
    */
    hjIndex.prototype.scrollLoadingFn = function(obj) {
            utility.scrollLoading(obj);
        }
    /**
    * 返回顶部
    * @menthod scrollTop
    * @menthod obj 返回按钮元素
    * @returns {object}
    */
    hjIndex.prototype.scrollTopFn = function() {
        var addtopWarn=$("<div id='addtop' class='addtop'><a class='top' href='javascript:void(0);'></a></div>")
        $("body").append(addtopWarn)
        utility.scrollTop("#addtop");
    }
    /**
     * 字符串截取
    */
    hjIndex.prototype.SubStringFn = function(htm,obj,num,txt) {
        utility.SubString(htm,obj,num,txt);
    }
    /**
     * 手机号部分隐藏
     */
    hjIndex.prototype.mobHideFn = function(obj,htm) {
        utility.mobHide(obj,htm);
    }
    /**
     * 下拉导航
    */
    hjIndex.prototype.dropDownFn = function(obj,test) {
        utility.dropDown(obj,test);
    }
    /**
     * 倒计时
    */
    hjIndex.prototype.countDownFn = function(obj,date,time,isday) {
        utility.countDown(obj,date,time,isday);
    }
    /**
     * 图片轮播控制
     * @param {string} slideBox 轮播dom
     * @param {number} tiem 间隔时间
     * @type {hjIndex}
     */
    hjIndex.prototype.hjSlide = function(slideBox, time) {
        var imgIndex=$(".t_slide li img").size() , dot = $(".dot");
        for(var i=0;i<imgIndex;i++){
            dot.append("<span></span>")
        }
        $(".dot span").eq(0).addClass("cur");
        if(imgIndex==1){
            dot.html("");
        }
        $(slideBox).bind("swipeLeft", function(e) {
            utility.stopPropagation(e);
        });
        $(slideBox).bind("swipeRight", function(e) {
            utility.stopPropagation(e);
        });
        $(slideBox).swipeSlide({
            continuousScroll: true,
            lazyLoad : true,
            speed: time,
            firstCallback: function(i, sum, me) {
                me.find(".dot").children().first().addClass('cur');
            },
            callback: function(i, sum, me) {
                me.find(".dot").children().eq(i).addClass('cur').siblings().removeClass('cur');
            }
        });
    }
    module.exports = new hjIndex();
});