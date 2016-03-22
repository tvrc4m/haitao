<<<<<<< HEAD
<?php /* Smarty version 2.6.20, created on 2016-03-22 20:48:46
=======
<?php /* Smarty version 2.6.20, created on 2016-03-22 20:36:25
>>>>>>> 203685991eb1322543ec3dea5c935427b1c3b5c3
         compiled from product_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'label', 'product_index.htm', 99, false),)), $this); ?>
<!--田晓宝添加-->
    <!--banner start-->
    <div class="m_banner pos_re newclear">
        <div class="ban_slider" id="ht_ban_slider">
            <div class="w guide">
                <ul>
                    <li class="on">●</li><li>●</li><li>●</li><li>●</li>
                </ul>
            </div>
           <!--<div class="ban_li">
               <ul class="slide_box">
                   <li><a href="" title=""><img src="../../../uploadfile/adv/2016/ban_01.jpg" alt=""></a></li>
                   <li><a href="" title=""><img src="../../../uploadfile/adv/2016/ban_02.jpg" alt=""></a></li>
                   <li><a href="" title=""><img src="../../../uploadfile/adv/2016/ban_03.jpg" alt=""></a></li>
                   <li><a href="" title=""><img src="../../../uploadfile/adv/2016/ban_04.jpg" alt=""></a></li>
                </ul>
            </div>
            <script type="text/javascript" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery.flexslider-min.js"></script>
            -->
            <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=1&catid=<?php echo $_GET['id']; ?>
&name=<?php echo $_GET['key']; ?>
'></script>
            <!-- <a class="prev" href="javascript:void(0)"></a>
            <a class="next" href="javascript:void(0)"></a> -->
        </div>
        <!-- <div class="w pos_ab">
            <div class="extend">
                <script src='<?php echo $this->_tpl_vars['config']['weburl']; ?>
/api/ad.php?id=30&catid=<?php echo $_GET['id']; ?>
&name=<?php echo $_GET['key']; ?>
'></script>
            </div>
        </div> -->
    </div>
    <!--banner end-->
    <!--海淘国家 start-->
    <!-- <div class="m_country_list">
        <div class="w">
            <ul class="country_nav newclear" id="country_tab_nav">
                <li class="item focu"><i class="icon_Japan"></i><span class="mid">日本馆</span></li>
                <li class="item"><i class="icon_Korea_South"></i><span class="mid">韩国馆</span></li>
                <li class="item"><i class="icon_Australia"></i><span class="mid">澳洲馆</span></li>
                <li class="item"><i class="icon_America"></i><span class="mid">美国馆</span></li>
                <li class="item"><i class="icon_Europe"></i><span class="mid">欧洲馆</span></li>
                <li class="item spe"><i class="icon_Hongkong_and_Taiwan"></i><span class="mid">港台馆</span></li>
            </ul>
            <div class="country_goods_list">
                <ul class="m_tab_con pos_re" id="country_tab_con">
                    <li class="item cur">
                        <div class="m_list m_list_01 newclear">
                            <div class="clu m_img_box w_202"><img src="../../../uploadfile/adv/2016/bg_jp_l.jpg"></div>
                            <div class="clu pos_re list_box">
                                <ul class="newclear">
                                    <li class="spe">
                                        <a href="" class="goods_img"><img src="../../../uploadfile/adv/2016/g_img.jpg" alt=""></a>
                                        <a href="" title="">乳酸鱼骨胶原蛋白粉</a>
                                        <p><var>￥180</var><s>￥235</s></p>
                                    </li>
                                    <li class="ml404">
                                        <a href="" class="goods_img"><img src="../../../uploadfile/adv/2016/g_img.jpg" alt=""></a>
                                        <a href="" title="">乳酸鱼骨胶原蛋白粉</a>
                                        <p><var>￥180</var><s>￥235</s></p>
                                    </li>
                                    <li>
                                        <a href="" class="goods_img"><img src="../../../uploadfile/adv/2016/g_img.jpg" alt=""></a>
                                        <a href="" title="">乳酸鱼骨胶原蛋白粉</a>
                                        <p><var>￥180</var><s>￥235</s></p>
                                    </li>
                                    <li>
                                        <a href="" class="goods_img"><img src="../../../uploadfile/adv/2016/g_img.jpg" alt=""></a>
                                        <a href="" title="">乳酸鱼骨胶原蛋白粉</a>
                                        <p><var>￥180</var><s>￥235</s></p>
                                    </li>
                                    <li>
                                        <a href="" class="goods_img"><img src="../../../uploadfile/adv/2016/g_img.jpg" alt=""></a>
                                        <a href="" title="">乳酸鱼骨胶原蛋白粉</a>
                                        <p><var>￥180</var><s>￥235</s></p>
                                    </li>
                                    <li>
                                        <a href="" class="goods_img"><img src="../../../uploadfile/adv/2016/g_img.jpg" alt=""></a>
                                        <a href="" title="">乳酸鱼骨胶原蛋白粉</a>
                                        <p><var>￥180</var><s>￥235</s></p>
                                    </li>
                                </ul>
                                <div class="m_img_box pos_ab"><a href="" title=""><img src="../../../uploadfile/adv/2016/ad_02.jpg" alt=""></a></div>
                            </div>
                            <div class="clu m_img_box w_202"><a href="" title=""><img src="../../../uploadfile/adv/2016/ad_01.jpg" alt=""></a></div>
                        </div>
                        <div class="pos_ab c_l_img"><img src="../../../uploadfile/adv/2016/jp_left.png" alt=""></div>
                        <div class="pos_ab c_r_img"><img src="../../../uploadfile/adv/2016/jp_right.png" alt=""></div>
                    </li>
                    <li class="item">2</li>
                    <li class="item">3</li>
                    <li class="item">4</li>
                    <li class="item">5</li>
                    <li class="item">6</li>
                </ul>
            </div>
        </div>
    </div> -->
    <!--海淘国家 end-->
    <!--商品分类 start-->
    <div class="m_goods_category">
       <?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'label', 'type' => 'cat', 'temp' => 'pro_index_01')), $this); ?>

    </div>
    <!--商品分类 end-->
    <script src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8"></script>
    
    <script type="text/javascript">
        var num = 1;
        var oLi = $(".slides li");
        var aLi = $(".guide li");
        var interval = window.setInterval(changeBanner,5000);
        function changeBanner(){
            for(var i=0;i<4;i++){
                oLi[i].style.display="none";
                if($(aLi[i]).hasClass("on"))
                $(aLi[i]).removeClass("on");
            }
            if(num > 3){
                num = 0;
                changeBanner();
            }else{
                oLi[num].style.display="";
                $(aLi[num]).addClass("on");
                num +=1;
            }
        }
    </script>