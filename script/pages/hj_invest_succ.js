/**
 * 产品详情页
 * @author LiXiongXiong
 * @method hjInvestStatus
 * 
 */
define(["module" , "utility"], function(module, Util) {
    "use strict";

    function hjInvestStatus() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjInvestStatus.prototype.init = function() {
        var _self = this,$back = $("#go_back");
        var _thisHis = $back.attr("data-href");
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

        utility.textSlide("#invite_list_dy",4000);
        // setTimeout(function(){
        //     $back.attr({"href":_thisHis});
        // }, 800);
    };
    
    module.exports = new hjInvestStatus();
});