/**
 * 页面公用模块
 * @author LiXiongXiong
 * @method hjBase
 * 
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjBase() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjBase.prototype.init = function() {
        var _self = this;

        /**返回判断*/
        var history = window.history.length;
        var $goBack = $("#go_back");
        var his = $goBack.attr("data-href");

        _self.share();
        utility.pScroll("#wrapper",'2.2',true);
        utility.scrollToEle();

        /*是否加载base*/
        window.isAlload = true;

        $(function() {
            $("footer").show();
            if(utility.isPhone()){
                $("#wrapper").find("a").on("tap", function() {
                    $(this).trigger("click");
                })
                $(".scroller").find("a").on("tap", function() {
                    $(this).trigger("click");
                });
            }else{
                $(document).find("*").not("a").each(function(){
                    var _this = $(this);
                    _this.click(function(e){
                        e.stopPropagation();
                        $(this).trigger("tap");
                    });
                });
                $("body").delegate(".dia_btn","click",function(){
                    $(this).trigger("tap");
                })
                $("#y_menu_icon").click(function(e){
                    e.stopPropagation();
                    $(this).trigger("tap");
                });
            }
        });
        document.addEventListener('touchmove', function(e) {
            e.preventDefault();
        }, false);
    }
    hjBase.prototype.share = function() {
            $(".hj_share_btn").on("tap", function() {
                var _vcode = $(this).attr("data-vcode");
                utility.hjShare("body",_vcode);
            })
        }
        /**
         * 页面提示
         * @param  {String} str  提示文字
         * @param  {Number} time 显示时长
         * @return {[type]}      [description]
         */
    hjBase.prototype.tipsWarnFn = function(str, time) {
            utility.tipsWarn(str, time);
        }
        
    /**
     * [wxShare description]
     * @param  {[type]} appid     [description]
     * @param  {[type]} timestamp [description]
     * @param  {[type]} nonceStr  [description]
     * @param  {[type]} signature [description]
     * @param  {[type]} img       [description]
     * @param  {[type]} link      [description]
     * @param  {[type]} desc      [description]
     * @param  {[type]} title     [description]
     * @return {[type]}           [description]
     */
    hjBase.prototype.wxShare = function(appid,timestamp,nonceStr,signature,img,link,desc,title,qtil){
        utility.weixinShare(appid,timestamp,nonceStr,signature,img,link,desc,title,qtil);
    }
    module.exports = new hjBase();
});