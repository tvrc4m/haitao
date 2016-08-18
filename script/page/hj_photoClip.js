/**
 * @brief   支持手势的裁图插件
 *          在移动设备上双指捏合为缩放，双指旋转可根据旋转方向每次旋转90度
 *          在PC设备上鼠标滚轮为缩放，每次双击则顺时针旋转90度
 * @option_param {number} width 截取区域的宽度
 * @option_param {number} height 截取区域的高度
 * @option_param {string} file 上传图片的<input type="file">控件的选择器或者DOM对象
 * @option_param {string} view 显示截取后图像的容器的选择器或者DOM对象
 * @option_param {string} ok 确认截图按钮的选择器或者DOM对象
 * @option_param {string} outputType 指定输出图片的类型，可选 "jpg" 和 "png" 两种种类型，默认为 "jpg"
 * @option_param {boolean} strictSize 是否严格按照截取区域宽高裁剪。默认为false，表示截取区域宽高仅用于约束宽高比例。如果设置为true，则表示截取出的图像宽高严格按照截取区域宽高输出
 * @option_param {function} loadStart 开始加载的回调函数。this指向 fileReader 对象，并将正在加载的 file 对象作为参数传入
 * @option_param {function} loadComplete 加载完成的回调函数。this指向图片对象，并将图片地址作为参数传入
 * @option_param {function} loadError 加载失败的回调函数。this指向 fileReader 对象，并将错误事件的 event 对象作为参数传入
 * @option_param {function} clipFinish 裁剪完成的回调函数。this指向图片对象，会将裁剪出的图像数据DataURL作为参数传入
 */
define(["module", "hammer"], function(module, hammer) {
    "use strict";

    function hjphotoClip() {
        this.init();
    }
    var hammer = new hammer();
    /**
     * 表单操作控制
     * @param  {String} form       操作的表单
     * @param  {String} btn        发送验证码按钮
     * @param  {String} sec        验证等待时间
     * @param  {String} url        验证码发送接口地址
     * @param  {String} phoneInput 手机号input框
     * @return {[type]}            [description]
     */
    hjphotoClip.prototype.formCtrl = function(form, subbtn, btn, sec, url, phoneInput) {
        formValid.init(form);
        formValid.sendValidCode(btn, sec, url, phoneInput);
        $(subbtn).on("tap", function() {
            var mobileVal = $(form).find("input[name=mobile]").val(),
                vcodeVal = $(form).find("input[name=v_code]").val(),
                pwdVal = $(form).find("input[name=password]").val(),
                rePwdVal = $(form).find("input[name=re_password]").val();

            var isRePwdValid = formValid.isRepwd(rePwdVal,pwdVal);
            var isPwdValid = formValid.isPwd(pwdVal);
            var isSMSCodeValid = formValid.isSMSCode(vcodeVal);
            var isMobileValid = formValid.isMobile(mobileVal);

        
            if (isMobileValid && isSMSCodeValid && isPwdValid && isRePwdValid) {
                $(form).submit();
            }
        })
    }
    module.exports = new hjphotoClip();
});