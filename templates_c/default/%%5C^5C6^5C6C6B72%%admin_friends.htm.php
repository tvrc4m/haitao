<?php /* Smarty version 2.6.20, created on 2016-03-16 11:45:00
         compiled from admin_friends.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'get_num', 'admin_friends.htm', 114, false),)), $this); ?>
<style>
    .black_overlay{  display: none;  position: absolute;  top: 0%;  left: 0%;  width: 100%;  height: 100%; background-color: rgb(0, 0, 0); opacity: 0.5; z-index:1001;  -moz-opacity: 0.8;   filter: alpha(opacity=80);  }
    .white_content {  display: none;  position: absolute;  top: 25%;  left: 37%;  width: 300px;  height: 200px;  padding: 16px;  border: 1px solid orange;  background-color: white;  z-index:1002;  overflow: auto;  }
</style>
<link href="script/dialog/dialog.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="script/my_lightbox.js"></script>
<script type="text/javascript" src="script/dialog/dialog.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".hua").click(function () {

//                                ==============
                                var gid =$(this).attr('fid');
                                //var emp=$(this).html("");
                                  //alert(date);
                                $('#shows').html('');
                                $('#shows').load('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=ajax_friends_group&gid='+gid);


 //======================================
                            });


    });
</script>
<div class="path">
    <div>
    	<a href="main.php?cg_u_type=1">我的商城</a> <span>&gt;</span> 
        好友
    </div>
</div>
<script>

$(function(){

	//加关注
	$("[genre='followbtn']").live('click',function(){
		var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/ajax_update.php';
		var uname='<?php echo $_COOKIE['USER']; ?>
';
		var data_str = $(this).attr('data-param');
		var index=$(this).parent().parent().parent().parent().index();
        eval( "data_str = "+data_str);
		var pars = 'mid='+data_str.mid+'&uname='+uname+'&op=add';
		$.post(url, pars,showResponse);
		function showResponse(originalRequest)
		{
			if(originalRequest>1)
				$(".friend_list li").eq(index).find('span[id="gz_statu"]').html('成功添加');
			else if (originalRequest>0)
				$(".friend_list li").eq(index).find('span[id="gz_statu"]').html('已添加');
			else
				alert('参数传递错误，无法完成操作');
		}
	});
	//取消关注
	$("[genre='cancelbtn']").live('click',function(){
		var url = '<?php echo $this->_tpl_vars['config']['weburl']; ?>
/module/sns/ajax_update.php';
		var uname='<?php echo $_COOKIE['USER']; ?>
';
		var data_str = $(this).attr('data-param');
        eval( "data_str = "+data_str);
		var pars = 'fid='+data_str.fid+'&op=del';
		$.post(url, pars,showResponse);
		function showResponse(originalRequest)
		{
			if(originalRequest>1)
				document.location.reload();
			else
				alert('参数传递错误，无法完成操作');
		}
	});

});
</script>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
                <li class="<?php if ($_GET['type']): ?>normal<?php else: ?>active<?php endif; ?>"><a href="main.php?m=sns&s=admin_friends">我关注的</a></li>
                <li class="<?php if ($_GET['type'] == fan): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=sns&s=admin_friends&type=fan">关注我的</a></li>
            </ul>
        </div>
        <table class="table-list-style">
            
            <tbody>
            <?php if ($this->_tpl_vars['re']['list']): ?>
            <tr>
                <td style="border-top:none">
                <ul class="friend_list">
                    <?php if ($_GET['type'] != fan): ?>
                    <span style="width: 100%;height:30px;border: 1px solid #C4D5E0;float: left;">
                        <p  style="line-height: 30px;width:110px;height:30px;color: #498CD0;font-weight: 400;float: left">好友分组</p>
                        <p style="line-height: 25px;height:25px;float: left;margin-left: 550px;margin-top: 3px;">
                            移动到&nbsp;&nbsp;&nbsp;
                            <select id="btn_getValue"  name="">
                                <option value="">--组名--</option>

                                <?php $_from = $this->_tpl_vars['gronmame']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                            <option value="<?php echo $this->_tpl_vars['list']['group_id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                        </select>
                        </p>
                        <p style="line-height: 25px;height:25px;float: left;width:100px;margin-top: 3px;"> 群发信息
                            <a class="message" id="mess" href="#">&nbsp;</a>
                        </p>
                    </span>
                    <div style="width: 20%;height:900px;background: #EDF5FF;float: left;margin-top: 5px">
                    <div style="width: 70%;height: auto;margin-left: 26px;margin-top: 15px;">
                        <p class="hua" style="height: 35px;line-height: 35px;width: 80px">
                            <a href="#" fid="0" class="hua">全部好友(<?php echo $this->_tpl_vars['cou']; ?>
)</a></p>
                        <dl>
                            <?php $_from = $this->_tpl_vars['gronmame']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                        <span class="zuu">
                            <dd class="group hua" fid="<?php echo $this->_tpl_vars['list']['group_id']; ?>
">
                            <a href="#"><?php echo $this->_tpl_vars['list']['name']; ?>
(<?php echo ((is_array($_tmp=$this->_tpl_vars['list']['group_id'])) ? $this->_run_mod_handler('get_num', true, $_tmp) : get_num($_tmp)); ?>
)</a>
                            <span class="zu1" style="display:none">
                            <a  href="javascript:alertWin('修改分组','',300,180,'main.php?m=sns&s=admin_friends_group&ope=upda&editid=<?php echo $this->_tpl_vars['list']['group_id']; ?>
'); "><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/edi.png" alt="修改"></a>
                            <a  onclick="return confirm('确定删除吗');" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=admin_friends_group&delid=<?php echo $this->_tpl_vars['list']['group_id']; ?>
"><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/del.png" alt="删除"></a>
                       </span>
                        </dd></span>
                            <?php endforeach; endif; unset($_from); ?>
                        <dd  class="group hua"><a class="adds" href="#">+添加分组</a></dd>
                        </dl>
                    </div>

                    </div>
                    <script type="text/javascript">
                        $(function(){
                            /* 全选 */
                            $('.checkall').click(function(){
                                var _self = this;
                                $('.checkitem').each(function(){
                                    if (!this.disabled)
                                    {
                                        $(this).attr('checked', _self.checked);
                                    }
                                });
                                $('.checkall').attr('checked', this.checked);
                            });

                        $(function(){
                            $("#btn_getValue").change(function(){

                                var va=$(this).val();

                                var strr="";
                                $("input.checkitem:checked").each(function(){
                                    strr+=$(this).val()+",";
                                });

                                $.post('<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=sns&s=ajax_friends_group',{"id":va,"ddd":strr },function(date){
                                         //----alert(date);
                                   window.location.reload();
                                });
                            });
                        });
                            $(function(){

                                $("#mess").click(function(){
                                    var stt="";
                                    $("input.checkitem:checked").each(function(){
                                        stt+=$(this).val()+",";

//                                      stt+=stt.substring(0,stt.Length-1);
                                    });
                                    location.href = "<?php echo $this->_tpl_vars['config']['weburl']; ?>
/main.php?m=message&s=admin_message_sed&uid="+stt;
                                });
                            });

                            $(function(){
                                $(".zuu").hover(function(){
                                    var index = $(this).index();
                                   $("dd").find('span').eq(index).css('display','inline');
                                },function(){
                                    var index = $(this).index();
                                    $("dd").find('span').eq(index).css('display','none');
                                });

                            })
                            $(function(){
                                $(".nick1").hover(function(){
                                   if($(this).find('a').css("display") =="none"){

                                       $(this).find('a').css("display","inline");
                                       //alert( $(this).find('a').css("display"));
                                   }else{
                                       $(this).find('a').css("display","none");

                                   };
                                    //alert(haha);
                                });

                            })
                        });
                    </script>
                    <div style="width: 79%;height:40px;background:#EDF5FF;float: left;margin-top: 5px;margin-left: 8px;">
                        <dl>
                            <dd style="float: left;line-height: 40px;font-weight: 500;font-size: 15px;width: 10%"><input style="margin-top:14px" type="checkbox" class="checkall" name=""></dd>
                            <dd style="float: left;line-height: 40px;font-weight: 500;font-size: 15px;width: 12%">头像</dd>
                            <dd style="float: left;line-height: 40px;font-weight: 500;font-size: 15px;width: 15%">好友名称</dd>
                            <dd style="float: left;line-height: 40px;font-weight: 500;font-size: 15px;width: 15%">好友昵称</dd>
                            <dd style="float: left;line-height: 40px;font-weight: 500;font-size: 15px;width: 15%">分组</dd>
                            <dd style="float: left;line-height: 40px;font-weight: 500;font-size: 15px;width: 15%">组备注</dd>
                            <dd style="float: left;line-height: 40px;font-weight: 500;font-size: 15px;width: 18%">操作</dd>
                        </dl>
                    </div>

                    <?php endif; ?>
                    <div  id="shows">
                    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slist']):
?>
                    <?php if ($_GET['type'] == fan): ?>
                    	<li>
                        <div class="friend_img"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $this->_tpl_vars['slist']['uid']; ?>
"><img width="100" height="100" src="<?php if ($this->_tpl_vars['slist']['uimg']): ?><?php echo $this->_tpl_vars['slist']['uimg']; ?>
<?php else: ?>image/default/user_admin/default_user_portrait.gif<?php endif; ?>"></a></div>
                        <dl>
                            <dt>
                            <a class="friend_name" target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $this->_tpl_vars['slist']['uid']; ?>
"><?php echo $this->_tpl_vars['slist']['uname']; ?>
</a>
                            <a class="message" target="_blank" href="main.php?m=message&s=admin_message_sed&uid=<?php echo $this->_tpl_vars['slist']['uid']; ?>
">&nbsp;</a>
                            <em class=""></em></dt>
                        <dd class="credit"><?php if ($this->_tpl_vars['slist']['buyerpointsimg']): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/points/<?php echo $this->_tpl_vars['slist']['buyerpointsimg']; ?>
" /><?php else: ?>买家信用：<?php echo $this->_tpl_vars['slist']['buyerpoints']; ?>
<?php endif; ?></dd>
                        <dd class="area"><?php echo $this->_tpl_vars['slist']['area']; ?>
</dd>
                        <dd>
						<span id="gz_statu">
							<?php if ($this->_tpl_vars['slist']['state'] == 2): ?>
								互相关注
							<?php else: ?>
								<a class="btn2" href="javascript:void(0)" genre="followbtn" data-param="{'mid':'<?php echo $this->_tpl_vars['slist']['uid']; ?>
'}">加关注</a>
							<?php endif; ?>
						</span>
						</dd>
                        </dl>
                        </li>
                    <?php else: ?>
						<li style="width: 77%">
                            <div style="float: left;width: 76px;">
                                <input style="margin-top:15px" name="duoxuan" class="checkitem" value="<?php echo $this->_tpl_vars['slist']['id']; ?>
" type="checkbox"></div>
                            <div class="friend_img" style="margin-left: 28px;border: 1px solid #E7EFF8;border-radius: 5px 5px 5px 5px;float: left;height: 40px;padding: 1px;width: 40px;"><a target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $this->_tpl_vars['slist']['fuid']; ?>
"><img width="40" height="40" src="<?php if ($this->_tpl_vars['slist']['fuimg']): ?><?php echo $this->_tpl_vars['slist']['fuimg']; ?>
<?php else: ?>image/default/user_admin/default_user_portrait.gif<?php endif; ?>"></a></div>
                            <div style="margin-left: 40px;float: left;">
                                <p style="width: 80px;margin-left: 5px;"> <a class="friend_name" target="_blank" href="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/home.php?uid=<?php echo $this->_tpl_vars['slist']['fuid']; ?>
"><?php echo $this->_tpl_vars['slist']['funame']; ?>
</a>
                                    <em class=""></em></p>
                                <?php if ($this->_tpl_vars['slist']['buyerpointsimg']): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/points/<?php echo $this->_tpl_vars['slist']['buyerpointsimg']; ?>
" /><?php else: ?><?php echo $this->_tpl_vars['slist']['buyerpoints']; ?>
<?php endif; ?>

                                <dd class="area"><?php echo $this->_tpl_vars['slist']['province']; ?>
<?php echo $this->_tpl_vars['slist']['city']; ?>
</dd>
                            </div>
                            <div style="margin-left: 15px;float: left;">
                                <p style="width: 90px;margin-top: 2px;margin-left: 25px;"> <?php if (! $this->_tpl_vars['slist']['fnickname']): ?><span><a href="javascript:void(0)"  class="nicheng" nid="<?php echo $this->_tpl_vars['slist']['id']; ?>
">点我修改昵称</a></span><?php else: ?><span class="nick1"><?php echo $this->_tpl_vars['slist']['fnickname']; ?>
 <a style="display:none" href="javascript:alertWin('修改昵称','',300,150,'main.php?m=sns&s=admin_nick&ope=upda&editid=<?php echo $this->_tpl_vars['slist']['id']; ?>
'); "><img src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/edi.png" alt="修改"></span></a>
                                    <?php endif; ?></p>
                            </div>
                            <div style="margin-left: 15px;float: left;">
                                <p style="width: 60px;margin-top: 2px;margin-left: 25px;"> <?php echo $this->_tpl_vars['slist']['name']; ?>
</p>
                            </div>
                            <div style="margin-left: 5px;float: left;">
                                <p style="width: 90px;margin-top: 2px;margin-left: 40px;"> <?php echo $this->_tpl_vars['slist']['describe']; ?>
</p>
                            </div>
                            <dd style="margin-top:2px;width: 100px;float: right">
                             <span class="cancel">
                                 <a class="btn2" href="javascript:void(0)" genre="cancelbtn" data-param="{'fid':'<?php echo $this->_tpl_vars['slist']['id']; ?>
'}">取消关注</a>
                             <a class="message" target="_blank" href="main.php?m=message&s=admin_message_sed&uid=<?php echo $this->_tpl_vars['slist']['fuid']; ?>
">&nbsp;</a></span>
                            </dd>
                            </dl>
                            <hr style="width: 100%;float:left">


                        </li>
					<?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>

                    </div>
                </ul>
                </td>
            </tr>
            <?php endif; ?>
            <?php if (! $this->_tpl_vars['re']['list']): ?>
            <tr>
            	<td colspan="20" class="norecord ntb nbt">
                	<i></i><span>暂无符合条件的数据记录</span>	
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
     </div>   
</div>
<script>
    $(".adds").click(function(){
        alertWin('添加分组', '', 300, 180, 'main.php?m=sns&s=admin_friends_group');
        return false;
    })
    $('.nicheng').click(function(){
        var data = $(this).attr('nid');
       alertWin('添加昵称', '', 300, 150, 'main.php?m=sns&s=admin_nick&nid='+data);
    })
</script>