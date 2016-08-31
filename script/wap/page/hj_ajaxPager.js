/**
 * Ajax异步加载更多控制
 * @author LiXiongXiong
 * @method hjAjaxPager
 * 
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjAjaxPager() {
        
    }
    var utility = new Util();
    hjAjaxPager.prototype.Pager = function(btn, ul, ajaxUrl, method, postdata, callback) {
        utility.ajaxPager(btn, ul, ajaxUrl, method, postdata, callback);
    }
    
    
    module.exports = new hjAjaxPager();
});