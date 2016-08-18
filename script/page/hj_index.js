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
        // window.location.hash = "#/index";
        // var wrapper = document.getElementById("wrapper");
        //侧面导航控制
        utility.textSlide("#end_pro", 3000);
        // setTimeout(function(){
        //     $("#cash_event_box").removeClass('anim');
        // }, 3200);
        
    }
    /**
     * 弹出层提示
     * @method delsWarn
     * @param {String} str 提示信息
     * @param {String} obj1 删除按钮
     * @param {String} obj2 删除元素 
    */
    hjIndex.prototype.bombWarnFn = function(btn ,isform ,str ,parenthtm) {
            $(btn).on("tap",function(){
                var _this=$(this);
                if(!isform){
                    var thishtm=_this.parents(parenthtm) , data_id=_this.attr("data-id");
                }
                else{
                    var thisPar=_this.parent().find("#order_cancel_form");
                }
                utility.bombWarn(isform, str , thisPar, thishtm ,data_id);
            })
        }
    /**
     * 活动谈层提示(公共)
     * @method delsWarn
     * @param {String} str 提示信息
     * @param {String} obj1 删除按钮
     * @param {String} obj2 删除元素
    */
    hjIndex.prototype.actsWarnFn = function(imgsrc) {
            utility.actsWarn(imgsrc);
        }
    /**
    * 页面部分内容切换(公共)
     * @method tipsWarn
     * @param {String} obj 提示文字
     * @param {String} time 显示时长
    */
    hjIndex.prototype.partContentFn = function(btn1, btn2 , obj1 ,obj2) {
            utility.partContent(btn1, btn2 , obj1 ,obj2);
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
    hjIndex.prototype.scrollTopFn = function(obj) {
        utility.scrollTop(obj);
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
     * 下拉加载更多
     * @return {[type]} [description]
     */
    hjIndex.prototype.scrollMoreFn = function(swrap,ul,postdata) {
            utility.scrollMore(swrap,ul,postdata);
        }
     /**
     * tap切换显示隐藏
     */
    hjIndex.prototype.taphFn = function(htm1,obj1,htm2) {
            utility.taph(htm1,obj1,htm2);
        }
    /**
    * 购买数量选择
    * @menthod obj1 数量+元素
    * @menthod obj2 数量—元素
    * @menthod obj3 数量变化元素
    * @menthod obj4 库存量元素
    */
    hjIndex.prototype.buyNumFn = function(obj1,obj2,obj3,obj4) {
            utility.buyNum(obj1,obj2,obj3,obj4)
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