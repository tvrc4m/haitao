<?php
$tpl->assign('config',$config);
if($config['temp'] == 'default'){
    $out = tplfetch('act.htm');
}elseif($config['temp'] == 'wap'){
    $out = tplfetch('act_wap.htm');
}

?>