/**
 * 产品详情页
 * @author LiXiongXiong
 * @method hjTranRecords
 * 
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjTranRecords() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjTranRecords.prototype.init = function() {
        var _self = this;
        utility.tab("#clu_1_nav","#clu_1_con");
    };
    module.exports = new hjTranRecords();
});