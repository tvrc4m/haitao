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
        $(".hj_share_btn").on("tap", function() {
            var _vcode = $(this).attr("data-vcode");
            utility.hjShare("body",_vcode);
        })
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