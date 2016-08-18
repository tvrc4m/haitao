/**
 * 产品详情页 投资确认控制
 * @author LiXiongXiong
 * @method hjDetail
 * 
 */
define(["module", "utility"], function(module, Util) {
    "use strict";

    function hjDetail() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化页面
     */
    hjDetail.prototype.init = function() {
        var _self = this;
        // window.location.hash = "#/index";
        // var wrapper = document.getElementById("wrapper");
        //侧面导航控制
        // utility.textSlide("#end_pro", 3000);
        // setTimeout(function(){
        //     $("#cash_event_box").removeClass('anim');
        // }, 3200);
        
    }
    /**
     * 收藏商品浮层提示
    */
    hjDetail.prototype.collectFn = function(btn , id, time, url ,uname) {
            $(btn).on("tap",function(){
                var _this=$(this);
                // if ('' == '') {
                //     utility.operasWarn('不能收藏自己店铺的商品！', time);
                //     return;
                // }
                // if(uname==''){
                //     utility.operasWarn('请先登录！', time);
                //     return false;
                // }
                // var url = '<{$config.weburl}>/module/sns/ajax_update.php';
                // var uname='<{$smarty.cookies.USER}>';
                // var pars = 'pid='+id+'&uname='+uname;
                // $.post(url, pars,showResponse,"json");
                // function showResponse(originalRequest){
                    // if(originalRequest.statu==1){
                        _this.find(".iconfont").addClass("org");
                        _this.find(".detail_info_love_t").text("已收藏");
                        utility.operasWarn('成功添加至我的收藏夹!', time);
                    // }
                    // else if (originalRequest.statu==0){
                    //     _this.find(".iconfont").removeClass("org");
                    //     _this.find(".detail_info_love_t").text("收藏");  
                    //     utility.operasWarn('成功取消商品收藏', time);
                    // }
                // } 
            })
        }
     /**
     * 收藏店铺浮层提示
    */
    hjDetail.prototype.favshopFn = function(btn , id, time, url ,uname) {
            $(btn).on("tap",function(){
                var _this=$(this);
                // if ('' == '') {
                //     utility.operasWarn('不能收藏自己的店铺！', time);
                //     return;
                // }
                // if(uname==''){
                //     utility.operasWarn('请先登录！', time);
                //     return false;
                // }
                // var url = '<{$config.weburl}>/module/sns/ajax_update.php';
                // var uname='<{$smarty.cookies.USER}>';
                // var pars = 'pid='+id+'&uname='+uname;
                // $.post(url, pars,showResponse,"json");
                // function showResponse(originalRequest){
                    // if(originalRequest.statu==1){
                        _this.find(".iconfont").addClass("org");
                        _this.find(".nav-c").text("已收藏");
                        utility.operasWarn('成功添加至我的收藏夹!', time);
                    // }
                    // else if (originalRequest.statu==0){
                    //     _this.find(".iconfont").removeClass("org");
                    //     _this.find(".detail_info_love_t").text("收藏");  
                    //     utility.operasWarn('成功取消店铺收藏', time);
                    // }
                // } 
            })
        }
    /**
     * 购物浮层提示
     * @method delsWarn
     * @param {String} str 提示信息
     * @param {String} obj1 删除按钮
     * @param {String} obj2 删除元素 
    */
    hjDetail.prototype.joincartFn = function(btn , id, time, url ,uname) {
            $(btn).on("tap",function(){
                var _this=$(this);
                // if ('' == '') {
                //     utility.operasWarn('不能购买自己店铺的商品！', time);
                //     return;
                // }
                var price = $('#price').html();
                var num = $('#nums').val();
                $("#cart_num").text(parseInt($('#nums').val())+parseInt($('#cart_num').text()));
                var sid = $('#sid').val();
                var pid = '<{$smarty.get.id}>';
                var dist_user_id = '<{$smarty.get.shop_id}>';
                $('#cart_show').load('<{$config.weburl}>/?m=product&s=cart&add_cart=1&price=' + price + '&nums=' + num + '&id=' + pid + '&sid=' + sid + '&dist_user_id=' + dist_user_id);
                utility.operasWarn('商品成功添加到购物车', time);
                return false;              
            })
        }
    /**
     * 立即购买提示
    */
    hjDetail.prototype.buynowFn = function(btn ,btnform, time, url, uname) {
            $(btn).on("tap",function(){
                // if('' == '') {
                //     utility.operasWarn('不能购买自己店铺的商品！', time);
                //     return;
                // }
                $(btnform).attr("action",url);
                $(btnform).submit();
            })
        }
    module.exports = new hjDetail();
});