<?php
$h1 =$Art_rd['result']['artName'];

$fndP=false;
$slArtP_qry="select * from artLinks_dt WHERE art_id=".$_GET['art_id']." and linkType='page'";
$slArtP_res=$DB->query($slArtP_qry);
if(mysql_num_rows($slArtP_res)==1){
    $slArtP_row = $slArtP_res->fetch(PDO::FETCH_ASSOC);
    $fndP=true;
}

$slArtSt_qry="select * from artLinks_dt WHERE art_id=".$_GET['art_id']." and linkType='style'";
$slArtSt_res=$DB->query($slArtSt_qry);
if(mysql_num_rows($slArtSt_res)==1){
    $slArtSt_row = $slArtSt_res->fetch(PDO::FETCH_ASSOC);
    $fndSt=true;
}

$slArtScr_qry="select * from artLinks_dt WHERE art_id=".$_GET['art_id']." and linkType='script'";
$slArtScr_res=$DB->query($slArtScr_qry);
if(mysql_num_rows($slArtScr_res)==1){
    $slArtScr_row = $slArtScr_res->fetch(PDO::FETCH_ASSOC);
    $fndScr=true;
}

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Предпросмотр статьи' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<title>artMan-preview</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/artMan/css/preview.css' type='text/css' media='screen, projection'/>";
if($fndSt){
    $appRJ->response['result'].= "<link rel='stylesheet' href='".ARTS_IMG_PAPH.$_GET['art_id']."/style/".$slArtSt_row['linkRef']."' type='text/css' media='screen, projection'/>";
}
if($fndScr){
    $appRJ->response['result'].= "<script src='".ARTS_IMG_PAPH.$_GET['art_id']."/script/".$slArtScr_row['linkRef']."'></script>";
}
$appRJ->response['result'].= "</head>";
$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='art-header'>";
$appRJ->response['result'].="<div class='art-header-img'>";
$appRJ->response['result'].="<img src='".ARTS_IMG_PAPH.$_GET['art_id']."/preview/".$Art_rd['result']['artImg']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].="<div class='art-header-descr'>";
$appRJ->response['result'].="<h2>".$Art_rd['result']['artMeta']."</h2>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='art-content'>";

if($fndP){
    $appRJ->response['result'].=file_get_contents($_SERVER['DOCUMENT_ROOT'].ARTS_IMG_PAPH.$_GET['art_id'].
        "/page/".$slArtP_row['linkRef']);
}else{
    $appRJ->response['result'].='нет ченовика статьи';
}
$appRJ->response['result'].= "</div>";


$refList_text="select * from artRef_dt WHERE art_id='".$_GET['art_id']."' order by artRef_id DESC";
$refList_res=$DB->query($refList_text);
$refList_count=mysql_num_rows($refList_res);
if($refList_count>0){
    $appRJ->response['result'].= "<div class='art-ref'>";
    $appRJ->response['result'].= "<h5>Ссылки:</h5>";

    $appRJ->response['result'].= "<ol>";
    while($refList_row = $refList_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].= "<li><a href='".$refList_row['refLink']."' title='".$refList_row['refLink']."' target='_blank'>".
            $refList_row['refText']."</a></li>";
    }
    $appRJ->response['result'].= "</ol>";
    $appRJ->response['result'].= "</div>";
}


$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";