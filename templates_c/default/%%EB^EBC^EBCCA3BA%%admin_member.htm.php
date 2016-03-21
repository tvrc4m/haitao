<?php /* Smarty version 2.6.20, created on 2016-03-21 13:52:10
         compiled from admin_member.htm */ ?>
<script src="script/my_lightbox.js" language="javascript"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $this->_tpl_vars['config']['weburl']; ?>
/script/district.js" ></script>
<script>
$(function(){
	$('#form').validate({
		errorPlacement: function(error, element){
			element.nextAll('.form-error').append(error);
		},      
		rules : {
			name:{
				required:true
			}
		},
		messages : {
			name:{
				required:"请填写昵称",
			}
		}
	});
});
</script>
<div class="path">
    <div>
    	<?php if ($this->_tpl_vars['cg_u_type'] == 1): ?>
    		<a href="main.php?cg_u_type=1"><?php echo $this->_tpl_vars['lang']['my_mall']; ?>
</a> <span>&gt;</span>
        <?php else: ?>
    		<a href="main.php?cg_u_type=2"><?php echo $this->_tpl_vars['lang']['seller_center']; ?>
</a> <span>&gt;</span>
        <?php endif; ?>
        <a href="main.php?m=member&s=admin_member"><?php echo $this->_tpl_vars['lang']['personal_information']; ?>
</a> <span>&gt;</span>
        <?php if ($_GET['type'] == 'password'): ?><?php echo $this->_tpl_vars['lang']['change_password']; ?>
<?php elseif ($_GET['type'] == 'mail'): ?><?php echo $this->_tpl_vars['lang']['change_email']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['basic_information']; ?>
<?php endif; ?>
    </div>
</div>
<div class="main">
	<div class="wrap">
        <div class="hd">
            <ul class="tabs">
                <li class="<?php if ($_GET['type']): ?>normal<?php else: ?>active<?php endif; ?>"><a href="main.php?m=member&s=admin_member">基本信息</a></li>
               
                <li class="<?php if ($_GET['type'] == 'password'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=member&s=admin_member&type=password">修改密码</a></li>
                <li class="<?php if ($_GET['type'] == 'email'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=member&s=admin_member&type=email">修改邮箱</a></li>
                <li class="<?php if ($_GET['type'] == 'mobile'): ?>active<?php else: ?>normal<?php endif; ?>"><a href="main.php?m=member&s=admin_member&type=mobile">修改手机</a></li>
            </ul>
        </div>
        <?php if ($_GET['type'] == 'password'): ?>
        <div class="form-style">
            <form action="" method="post">
            <input type="hidden" value="password" name="submit">
            <dl>
                <dt><em>*</em><?php echo $this->_tpl_vars['lang']['your_password']; ?>
</dt>
                <dd><input name="oldpass" type="password" id="oldpass" class="text w150" /></dd>
            </dl>
            <dl>
                <dt><em>*</em><?php echo $this->_tpl_vars['lang']['new_pass']; ?>
</dt>
                <dd><input name="newpass" type="password" id="newpass" class="password w150" /></dd>
            </dl>
            <dl>
                <dt><em>*</em><?php echo $this->_tpl_vars['lang']['con_pass']; ?>
</dt>
                <dd><input name="renewpass" type="password" id="renewpass" class="password w150" /></dd>
            </dl>
            <dl class="foot">
                <dt>&nbsp;</dt>
                <dd><input type="submit" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" class="submit"></dd>
            </dl>
            </form>
        </div>  
        <?php elseif ($_GET['type'] == 'email'): ?>
        <div class="form-style">
            <form action="" method="post">
            <input type="hidden" value="email" name="submit">
           	<dl>
                <dt><em>*</em>邮箱</dt>
                <dd><input name="email" id="email" type="text" class="text w300" /></dd>
            </dl>
            <dl>
                <dt><em>*</em>邮件验证码</dt>
                <dd>
                <input name="yzm" type="text" class="text w150" />
               <input type="button" class="send" value="获取邮件验证码" />
                </dd>
            </dl>
            <dl class="foot">
                <dt>&nbsp;</dt>
                <dd><input type="submit" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" class="submit"></dd>
            </dl>
            </form>
            <script>
            $(".send").click(function(){
				var val = $("#email").val();
				var patrn = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(!val){
					alert("请输入邮箱");return false;
				}
				else if(!patrn.test(val)){  
					alert("邮箱格式错误");return false;
				}
				else{
                    var flag = true;
					var url = 'ajax_back_end.php';
					var sj = new Date();
					var pars = 'shuiji=' + sj+'&verify_type=email&verify_field='+val; 
					$.post(url, pars, function (originalRequest)
					{
                        var flag = true;
						if(originalRequest=="true"){
							
							msg = "获取邮件验证码";
							$(".send").attr("disabled", "disabled");
							$("#email").attr("disabled", "disabled");
							$("#email").attr("readonly", "readonly");
							t=setTimeout(countDown,1000);
					
							var url = 'ajax_back_end.php';
							var sj = new Date();
							var pars = 'shuiji=' + sj +'&email='+val; 
							$.post(url, pars, function (originalRequest){})
						}
						else{				
							alert("该邮箱已经认证!");
							flag = false;
						}
						return flag;
					});
					return flag;
				}
			})
			var delayTime = 10;
			function countDown()
			{
				delayTime--;
				$(".send").val(delayTime + '秒后重新获取');
				if (delayTime == 0) {
					delayTime = 10;
					$(".send").val(msg);
					$(".send").removeAttr("disabled");
					$("#email").removeAttr("disabled");
					clearTimeout(t);
				}
				else
				{
					t=setTimeout(countDown,1000);
				}
			}
            </script>
        </div>
        <?php elseif ($_GET['type'] == 'mobile'): ?>
        <div class="form-style">
            <form action="" method="post">
            <input type="hidden" value="mobile" name="submit">
            <dl>
                <dt><em>*</em>手机</dt>
                <dd><input name="mobile" id="mobile" type="text" class="text w300" /></dd>
            </dl>
            <dl>
                <dt><em>*</em>短信验证码</dt>
                <dd>
                <input name="yzm" type="text" class="text w150" />
               <input type="button" class="send" value="获取短信验证码" />
                </dd>
            </dl>
            <dl class="foot">
                <dt>&nbsp;</dt>
                <dd><input type="submit" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" class="submit"></dd>
            </dl>
            </form>
            <script>
            $(".send").click(function(){
				var val = $("#mobile").val();
				var mobile = new RegExp("^0?(13|15|17|18|14)[0-9]{9}$");//手机
				
				if(!val){
					alert("请输入手机");return false;
				}
				else if(!mobile.test(val)){  
					alert("手机格式错误");
					return false;
				}
				else{
					var url = 'ajax_back_end.php';
					var sj = new Date();
					var pars = 'shuiji=' + sj+'&verify_type=mobile&verify_field='+val; 
					$.post(url, pars, function (originalRequest)
					{
						if(originalRequest=="true"){
							
							msg = "获取短信验证码";
							$(".send").attr("disabled", "disabled");
							$("#mobile").attr("disabled", "disabled");
							$("#mobile").attr("readonly", "readonly");
							t=setTimeout(countDown,1000);
					
							var url = 'ajax_back_end.php';
							var sj = new Date();
							var pars = 'shuiji=' + sj +'&mobile='+val; 
							$.post(url, pars, function (originalRequest){})
						}
						else{				
							alert("该手机已注册，请更换其他手机");
							flag = false;
						}
						return flag;
					});
					return flag;
				}
			})
			var delayTime = 10;
			function countDown()
			{
				delayTime--;
				$(".send").val(delayTime + '秒后重新获取');
				if (delayTime == 0) {
					delayTime = 10;
					$(".send").val(msg);
					$(".send").removeAttr("disabled");
					$("#mobile").removeAttr("disabled");
					clearTimeout(t);
				}
				else
				{
					t=setTimeout(countDown,1000);
				}
			}
            </script>
        </div>
        <?php else: ?>
        <div class="form-style">
            <form action="" method="post" name="form" id="form">
            <input type="hidden" value="edit" name="submit">
            <h5>亲爱的<?php echo $_COOKIE['USER']; ?>
，填写真实的资料，有助于好友找到你哦。</h5>
            <dl>
                <dt>用户名</dt>
                <dd><?php echo $this->_tpl_vars['de']['user']; ?>
</dd>
            </dl>
            <?php if ($this->_tpl_vars['de']['email']): ?>
            <dl>
                <dt>邮箱：</dt>
                <dd><?php echo $this->_tpl_vars['de']['email']; ?>
<?php if ($this->_tpl_vars['de']['email_verify'] == 1): ?><span class="verify">已验证</span><?php endif; ?></dd>
            </dl>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['de']['mobile']): ?>
            <dl>
                <dt>手机：</dt>
                <dd><?php echo $this->_tpl_vars['de']['mobile']; ?>
<?php if ($this->_tpl_vars['de']['mobile_verify'] == 1): ?><span class="verify">已验证</span><?php endif; ?></dd>
            </dl>
            <?php endif; ?>
            <dl>
                <dt>当前头像：</dt>
                <dd>
                <p class="pic" style=" width:120px; height:120px; "><img id="logo_img" src="<?php if ($this->_tpl_vars['de']['logo']): ?><?php echo $this->_tpl_vars['de']['logo']; ?>
<?php else: ?><?php echo $this->_tpl_vars['config']['weburl']; ?>
/image/default/user_admin/default_user_portrait.gif<?php endif; ?>" height="120" width="120" /></p>
				
                <p><input class="text w300" name="logo" type="text" id="logo" value="<?php echo $this->_tpl_vars['de']['logo']; ?>
"> <a class="upload-button" href="javascript:uploadfile('LOGO','logo',120,120,'member')"><?php echo $this->_tpl_vars['lang']['upload']; ?>
</a></p>
                </dd>
            </dl>
            
            <dl>
                <dt><em>*</em>昵称：</dt>
                <dd><input name='name' type='text' id="name" value="<?php echo $this->_tpl_vars['de']['name']; ?>
" dataType="Require" msg="<?php echo $this->_tpl_vars['lang']['ar_con_user']; ?>
" class="text w150"><div class="form-error"></span></div>
            </dl>
            <dl>
                <dt>性别：</dt>
                <dd>
                <input name="sex" id="s1" type="radio"  value="1" <?php if ($this->_tpl_vars['de']['sex'] == 1): ?>checked="checked"<?php endif; ?> />
                <label for="s1"><?php echo $this->_tpl_vars['lang']['male']; ?>
</label>
                <input name="sex" id="s2" type="radio"  value="2" <?php if ($this->_tpl_vars['de']['sex'] == 2): ?>checked="checked"<?php endif; ?> />
                <label for="s2"><?php echo $this->_tpl_vars['lang']['female']; ?>
</label>   
                </dd>
            </dl>
            <dl>
                <dt>所在地区：</dt>
                <dd>
                <input type="hidden" name="t" id="t" value="<?php echo $this->_tpl_vars['de']['area']; ?>
" />
                <input type="hidden" name="province" id="id_1" value="<?php echo $this->_tpl_vars['de']['provinceid']; ?>
" />
                <input type="hidden" name="city" id="id_2" value="<?php echo $this->_tpl_vars['de']['cityid']; ?>
" />
                <input type="hidden" name="area" id="id_3" value="<?php echo $this->_tpl_vars['de']['areaid']; ?>
" />
                <input type="hidden" name="street" id="id_4" value="<?php echo $this->_tpl_vars['de']['streetid']; ?>
" />
                <?php if ($this->_tpl_vars['de']['area']): ?><div id="d_1"><?php echo $this->_tpl_vars['de']['area']; ?>
&nbsp;&nbsp;<a href="javascript:sd();"><?php echo $this->_tpl_vars['lang']['edit']; ?>
</a></div><?php endif; ?>
                <div id="d_2" <?php if ($this->_tpl_vars['de']['area']): ?>class="hidden"<?php endif; ?>>
                <select id="select_1" name="select_1" onChange="district(this);">
                <option value="">--<?php echo $this->_tpl_vars['lang']['please_select']; ?>
--</option>
                <?php echo $this->_tpl_vars['prov']; ?>

                </select>
                <select id="select_2" name="select_2" onChange="district(this);" class="hidden"></select>
                <select id="select_3" name="select_3" onChange="district(this);" class="hidden"></select>
                <select id="select_4" name="select_4" onChange="district(this);" class="hidden"></select>
                <div class="form-error"></div>
                </div>
                </dd>
            </dl>
            <dl>
                <dt>QQ：</dt>
                <dd><input name="qq" type="text" value="<?php echo $this->_tpl_vars['de']['qq']; ?>
" class="text w200"></dd>
            </dl>
            <?php if ($this->_tpl_vars['wechat_connect_flag']): ?>
            <dl>
                <dt>微信：</dt>
                <dd><?php if ($this->_tpl_vars['wechat_connect_row']['userid']): ?>已经绑定 <?php echo $this->_tpl_vars['wechat_connect_row']['nickname']; ?>
<?php else: ?><a href="<?php echo $this->_tpl_vars['wechat_url']; ?>
" target="_blank">未绑定，点击进行绑定</a><?php endif; ?></dd>
            </dl>
            <?php endif; ?>
            <dl>
                <dt>旺旺：</dt>
                <dd><input name="ww" type="text" value="<?php echo $this->_tpl_vars['de']['ww']; ?>
" class="text w200"></dd>
            </dl>
            <dl class="foot">
                <dt>&nbsp;</dt>
                <dd><input type="submit" value="<?php echo $this->_tpl_vars['lang']['submit']; ?>
" class="submit"></dd>
            </dl>
            </form>
        </div> 
        <?php endif; ?>
    </div>
</div>