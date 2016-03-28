/**
 * 
 * @author LiXiongXiong
 * @method hjAjaxPager
 * 
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjAjaxPager() {
        
    }
    var utility = new Util();
    hjAjaxPager.prototype.Pager = function(btn, ul, ajaxUrl, method, postdata, callback,cur,loading) {
        utility.ajaxPager(btn, ul, ajaxUrl, method, postdata, callback ,cur,loading);
    }
    
    
    module.exports = new hjAjaxPager();
});