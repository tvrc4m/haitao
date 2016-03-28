/**
 * 产品详情页
 * @author LiXiongXiong
 * @method hjUserCenter
 * 
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjUserCenter() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjUserCenter.prototype.init = function() {
        var _self = this;
        utility.appDown("#y_wrap");
        utility.textSlide("#m_notice", 3000);
    };
    module.exports = new hjUserCenter();
});