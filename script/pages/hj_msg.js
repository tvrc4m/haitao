/**
 * 消息详情页
 * @author LiXiongXiong
 * @method hjMsg
 * 
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjMsg() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjMsg.prototype.init = function() {
        var _self = this;
        utility.tab("#clu_1_nav","#clu_1_con");

        //标注已读
        $.ajax({
            url: "/ajax/messagelist/message_list/",
            type: 'GET',
            dataType: 'json',
            data: {page:1,is_read:2},
            success: function(data) {
                console.log("标记已读");
            },
            error: function() {
                console.log("标记已读出错");
            }
        })
    };
    module.exports = new hjMsg();
});