<?php
$tFile = $_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/parseLog.txt";
//print_r($tFile);
//echo date ("F d Y H:i:s.", filemtime($tFile));
//exit;
$parseRes=null;
$parseList_text="select * from parseAdList_dt ORDER BY adDate ASC ";
$parseList_res=$DB->doQuery($parseList_text);
if(mysql_num_rows($parseList_res)>0){
    $adCount=0;
    while($parseList_row=$DB->doFetchRow($parseList_res)){
        $adCount++;
        $parseRes.="<div class='line ad'><div class='content-wrap'> ".
            "<div class='ad_id'><a href='https://avito.ru/".$parseList_row['prodRef']."' target='_blank'>".$adCount."</a></div>".
            "<div class='prodName'>".$parseList_row['prodName']."</div><div class='prodComp'>";
        if($parseList_row['prodComp']){
            $parseRes.=$parseList_row['prodComp'];
        }else{
            $parseRes.=" - ";
        }
        $parseRes.="</div>".
            "<div class='prodSaler'>".$parseList_row['prodSaler']."</div>".
            "<div class='prodPrice'>".$parseList_row['prodPrice']."</div></div>".
            "<div class='adInfo'><span>Распарсил: ".$parseList_row['adDate']."</span><span>Коммент: ".$parseList_row['comment']."</span></div>".
            "<div class='control-wrap'><span>Показать</span></div>".
            "<div class='prodDescr'>".$parseList_row['prodDescr']."</div>".
            "</div></div>";
    }
}
if($parseLog_txt=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/parseLog.txt")){
    if(!$parseLog_arr=json_decode($parseLog_txt, true)){
        $appRJ->errors['request']['description']="невозможно разобрать parseLog.txt";
        $appRJ->throwErr();
    }
}else{
    $appRJ->errors['request']['description']="невозможно прочитать файл parseLog.txt";
    $appRJ->throwErr();
}
/*
foreach($parseLog_arr as $key=>$value){
    echo "<p>"
}
Array ( [noutbuki] => Array ( [err] => max sussCnt
[totalCnt] => 7 [doubleCnt] => 3 [sussCnt] => 4 ) [planshety_i_elektronnye_knigi] => Array ( [err] => max sussCnt
[totalCnt] => 8 [doubleCnt] => 4 [sussCnt] => 4 ) [telefony] => Array ( [err] => max sussCnt
[totalCnt] => 7 [doubleCnt] => 3 [sussCnt] => 4 ) )
*/
$logRes="<div class='logRes'>".
"<h3>Обновлено: ".date ("F d Y H:i:s.", filemtime($tFile))."</h3>";
foreach($parseLog_arr as $key=>$value){
    $logRes.="<div class='logType'>";
    $logRes.="<span>".$key."</span>";
    foreach($value as $subKey=>$subVal){
        $logRes.="<div class='log-type-res'>".$subKey."-".$subVal."</div>";
    }
    $logRes.="</div>";
}
$logRes.="</div>";
$h1 ="Парсинг объявлений";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Парсинг объявлений на примере avito.ru'/>".
    "<title>Парсинг объявлений</title>".
    "<link rel='SHORTCUT ICON' href='/site/parse-ad/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";

if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    //"<script src='/site/js/list-view.js'></script>".
    "<script src='/site/parse-ad/js/parse-ad.js'></script>".
    //"<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/parse-ad/css/parse-ad.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
$logRes.
"<div class='line ad caption'><div class='ad_id'>ad_id</div><div class='prodName'>prodName</div>".
    "<div class='prodComp'>prodComp</div><div class='prodSaler'>prodSaler</div>".
    "<div class='prodPrice'>prodPrice</div>".
    "</div>";
$appRJ->response['result'].= $parseRes."</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";