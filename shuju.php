<?php
include_once ("includes/global.php");

include_once ("lib/PHPExcel/Classes/PHPExcel.php");

//创建对象
$excel = new PHPExcel();
//Excel表格式,这里简略写了8列
$letter = array('A','B','C','D','E','F','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA');
//表头数组
$tableheader = array('商品名字*','商品外文名称*','产品国际条形码*','商品生产厂家','商品原产国*','商品原产地','商品净重*','商品毛重*','商品长度*','商品宽度*','商品高度*','商品类别*','商品品牌*','商品单位*','商品主图片','商品附属图片1','商品附属图片2','商品附属图片3','商品详情简介','参考成本价*','店铺价格*','市场价格*','商品贸易类型*','供应商名称*','供应商用户名*','供应商密码*','供应商报价');

//填充表头信息
for($i = 0;$i < count($tableheader);$i++) {
    $excel->getActiveSheet()->setCellValue("$letter[$i]","$tableheader[$i]");
}

$sql = "SELECT  FROM mallbuilder_product LIMIT 1";
//表格数组
$data = array(
    array('1','小王','男','20','100','1','小王','男','20','100','1','小王','男','20','100','1','小王','男','20','100','1','小王','男','20','100','1','小王'),
    array('2','小李','男','20','101','2','小李','男','20','101','2','小李','男','20','101','2','小李','男','20','101','2','小李','男','20','101','2','小李'),
    array('3','小张','女','20','102','3','小张','女','20','102','3','小张','女','20','102','3','小张','女','20','102','3','小张','女','20','102','3','小张'),
    array('4','小赵','女','20','103','4','小赵','女','20','103','4','小赵','女','20','103','4','小赵','女','20','103','4','小赵','女','20','103','4','小赵')
);
//填充表格信息
for ($i = 2;$i <= count($data) + 1;$i++) {
    $j = 0;
    foreach ($data[$i - 2] as $key=>$value) {
        $excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
        $j++;
    }
}

//创建Excel输入对象
$write = new PHPExcel_Writer_Excel5($excel);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0")  ;
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");
header('Content-Disposition:attachment;filename="testdata.xls"');
header("Content-Transfer-Encoding:binary");
$write->save('php://output');

?>