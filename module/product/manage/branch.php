<?php
/**
 * Created by PhpStorm.
 * User: wonder
 * Date: 2016/6/14
 * Time: 11:08
 */

echo 'https://www.mayihaitao.com/main.php?m=shop&s=admin_step&cg_u_type=2&shop_type=2&grade=1&pid='.$buid;

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="button" name="anniu2" onClick='copyUrl()' value="复制URL地址">
<script language="javascript">
     function copyUrl()
     {
        var clipBoardContent='';
        clipBoardContent +=document.title;
        clipBoardContent +='';
        clipBoardContent +='www.baidu.com';
        window.clipboardData.setData("Text",clipBoardContent);
        alert("复制成功!");
     }
    </script>
