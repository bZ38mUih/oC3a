<?php

$h1 ="Загрузки";
$App['views']['social-block']=true;

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Системное, офисное, разработка, популяное ПО. Ссылки на загрузки программ.' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<title>Загрузки</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";

if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}

$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/downloads/css/defaultView.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$selectCat_query = "select * from dwlCat_dt WHERE dwlCatPar_id is null and catActive_flag is TRUE";
$selectCat_res=$DB->doQuery($selectCat_query);
$catCount=0;
if(mysql_num_rows($selectCat_res)>0){
    $catCount=mysql_num_rows($selectCat_res);
}
$appRJ->response['result'].= "<div class='cat-frame'>";
if($catCount>0){
    while ($selectCat_row=$DB->doFetchRow($selectCat_res)){
        $appRJ->response['result'].= "<a href='/downloads/".$selectCat_row['catAlias']."' class='cat-line'>";
        $appRJ->response['result'].= "<div class='cat-line-img'>";
        if($selectCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectCat_row['dwlCat_id']."/preview/".$selectCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='cat-line-txt'>";
        $appRJ->response['result'].= "<div class='cat-line-name'>";
        $appRJ->response['result'].= $selectCat_row['catName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='cat-line-descr'>";
        if($selectCat_row['catDescr']){
            $appRJ->response['result'].= $selectCat_row['catDescr'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</a>";
    }
}else{
    $appRJ->response['result'].= "there is no categ there<br>";
}
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";