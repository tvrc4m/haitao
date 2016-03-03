<?php /* Smarty version 2.6.20, created on 2016-03-03 11:38:38
         compiled from member.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'member.htm', 119, false),array('modifier', 'date_format', 'member.htm', 145, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>会员管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../script/moderate.js"></script>
<script type="text/javascript" src="../script/Calendar.js"></script>
<script type="text/javascript">
var cdr = new Calendar("cdr");
document.write(cdr);
cdr.showMoreDay = true;
</script>
</head>
<body>
<div class="container">
    <div class="flow"> 
        <div class="itemtitle">
            <h3>会员管理</h3>
            <ul>
                <li class="<?php if (! $_GET['statu']): ?>current<?php else: ?>normal<?php endif; ?>"><a href="?m=member&s=member.php"><span>管理</span></a></li>
                <li class="<?php if ($_GET['statu'] == 2): ?>current<?php else: ?>normal<?php endif; ?>"><a href="?m=member&s=member.php&statu=2"><span>已审核</span></a></li>
                <li class="<?php if ($_GET['statu'] == 1): ?>current<?php else: ?>normal<?php endif; ?>"><a href="?m=member&s=member.php&statu=1"><span>待审核</span></a></li>
                <li class="<?php if ($_GET['statu'] == -2): ?>current<?php else: ?>normal<?php endif; ?>"><a href="?m=member&s=member.php&statu=-2"><span>禁止访问</span></a></li>
				<li class="<?php if ($_GET['cardnum'] == 1): ?>current<?php else: ?>normal<?php endif; ?>"><a href="?m=member&s=member.php&cardnum=1"><span>有卡会员</span></a></li>
				<li class="<?php if ($_GET['cardnum'] == -1): ?>current<?php else: ?>normal<?php endif; ?>"><a href="?m=member&s=member.php&cardnum=-1"><span>线上注册</span></a></li>
            </ul>
        </div>
    </div>
    <div class="h35"></div>
    <table class="select_table">
        <tr>
            <td>
                <div class="select_box">
                    <form action="" method="get">
                    <input type="hidden" name="m" value="member">
                    <input type="hidden" name="s" value="member.php">
                    <div class="catalogBox">
                        <input type="hidden" value="<?php if ($_GET['type']): ?><?php echo $_GET['type']; ?>
<?php else: ?>user<?php endif; ?>" name="type" id="type">
                        <div class="select">
                            <span>
                            <?php if ($_GET['type']): ?>
                                <?php $this->assign('n', $_GET['type']); ?>
                                <?php echo $this->_tpl_vars['arr'][$this->_tpl_vars['n']]; ?>

                            <?php else: ?>
                            	<?php echo $this->_tpl_vars['arr']['user']; ?>

                            <?php endif; ?></span>
                            <b></b>
                        </div>
                        <div style="display:none;" class="i-select">
                            <ul>
                                <?php $_from = $this->_tpl_vars['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                                <li key="<?php echo $this->_tpl_vars['num']; ?>
"><?php echo $this->_tpl_vars['list']; ?>
</li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </div>
                    </div>
                    <input placeholder="请输入关键字..." type="text" name="name" class="txt s w250" value="<?php echo $_GET['name']; ?>
"  />
                    <div class="catalogBox">
                        <input type="hidden" value="<?php echo $_GET['grade']; ?>
" name="grade" id="grade">
                        <div class="select">
                            <span>
                            <?php if ($_GET['grade']): ?>
                                <?php $this->assign('n', $_GET['grade']-1); ?>
                                <?php echo $this->_tpl_vars['re'][$this->_tpl_vars['n']]['name']; ?>

                            <?php else: ?>
                            	会员等级
                            <?php endif; ?></span>
                            <b></b>
                        </div>
                        <div style="display:none;" class="i-select">
                            <ul>
                                <li key="" class="sub-line">会员等级</li>
                                <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['list']):
?>
                                <li key="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['list']['name']; ?>
</li>
                                <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </div>
                    </div>
                    <input readonly="readonly" onFocus="cdr.show(this);" class="txt c w100" type="text" name="stime" id="stime" value="<?php echo $_GET['stime']; ?>
" placeholder="请输入注册时间"> 
                    <em class="fl mr5">-</em> 
                    <input readonly="readonly" onFocus="cdr.show(this);" class="txt c w100" type="text" name="etime" id="etime" value="<?php echo $_GET['etime']; ?>
" placeholder="请输入注册时间">
                    <input type="submit" value="搜索" />
                    </form>
                </div>
                <a class="refresh" href="?m=member&s=member.php"></a>
            </td>
        </tr>
    </table>
    <div style="position: relative;" id="threadlist">   
    <form action="" method="post" id="form" name="form">
    <input type="hidden" name="act" id="act" value="op" />
    <table class="table">
        <tbody>
            <tr class="header">
                <th colspan="2" class="al">操作</th>
                <th colspan="2" class="al">会员</th>
                <!--<th width="100" class="al">联系人</th>
                <th width="240" class="al">邮箱</th>
                <th width="150" class="al">手机</th>
                <th width="80" class="al">最后登陆</th>
                <th width="80" class="al">积分</th>
                <th width="100" class="al">登录</th>-->
                <th width="8%" class="al">联系人</th>
                <th width="15%" class="al">邮箱</th>
                <th width="10%" class="al">手机</th>
                <th width="15%" class="al">最后登陆</th>
                <th width="6%" class="al">积分</th>
                <th width="6%" class="al">登录</th>
            </tr>
            <?php $_from = $this->_tpl_vars['de']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            <tr>
                <td width="10"><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['userid']; ?>
" class="checkitem" onclick="tmodclick(this)" name="chk[]"></td>
                <td width="30">
                <p style="width:30px"><a href="?m=member&s=membermod.php&userid=<?php echo $this->_tpl_vars['list']['userid']; ?>
">编辑</a></p>
                <p style="width:30px"><a target="_blank" href="to_login.php?action=submit&user=<?php echo $this->_tpl_vars['list']['user']; ?>
">查看</a></p>
                </td>
                <td class="al" width="80"><img class="img" width="60" src="<?php if (((is_array($_tmp=$this->_tpl_vars['list']['logo'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 4, "") : smarty_modifier_truncate($_tmp, 4, "")) != 'http'): ?>../<?php endif; ?><?php echo $this->_tpl_vars['list']['logo']; ?>
" /></td>
                <td class="al" valign="top">
                <p>
                    <?php if ($this->_tpl_vars['list']['statu'] < 2): ?>
                        <?php $this->assign('num', $this->_tpl_vars['list']['statu']); ?>
                        [<?php echo $this->_tpl_vars['member_group'][$this->_tpl_vars['num']]; ?>
]&nbsp;
                    <?php endif; ?>
                    <b><?php echo $this->_tpl_vars['list']['user']; ?>
</b>
                    <img align="absmiddle" src="<?php echo $this->_tpl_vars['list']['pic']; ?>
" />
                </p>
                <p class="lh30">注册时间：<?php echo $this->_tpl_vars['list']['regtime']; ?>
</p>
                <p>
                <?php if ($this->_tpl_vars['list']['ww']): ?><a target="_blank" href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_tpl_vars['list']['ww']; ?>
&siteid=cntaobao&status=2&charset=utf-8"><img align="absmiddle" border="0" src="http://amos.alicdn.com/realonline.aw?v=2&uid=<?php echo $this->_tpl_vars['list']['ww']; ?>
&site=cntaobao&s=2&charset=utf-8" /></a><?php endif; ?>
                <?php if ($this->_tpl_vars['list']['qq']): ?><a target="blank" href="http://wpa.qq.com/msgrd?V=1&Uin=<?php echo $this->_tpl_vars['list']['qq']; ?>
&Site=&Menu=yes"><img align="absmiddle" border="0" src="http://wpa.qq.com/pa?p=1:<?php echo $this->_tpl_vars['list']['qq']; ?>
:4" ></a><?php endif; ?>        
                </p>
                </td>
                <td class="al"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
                <td class="al">
                <?php if ($this->_tpl_vars['list']['email_verify'] == 1): ?><img title="已验证"  align="absmiddle" src="../image/admin/icon.png" />&nbsp;<?php endif; ?>
                <?php echo $this->_tpl_vars['list']['email']; ?>

                </td>
                <td class="al">
                <?php if ($this->_tpl_vars['list']['mobile_verify'] == 1): ?><img title="已验证"  align="absmiddle" src="../image/admin/icon.png" />&nbsp;<?php endif; ?>
                <?php echo $this->_tpl_vars['list']['mobile']; ?>

                </td>
                <td>
                <p><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['lastLoginTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d&nbsp;%H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d&nbsp;%H:%M:%S")); ?>
</p>
                <p><?php echo $this->_tpl_vars['list']['ip']; ?>
</p>
                </td>
                <td><?php echo $this->_tpl_vars['list']['points']; ?>
</td>
                <td><?php if ($this->_tpl_vars['list']['statu'] != -2): ?>允许<?php else: ?>不允许<?php endif; ?></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td class="norecord" colspan="99"><i></i><span>暂无符合条件的数据记录</span></td>
            </tr>
            <?php endif; unset($_from); ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="al">每页最多显示： 10条</td>
                <td colspan="99"><div class="page"><?php echo $this->_tpl_vars['de']['page']; ?>
</div></td>
            </tr>
        </tfoot>
    </table>
    <div id="mdly" class="hidden">
        <a onclick="$('#mdly').addClass('cpd');" href="javascript:;" class="min">最小化</a>
        <label>
        <input type="checkbox" onclick="if(!($('.max')[0].innerHTML = modclickcount = checkall(this.form, 'chk'))) {$('#mdly').hide();}" name="chkall">
        全选
        </label>
        <h6>
            <span>选中</span>
            <strong class="max" onclick="$('#mdly').removeClass('cpd');">0</strong>
            <span>个会员: </span>
        </h6>
        <p>
            <a id="button" key="s1" href="javascript:;"><b>审核通过</b></a>
            <span>|</span>
            <a id="button" key="s2" href="javascript:;"><b>待审核</b></a>
        </p>
        <p>
            <a id="button" key="s3" href="javascript:;"><b>禁止访问</b></a>
        </p>
    </div>
    </form>
    </div>
</div>
<script>
$("#button").live('click',function(){
    var key=$(this).attr("key")
	$("#act").val(key);		
	$("#form")[0].submit();
	return false;
});

$(function(){
	$(".select").click(function(){ 
		var obj=$(this);
		$(this).next().slideToggle("fast",function(){
			if($(obj).next().is(":visible")){
				$(document).one('click',function(){
					$(".select").next().slideUp("fast");
				});
			}
		});
	});
	$(".i-select li").click(function(){
		var str=$(this).html();
		$(this).parent().parent().prev().prev().attr("value",$(this).attr("key"));
		$(this).parent().parent().prev().children().html(str);
	});
});
</script>
</body>
</html>