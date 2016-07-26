<?php
$id=!empty($_GET["id"])?$_GET["id"]*1:NULL;
$key=!empty($_GET["key"])?trim($_GET["key"]):NULL;
$brand=!empty($_GET["brand"])?trim($_GET["brand"]):NULL;

if (null == $key)
{
    $key=!empty($_GET["keyword"])?trim($_GET["keyword"]):NULL;
}

$firstRow=!empty($_GET["firstRow"])?$_GET["firstRow"]:NULL;
$totalRows=!empty($_GET["totalRows"])?$_GET["totalRows"]:NULL;
$orderby=!empty($_GET["orderby"])?$_GET['orderby']*1:NULL;

//检测key是否属于类型
$sql = "SELECT cat,catid FROM mallbuilder_product_cat WHERE cat ='$key'";
$db->query($sql);
$cats = $db->fetchRow();
$strs="";
if(!empty($cats)){
    $strs .= "OR a.catid=".$cats['catid'];
}
if(!empty($brand)){
    $strs .= " a.brand='{$brand}'";
    if(!empty($id)){
        $strs .= " and ";
    }
}else{
    $strbrand = "OR a.brand ='{$key}'";
}
if(!empty($id)){
    $strs .= "a.catid=".$id;
}

if(!empty($brand) || !empty($id)){
    $strs = ' HAVING '.$strs;
}

include_once("includes/page_utf_class.php");
$page = new Page;
$page->url=$config['weburl'].'/';
$page->listRows=20;

if($orderby==1)
    $scl.=" order by a.sales desc";
elseif($orderby==2)
    $scl.=" order by a.clicks desc";
elseif($orderby==3)
    $scl.=" order by a.goodbad desc";
elseif($orderby==4)
    $scl.=" order by a.uptime desc";
elseif($orderby==5)
    $scl.=" order by a.price ASC";
elseif($orderby==6)
    $scl.=" order by a.price desc";
elseif($orderby==8)
    $scl.=" order by p.commission_product_price_0 desc";
else{
    $scl.=" order by a.rank desc,a.uptime desc";
    /*if($config['temp']=='wap'){
        $scl.=" order by p.commission_product_price_0 desc";
    }else{
        $scl.=" order by a.rank desc,a.uptime desc";
    }*/
}

//查询商品中的分类与品牌
//$sql = "SELECT catid,brand FROM mallbuilder_product WHERE `name` LIKE '%{$key}%' OR brand ='{$key}' OR keywords LIKE '%{$key}%' $strs";
echo $sql = "SELECT a.catid,a.brand,a.id,a.name as pname,a.subhead,a.trade,a.price,a.national,a.sales,a.stock,a.market_price,a.is_dist,a.member_id as userid,a.pic,c.company, p.* FROM ".PRODUCT." a left join ".DISTRIBUTION_PRODUCT." p ON a.id=p.product_id  left join ".SHOP." c on a.member_id=c.userid WHERE  c.shop_statu=1 and a.status>0 and is_shelves=1 and a.`name` LIKE '%{$key}%' $strbrand  OR a.keywords LIKE '%{$key}%' $strs $scl";

if(!$page->__get('totalRows'))
{
    $db->query($sql);
    $page->totalRows =$db->num_rows();
}

$sql.=" limit ".$page->firstRow.",".$page->listRows;

$db->query($sql);
$ress = $db->getRows();
//var_dump($ress);
if(!empty($ress)) {
    foreach ($ress as $val) {
        $cats[] = $val['catid'];
        $brands[] = $val['brand'];
    }

    $brands = array_unique($brands);
    foreach ($brands as $key => $val) {
        $new_brands[]['name'] = $val;
    }
    $tpl->assign("brand", $new_brands);
    ;
    $cats = array_unique($cats);
    $cats = implode($cats, ',');
    $sql = "select cat,catid from " . PCAT . " where catid in ($cats) order by nums asc ";
    $db->query($sql);
    $de = $db->getRows();
    $tpl->assign("cat", $de);

    foreach($ress as $key => $val){
        $sql = "select count(id) as num from mallbuilder_product_comment where pid = ".$val[id];
        $db->query($sql);
        $res = $db->fetchRow();
        $ress[$key]['con'] = $res ? $res : 0;
    }

    foreach($ress as $key => $val){
        $sql = "select title,char_index,img from mallbuilder_national_pavilions where id = ".$val['national'];
        $db->query($sql);
        $res = $db->fetchRow();
        $ress[$key]['nat'] = $res ? $res : "";
    }

    fb($ress);

    $prolist['list']=$ress;
    $prolist['page']=$page->prompt();
    $prolist['count']=$page->totalRows;
    $tpl->assign("info",$prolist);
    unset($prolist);
}

//获取当前页的类名
if(!empty($_GET['id'])){
    $sql = "select cat from mallbuilder_product_cat where catid=" . $_GET['id'];
    $db->query($sql);
    $res = $db->fetchField('cat');
    $tpl->assign("wapcatname",$res);
}
if(!empty($_GET['brand']))
    $tpl->assign("wapcatname",$_GET['brand']);

//你可能还喜欢
if(!empty($_GET['id'])) {
    $cat_first = substr($_GET['id'],0,4);
    $sql = "SELECT a.id,a.`name`,a.market_price,a.price,a.pic,b.`img`,b.`title` FROM mallbuilder_product a LEFT JOIN mallbuilder_national_pavilions b ON a.`national`=b.id WHERE is_shelves=1 and LOCATE({$cat_first},a.catid)>0 ORDER BY a.clicks DESC LIMIT 10";
    $db->query($sql);
    $relation = $db->getRows();

    $tpl->assign('relationcat',$relation);
}
if($_GET['national']==7)$tpl->assign("wapcatname",'日本馆');

$tpl->assign("province",GetDistrict1());

//------------------------------------------------------
$url=implode('&',convert($_GET));
$tpl->assign("url",$url);
//----------------------------SEO
$config['title']=str_replace('[catname]',$cat['cat'],$config['title2']);
$config['keyword']=str_replace('[catname]',$cat['cat'],$config['keyword2']);
$config['description']=str_replace('[catname]',$cat['cat'],$config['description2']);
//=====================================================
if($cat['templates'])
{
    $tpl -> template_dir = $config['webroot'] . "/templates/".$cat['templates']."/";
    $tpl -> compile_dir  = $config["webroot"] . "/templates_c/".$cat['templates']."/";
}
$tpl->assign("current","product");

include_once("footer.php");
if($_GET['fx']==fx)
    $out=tplfetch("product_list_x.htm");
else
    $out=tplfetch("product_list.htm");