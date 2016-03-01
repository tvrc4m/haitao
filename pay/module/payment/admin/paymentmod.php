<?php
include_once("../module/payment/lang/payment_$langs.php");
//========================
if(!isset($_GET['payment_type']))
	msg("module.php?m=payment&s=payment.php");

$modules_loading = true;
include_once("../module/payment/admin/payment/".$_GET['payment_type'].".php");
if(isset($_POST["action"]))
{
	$sql = "select * from ".PAYMENT." where payment_type='".$_GET['payment_type']."'";
	$db->query($sql);
	$pament_one = $db->fetchRow();
	$configs = array();
	if(isset($_POST['config']) && is_array($_POST['config']))
	{
		for($i=0;$i<count($_POST['config']);$i++)
		{
			$configs[$i] = array(
					'name' => $_POST['config_name'][$i],
					'type' => $_POST['config_type'][$i],
					'value' => $_POST['config'][$i],
					'option' => $_POST['config_option'][$i],
					'option_value' => $_POST['config_option_value'][$i],
				);
		}
		$configs_str = serialize($configs);
	}
	if($pament_one)
	{
		$sql = "update ".PAYMENT." set payment_name='$_POST[payment_name]',payment_desc='$_POST[payment_desc]',payment_commission='$_POST[payment_commission]',payment_config='$configs_str',active='1' where payment_type='$_POST[payment_type]'";
	}
	else
	{
		$sql = "insert into ".PAYMENT." (payment_type,payment_name, payment_desc, payment_commission, payment_config, active) values('$_POST[payment_type]','$_POST[payment_name]','$_POST[payment_desc]','$_POST[payment_commission]','$configs_str','1')";
	}
	$db->query($sql);
	msg("module.php?m=payment&s=payment.php");
}

$sql = "select * from ".PAYMENT." where payment_type='".$_GET['payment_type']."'";
$db->query($sql);
$payment_one = $db->fetchRow();
if ($payment_one)
{
	$name = $payment_one['payment_name'];
	$desc = $payment_one['payment_desc'];
	$commission = $payment_one['payment_commission'];
	$configs = unserialize($payment_one['payment_config']);
}
else
{
	$name = lang_show($modules_list[0]['payment_name']);
	$desc = lang_show($modules_list[0]['payment_name'].'_desc');
	$commission = $modules_list[0]['payment_commission'];
	$configs = $modules_list[0]['payment_config'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php echo lang_show('admin_system');?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../script/jquery-1.4.4.min.js" /></script>
</HEAD>
<body>
<div class="bigbox">
	<div class="bigboxhead"><?php echo lang_show('pay_edit_a');?></div>
	<div class="bigboxbody">
        <form name="form1" method="post" action="">
        <input name="step" type="hidden" id="step" value="<?php echo $_GET['step'];?>">
        <input name="payment_type" type="hidden" id="payment_type" value="<?php echo $_GET['payment_type'];?>">
        <table width="100%" border="0" cellpadding="4" cellspacing="0">
            <tr>
                <td width="99" align="left"><?php echo lang_show('pay_edit_b');?></td>
                <td><input type="text" name="payment_name" value="<?php echo $name; ?>" class="text"></td>
            </tr>
            <tr>
                <td align="left"><?php echo lang_show('pay_edit_c');?></td>
                <td>
                <textarea name='payment_desc' class="text" rows='10' id="payment_desc"><?php echo $desc; ?></textarea></td>
            </tr>
			<?php
            for($i=0;$i<count($configs);$i++)
            {
				$class = ($configs[$i]['type'] == 'text'&&$configs[$i]['option_value']) ? "id='tr'" :"";	
			?>
            <tr <?php echo $class; ?>>
                <td align="left"><?php echo lang_show($configs[$i]['name']);?></td>
                <td>
                <?php
                if($configs[$i]['type'] == 'text')
                {
                ?>
                <input class="text" type="text" name="config[]" value="<?php echo $configs[$i]['value']; ?>">
                <input type="hidden" name="config_name[]" value="<?php echo $configs[$i]['name']; ?>">
                <input type="hidden" name="config_type[]" value="text">
                <input type="hidden" name="config_option[]" value='<?php echo $configs[$i]['option']; ?>'>
                <input type="hidden" name="config_option_value[]" value='<?php echo $configs[$i]['option_value']; ?>'>
                <?php
                }
                else if ($configs[$i]['type'] == 'select'&&$configs[$i]['option'])
                {
					if($configs[$i]['option_value'])
					{
						$arr = explode("|",$configs[$i]['option_value']);	
						if($arr)
						{
							$str = array(); 
							foreach($arr as $val)
							{
								if(!$val)
									$str[] = "";
								else
									$str[] = $val.",".lang_show($val);	
							}
							$str = implode("|",$str);
						}
					}
                ?>
                    <select class="text" name="config[]" data-param="<?php echo $str; ?>">
                        <?php 
                        foreach(@explode('|',$configs[$i]['option']) as $key=>$val)
                        {
                            if($configs[$i]['value']==$key)
                                echo "<option selected='selected' value='$key'>$val</option>";
                            else
                                echo "<option value='$key'>$val</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="config_name[]" value="<?php echo $configs[$i]['name']; ?>">
                    <input type="hidden" name="config_type[]" value="select">
                    <input type="hidden" name="config_option[]" value='<?php echo $configs[$i]['option']; ?>'>
                    <input type="hidden" name="config_option_value[]" value='<?php echo $configs[$i]['option_value']; ?>'>
                <?php	
                }
                ?>
                </td>
            </tr>
            <?php
            }
            ?>	
            <tr> 
                <td height="20" align="center">&nbsp;</td>
                <td height="20" align="left">
                <input name="cc1" class="btn" type="submit" id="cc1" value=" <?php echo lang_show('modify');?> ">
                <input name="action" type="hidden" id="action" value="submit"></td>
            </tr>
        </table>
        <script>
        $(".bigboxbody").find("select").each(function(){
         	val = $(this).attr("data-param");
			if(val)
			{
				$(this).change(function(){
					arr = val.split("|");
					N = $(this).val();
					$("#tr").remove();
					if(arr[N])
					{
						A = arr[N].split(",");
						obj = $(this).parent().parent();
						obj.after('<tr id="tr"><td>'+A[1]+'</td><td> <input class="text" type="text" name="config[]" value=""><input type="hidden" name="config_name[]" value="'+A[0]+'"><input type="hidden" name="config_type[]" value="text"><input type="hidden" name="config_option[]" value=""><input type="hidden" name="config_option_value[]" value="1"></td></tr>');	
					}
				})			
			}
	    });
        </script>
        </form>
    </div>
</div>
</body>
</html>