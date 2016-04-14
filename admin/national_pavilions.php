<?php
include_once("../includes/global.php");
include_once("../includes/page_utf_class.php");
include_once("../includes/smarty_config.php");
$script_tmp = explode('/', $_SERVER['SCRIPT_NAME']);
$sctiptName = array_pop($script_tmp);
@include_once("auth.php");
if(isset($_GET['natadd'])&&$_GET['natadd']=='add'){
    $tpl->display('newadd.htm');
    die;
}
//====================================
if(!empty($_POST['title']))
{
    $img = trim($_POST['img']);
    $title = trim($_POST['title']);
   // echo $char = c($title);
    $sql="insert into ".NATIONAL." (title,char_index,img) value ('$title','$char','$img') ";

    if($db->query($sql)){
        echo "<script>alert('上传成功！');</script>";
    }else{
        echo "<script>alert('系统忙，请稍后上传！');</script>";
    }

	/*$ar=explode(',',$_POST['title']);
	foreach($ar as $v)
	{
		$v=trim($v);
		$char=c($v);
		$sql="insert into ".NATIONAL." (title,char_index) value ('$v','$char') ";
		$db->query($sql);
	}*/

}
if(empty($_GET['deltag'])&&!is_array($_GET['id']))
{
	$sql="delete from ".NATIONAL." where id='".trim($_GET['id'])."'";
	$db->query($sql);
}
if($_GET['del']==lang_show('delete')&&is_array($_GET['id']))
{
	$deltn=implode(",",$_GET["id"]);
	$sql="delete from ".NATIONAL."  where  id in (".$deltn.")";
	$db->query($sql);
}

if(!empty($_GET['name']))
	$ssql=" and title like '%$_GET[name]%' ";
$sql="select * from ".NATIONAL." where 1 $ssql order by nums desc";
//=============================
$page = new Page;
$page->listRows=50;
if (!$page->__get('totalRows')){
	$db->query($sql);
	$page->totalRows = $db->num_rows();
}
$sql .= "  limit ".$page->firstRow.",50";
$pages = $page->prompt();
//=====================
$db->query($sql);
$re=$db->getRows();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="main.css" rel="stylesheet" type="text/css" />
    <style>
        .newadd {list-style: none; float:left; margin-left: -1400px; margin-top: 8px;}
        .newaddli {float: left; padding: 5px 10px;}
        .dela {text-decoration: none; color: #5F718B;}
    </style>
</head>
<body>
<script type="text/javascript">
function checkall()
{
	 for(var j = 0 ; j < document.getElementsByName("id[]").length; j++)
	 {
	  	if(document.getElementsByName("id[]")[j].checked==true)
	  	  document.getElementsByName("id[]")[j].checked = false;
		else
		  document.getElementsByName("id[]")[j].checked = true;
	 }
}
</script>
<div class="bigbox">
	<div class="bigboxhead">热门国家馆</div>
	<ul class="newadd">
        <li class="newaddli"><a class="dela" href="/admin/national_pavilions.php?natadd=add">新增国家馆</a></li>
        <li class="newaddli"><a class="dela" href="">国家馆列表</a></li>
    </ul>

	<div class="bigboxbody">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2"  align="left">
		  <form action="" method="get" >
            <input name="name" type="text" id="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>" >
            <input class="btn" type="submit" name="submit" id="submit" value="<?php echo lang_show('search');?>">
		  </form>
		  </td>
          <td  colspan="2" align="left" >
		  <form name="form1" method="post" action="" enctype="multipart/form-data">
            <input type="file" name="img">
            <input style="width:244px; height:20px" name="title" type="text" size="12">
			<input id="tsubmit" name="tsubmit" type="hidden" value="">
            <input class="btn" type="submit" name="submit" value="<?php echo lang_show('submit');?>">
          </form>
          </td>
        </tr>
		<form name="iplockset" action="" method="GET">
        <tr class="theader">
          <td align="left"  width="25">
          <input type="checkbox" class="checkbox" name="checktagall" id="checktagall" onClick="checkall()">
          </td>
          <td>国家馆</td>
          <td width="555" align="left">搜索次数</td>
          <td width="143" align="left">操作</td>
        </tr>
        <?php
	      foreach ($re as $v)
          {
        ?>
        <tr>
          <td align="left" >
          <input type="checkbox" class="checkbox" name="id[]" value="<?php echo $v['id'];?>"></td><td><?php echo $v['title'];?>
                <img style="width:50px; height:20px; margin-left:20px; padding-top:5px;" src="<?php echo $v[img]?>" alt="图片" width="20" height="10">
            </td>
          <td align="left" ><?php echo $v['nums'];?></td>
          <td  align="left" ><a href="national_pavilions.php?id=<?php echo $v['id'];?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"><?php echo $delimg;?></a></td>
        </tr>
        <?php
        }
        ?>
        <tr>
          <td width="25"  align="left"  >
          <input type="checkbox" class="checkbox" name="checktagall" id="checktagall" onClick="checkall()">
          </td>
          <td><input class="btn" type="submit" name="del" value="<?php echo lang_show('delete');?>" onClick="return confirm('<?php echo lang_show('are_you_sure');?>');"></td>
          <td height="24" colspan="2" align="right">&nbsp;<div class="page"><?php echo $pages;?></div></td>
        </tr>
		</form>
	</table>
	</div>
</div>
</body>
</html>