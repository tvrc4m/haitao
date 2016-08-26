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
    }
    hjBase.prototype.share = function() {
        utility.hjShare("body");
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