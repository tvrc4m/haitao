<?php
include_once("../includes/global.php");
include_once ("../includes/uc_server.php");
//================================================
if(!empty($_POST["user"]))
{
    if(strtolower($_SESSION["auth"])!=strtolower($_POST["yzm"]))
    {
        msg("index.php?type=2");
        exit();
    }
    else
    {
        $obj = new Uc_server($_SESSION['ucenter_data']);
        $ps=md5(md5($_POST['password']).$us['salt']);
        //验证手机号登录
        $login_phone = "";
        if(preg_match('/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[07])\d{8}$/', $_POST['user']))
        {
            $sql="select * from ".MEMBER." where mobile='$_POST[user]'";
            $login_phone = $_POST['user'];
         }else{
            $sql="select * from ".MEMBER." where  user='$_POST[user]'";
        }

        $db->query($sql);
        $re=$db->fetchRow();

        $sql = "select pid,ptype from mallbuilder_shop where userid={$re[userid]}";
        $db->query($sql);
        $pshop = $db->fetchRow();
        if($pshop['ptype']!=1&&$pshop['pid']==$re['userid']){
            header("location:index.php?type=3");
            exit();
        }
        $login_phone = empty($login_phone)?(!empty($re)?$re["mobile"]:''):$login_phone;
        $us = $obj->userinfo(array('phone'=>$login_phone));
        if($us['password']==md5(md5($_POST['password']).$us['salt']))
        {
            $_SESSION["ADMIN_USER"]=$_POST["user"];
            $_SESSION["ADMIN_PASSWORD"]=$ps;
            $_SESSION["ADMIN_TYPE"]=1;//是否管理员
            $_SESSION["ADMIN_LANG"]='cn';

            header("location:main.php");
            exit();
        }
        else
        {
            header("location:index.php?type=1");
            exit();
        }
    }
}
if(!empty($_GET["action"]))
{
    if($_GET["action"]=="logout")
    {
        $_SESSION["ADMIN_USER_ID"]="";
        $_SESSION["ADMIN_USER"]="";
        $_SESSION["ADMIN_PASSWORD"]="";
        $_SESSION["ADMIN_TYPE"]="";
        $_SESSION["ADMIN_LANG"] = '';
        unset($_SESSION["ADMIN_USER_id"]);
        unset($_SESSION["ADMIN_TYPE"]);
        unset($_SESSION["ADMIN_LANG"]);
        unset($_SESSION["ADMIN_USER"]);
        unset($_SESSION["ADMIN_PASSWORD"]);
        unset($_SESSION["province"]);
        unset($_SESSION["city"]);
        unset($_SESSION["area"]);
        msg("index.php");
        exit();
    }
}
//===============================
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
$config['language'] = isset($_SESSION["ADMIN_LANG"])?$_SESSION["ADMIN_LANG"]:$config['language'];
include_once("../lang/".$config['language']."/admin.php");

?>
<html>
<head>
    <title><?php echo lang_show('admin_system');?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../script/base.js"></script>
</head>
<body class="body">
<center>
    <div class="main">
        <div style="height:125px;"></div>
        <div class="logo"><img src="../image/logo.gif"></div>
        <div class="bottom">
            <form method="post" action="index.php">
                <table width="100%" height="377px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="38" valign="top" class="bgz"></td>
                        <td valign="top">
                            <table width="469px" height="377px" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="cen_t"></td>
                                </tr>
                                <tr>
                                    <td width="469px" height="310px" valign="top" background="../image/admin/center.jpg" style="background-position:top; background-repeat:no-repeat;" class="bgbg">
                                        <div class="bt"><?php echo lang_show('user_login');?></div>
                                        <div class="yhxx">
                                            <div>
                                                <label>
                                                    <span class="wz"><?php echo lang_show('username');?>:</span>
							  <span class="wb">
                                <input type="text" name="user" value="<?php if(isset($_POST["user"])) echo $_POST["user"];?>" class="text">
                                  <?php
                                  if(isset($_GET["type"]))
                                  {
                                      if($_GET["type"]==1)
                                          echo lang_show('error_user');
                                      if($_GET["type"]==3)
                                          echo '帐号无权登录！';
                                  }
                                  ?>
                              </span>
                                                </label>

                                            </div>
                                            <div><label><span class="wz"><?php echo lang_show('password');?>:</span>
                                <span class="wb"> <input type="password" name="password" class="text">
                              </span></label>

                                            </div>

                                            <div>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td style="width:60px;"><span class="wz"> <?php echo lang_show('verfiy');?>:</span></td>
                                                        <td style=" text-align:left!important; text-align:center; width:130px;"><label><span class="wb"><input type="text" name="yzm" class="text3">&nbsp;</span></label>
                                                        </td>
                                                        <td valign="middle">
                                                            <img onClick="get_randfunc(this);" style="padding-top:3px; cursor:pointer;" src='../includes/rand_func.php'/>
                                                            <?php
                                                            if(isset($_GET["type"]))
                                                            {
                                                                if($_GET["type"]==2)
                                                                    echo lang_show('error_verfiy');
                                                            }
                                                            ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <input style="border:none;" name="Submit" type="image" src="../image/admin/button.jpg">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input style="border:none;" value="<?php echo lang_show('reset');?>" name="" type="image" src="../image/admin/button2.jpg">
                                        </div>
                                        <div class="bwz">
                                            Powered by <a target="_blank" href="https://www.mayihaitao.com">mayihaitao.com</a> © 2011-2015
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cen_b">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="38" valign="top" class="bgy">&nbsp;</td>
                    </tr>
                </table>

            </form>

        </div>
    </div>

</center>

</body>

</html>