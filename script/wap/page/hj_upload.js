/**
 * 用户上传图片
 * @author hw
 * @method hjUpload
*/
define(["module", "utility",  "/script/wap/jquery-1.8.3.min.js"], function(module, Util, jquery) {
    "use strict";
    function hjUpload() {
        this.init();
    }
    var utility = new Util();
    /**
     * 初始化   
    */
    hjUpload.prototype.init = function() {
        var _self = this;
    };
    /**
     * 上传图片功能/验证
     * @param  {String} btn        发送按钮
     * @param  {Number} sec        等待时间
     * @param  {String} url        短息接口地址
     * @param  {String} phoneInput 手机号输入框
     * @return {[type]}            [description]
    */
    hjUpload.prototype.uploadPicture = function(btn, btnInp) {
        var _self = this , dataId , isTap = true;
        $(btn).on("tap", function (e) {
            e.stopPropagation();
            e.preventDefault();
            var _this = $(this); var b = _this.parent().index();
            dataId = _this.attr("data-id");
            if(b>0){
                var c = _this.parent().prev().find("input").val();
                if(c==""){
                    utility.tipsWarn("按顺序上传图片");
                }
                else{
                    _this.parent().find("input").trigger('click');
                }
            }else{
                _this.parent().find("input").trigger('click');
            }
        });
        $(btnInp).on('change', function (e) {
            var  _this = $(this),
                stype = $(this).attr('stype'),
                rename = $(this).attr('rename'),
                fs = e.target.files || e.dataTransfer && e.dataTransfer.files;
            handleFiles(fs,stype,rename);
        })
        function handleFiles (files, stype,rename) {
            var tim = new Date(),
                day = tim.getDate(),
                year = tim.getFullYear(),
                month = tim.getMonth()+1,
                month = month < 10 ? '0' + month : month;
            for (var i = 0; i < files.length; i++) {
                var fd = new FormData();
                if (files[i].type.match('image.*')) {
                    fd.append('file', files[i])
                    if(stype != ''){
                        fd.append('stype', stype)
                    }
                    fd.append('rename', rename)
                    fd.append('fileurl', "uploadfile/member/"+year+month+day + "/")
                    sendFile(fd);
                    break;
                }
            }
        }
        function sendFile (f) {
            var uploadUrl = '/ajaxupload.php';
            $.ajax({
                url: uploadUrl,
                type: 'POST',
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                data: f,
                success: function (msg) {
                    $("input[data-id="+dataId+"]").attr("value",msg.key);
                    $("input[data-id="+dataId+"]").next().attr("src", '../'+msg.key);
                },
                error: function (msg) {
                    utility.tipsWarn("抱歉，请求错误，请刷新再试！");
                }
            });
        }
    }
    module.exports = new hjUpload();
})