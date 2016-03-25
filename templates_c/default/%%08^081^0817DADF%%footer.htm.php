<?php /* Smarty version 2.6.20, created on 2016-03-25 12:01:25
         compiled from footer.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'footer.htm', 11, false),)), $this); ?>
<!--田晓宝添加-->
    <!--footer start-->
    <div class="newfooter">
        <div class="m_b_commitment">
            <div class="w"><img src="../../../uploadfile/adv/2016/b_commitment.png" alt="品质保证 全球直供 优质品牌 售后保障"></div>
        </div>
        <div class="foot">
            <div class="w">
                <i class="icon_b_logo fl"></i>
                <ul class="fl">
                    <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'ftlink', 'temp' => 'ftlink_list')), $this); ?>

                    <li>
                        <span>关注我们</span>
                        <div class="attention">
                            <a href="" title="" class="weibo">
                                <div class="dia-wb fn-hide">
                                    <img src="../../../image/default/Logo1.png" />
                                    <span>新浪微博</span>
                                    <span>mayihaitao_wb</span>
                                    <span class="focus">立即关注</span>
                                    <span class="arr"></span>
                                </div>
                            </a>
                            
                            <a href="" title="" class="weixin">
                                <div class="dia-wx fn-hide">
                                    <img src="../../../image/default/code.jpg" />
                                    <span>微信供公众号</span>
                                    <span>mayihaitao_wx</span>
                                    <span class="arr"></span>
                                </div>
                            </a>
                           
                            <div class="qq">
                                <div class="dia-qq fn-hide">
                                    <p>客服QQ：</p>
                                    <a href=""><img src="../../../image/default/qq2.png" />123456</a>
                                    <a href=""><img src="../../../image/default/qq2.png" />123456</a>
                                    <hr>
                                    <p>官方交流技术群：</p>
                                    <a href=""><img src="../../../image/default/qun.png" />123456</a>
                                    <a href=""><img src="../../../image/default/qun.png" />123456</a>
                                    <span class="arr"></span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
    <!--footer end-->
    <script type="text/javascript">
    $(".weibo").bind("mouseenter mouseleave",function(){
       $(".dia-wb").toggleClass("fn-hide");
    });
    $(".weixin").bind("mouseenter mouseleave",function(){
       $(".dia-wx").toggleClass("fn-hide");
    });
    $(".qq").bind("mouseenter",function(){
       $(".dia-qq").removeClass("fn-hide");
    });
    $(".qq").bind("mouseleave",function(){
        if(!($(".dia-qq").hasClass("fn-hide")))
       $(".dia-qq").addClass("fn-hide");
    });
</script>
</body>

</html>