<?php
$h1 ="Загрузки";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Системное, офисное, разработка, популяное ПО. Ссылки на загрузки программ.'/>".
    "<title>Загрузки</title>".
    "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/downloads/css/defaultView.css' type='text/css' media='screen, projection'/>".
    "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
$selectCat_query = "select * from dwlCat_dt WHERE dwlCatPar_id is null and catActive_flag is TRUE";
$selectCat_res=$DB->query($selectCat_query);
$catCount = $selectCat_res->rowCount();
$appRJ->response['result'].= "<div class='cat-frame'>";
if($catCount>0){
    while ($selectCat_row = $selectCat_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].= "<a href='/downloads/".$selectCat_row['catAlias']."' class='cat-line'>".
            "<div class='cat-line-img'>";
        if($selectCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectCat_row['dwlCat_id']."/preview/".$selectCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='cat-line-txt'>".
            "<div class='cat-line-name'>".
            $selectCat_row['catName'].
            "</div>".
            "<div class='cat-line-descr'>";
        if($selectCat_row['catDescr']){
            $appRJ->response['result'].= $selectCat_row['catDescr'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>".
            "</div>".
            "</a>";
    }
}else{
    $appRJ->response['result'].= "there is no categ there<br>";
}
$appRJ->response['result'].= "</div>".
    "</div>".
    "</div>".
    "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body>".
    "</html>";