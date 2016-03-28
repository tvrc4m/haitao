/**
 * 产品详情页
 * @author LiXiongXiong
 * @method hjCashStatus
 * 
 */
define(["module" , "utility"], function(module, Util) {
    "use strict";

    function hjCashStatus() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjCashStatus.prototype.init = function() {
        var _self = this;
        //进度动画
        var $pro_detail = $("#invest_pro_detail"),
            $pro_txt = $("#pro_txt"),
            $pro_line = $("#pro_line");
        var cur_index = 0;
        $pro_txt.find("li").each(function(i){ //订单进度条
            var $this = $(this);
            if($this.hasClass("step_done")){
                cur_index +=1;
            }
        })
        $pro_line.find(".inner").animate({"height":cur_index*(30 + cur_index)+'%'},1000);

        utility.textSlide("#invite_list",4000);
    };
    
    module.exports = new hjCashStatus();
});