<?php
function validation_filter_id_card($id_card) {
    if(!preg_match('/^\d{17}(\d|x)$/i',$id_card) &&  !preg_match('/^\d{15}$/i',$id_card))
        return false;
    if (strlen($id_card) == 18) {
        return idcard_checksum18($id_card);
    } elseif ((strlen($id_card) == 15)) {
        $id_card = idcard_15to18($id_card);
        return idcard_checksum18($id_card);
    } else {
        return false;
    }
}
// 计算身份证校验码，根据国家标准GB 11643-1999
function idcard_verify_number($idcard_base) {
    if (strlen($idcard_base) != 17) {
        return false;
    }
    // 加权因子
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    // 校验码对应值
    $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
    $checksum = 0;
    for ($i = 0; $i < strlen($idcard_base); $i++) {
        $checksum += substr($idcard_base, $i, 1) * $factor[$i];
    }


    $mod = $checksum % 11;
    $verify_number = $verify_number_list[$mod];
    return $verify_number;
}
// 将15位身份证升级到18位
function idcard_15to18($idcard) {
    if (strlen($idcard) != 15) {
        return false;
    } else {
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false) {
            $idcard = substr($idcard, 0, 6) . '18' . substr($idcard, 6, 9);
        } else {
            $idcard = substr($idcard, 0, 6) . '19' . substr($idcard, 6, 9);
        }
    }
    $idcard = $idcard . idcard_verify_number($idcard);
    return $idcard;
}
// 18位身份证校验码有效性检查
function idcard_checksum18($idcard) {
    if (strlen($idcard) != 18) {
        return false;
    }
    $idcard_base = substr($idcard, 0, 17);
    if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))) {
        return false;
    } else {
        return true;
    }
}
//验证身份证真假接口
function aes($url='',$post_data=''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $list = curl_exec($ch);
    curl_close($ch);
    return json_decode($list,true);
}

$card_id = '130429198702155219';//身份号
$realname = '张飞';//身份证姓名
$partner_id = '20160100136';
$secret = 'da3f333fb4d18dd0181fedb28c9ed6b7';
$url = "https://m.mayizaixian.cn/apis/api/check_card_info";
$sigin = md5($card_id."|~".$realname."|~".$partner_id."|~".$secret);
//身份号格式证验证
$type = validation_filter_id_card($card_id);
var_dump($type);
// 判断type为正确身份证再跳转验证身份证真假
$tokens = aes($url,array ("card_id" => $card_id,"realname"=>$realname,"partner_id"=>$partner_id,"sigin"=>$sigin));
var_dump($tokens);

?>
<a href="http://haitao.com/real.php">121321</a>