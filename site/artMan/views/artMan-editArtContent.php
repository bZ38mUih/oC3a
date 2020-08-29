<?php
$h1 ="Правка контента статьи";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Правка контента статьи' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>artMan</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/artMan/css/refForm.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/artMan/js/loadPage.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "</head>";
$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subContentMenu.php");
$appRJ->response['result'].= "<form>";
$fndP=false;
$appRJ->response['result'].= "<div class='load-page page'>";
$appRJ->response['result'].= "<h4>Load page</h4>";
$appRJ->response['result'].= "<div class='ref-list'>";
$slArtLk_qry="select * from artLinks_dt WHERE art_id=".$_GET['art_id']." and linkType='page'";
$slArtLk_res=$DB->query($slArtLk_qry);
if($slArtLk_res->rowCount() == 1){
    $slArtLk_row = $slArtLk_res->fetch(PDO::FETCH_ASSOC);
    $appRJ->response['result'].= "<a href='".ARTS_IMG_PAPH.$_GET['art_id']."/page/".$slArtLk_row['linkRef'].
        "' target='_blank'>".$slArtLk_row['linkRef']."</a>";
    $fndP=true;
}else{
    $appRJ->response['result'].= "there is no links for page";
}
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "<div class='ref-control'>";
$appRJ->response['result'].= "<div class='ref-control-left'>";
if($fndP){
    $appRJ->response['result'].= "<span onclick='delPage(".'"page"'. ")'><img src='/source/img/drop-icon.png'>Удалить</span>";
}
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "<div class='ref-control-right'>";
$appRJ->response['result'].= "<input type='file' onchange='loadPage(".'"page"'.")' accept='.html'>";
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '<hr>';
$fndSt=false;
$appRJ->response['result'].= "<div class='load-page style'>";
$appRJ->response['result'].= "<h4>Load style</h4>";
$appRJ->response['result'].= "<div class='ref-list'>";
$slArtLk_qry="select * from artLinks_dt WHERE art_id=".$_GET['art_id']." and linkType='style'";
$slArtLk_res=$DB->query($slArtLk_qry);
if($slArtLk_res->rowCount() == 1){
    $slArtLk_row = $slArtLk_res->fetch(PDO::FETCH_ASSOC);
    $appRJ->response['result'].= "<a href='".ARTS_IMG_PAPH.$_GET['art_id']."/style/".$slArtLk_row['linkRef'].
        "' target='_blank'>".$slArtLk_row['linkRef']."</a>";
    $fndSt=true;
}else{
    $appRJ->response['result'].= "there is no links for style";
}
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "<div class='ref-control'>";
$appRJ->response['result'].= "<div class='ref-control-left'>";
if($fndSt){
    $appRJ->response['result'].= "<span onclick='delPage(".'"style"'. ")'><img src='/source/img/drop-icon.png'>Удалить</span>";
}
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "<div class='ref-control-right'>";
$appRJ->response['result'].= "<input type='file' onchange='loadPage(".'"'."style".'"'.")' accept='.css'>";
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '<hr>';
$fndScr=false;
$appRJ->response['result'].= "<div class='load-page script'>";
$appRJ->response['result'].= "<h4>Load script</h4>";
$appRJ->response['result'].= "<div class='ref-list'>";
$slArtLk_qry="select * from artLinks_dt WHERE art_id=".$_GET['art_id']." and linkType='script'";
$slArtLk_res=$DB->query($slArtLk_qry);
if($slArtLk_res->rowCount() == 1){
    $slArtLk_row = $slArtLk_res->fetch(PDO::FETCH_ASSOC);
    $appRJ->response['result'].= "<a href='".ARTS_IMG_PAPH.$_GET['art_id']."/script/".$slArtLk_row['linkRef'].
        "' target='_blank'>".$slArtLk_row['linkRef']."</a>";
    $fndScr=true;
}else{
    $appRJ->response['result'].= "there is no links for script";
}
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "<div class='ref-control'>";
$appRJ->response['result'].= "<div class='ref-control-left'>";
if($fndScr){
    $appRJ->response['result'].= "<span onclick='delPage(".'"script"'. ")'><img src='/source/img/drop-icon.png'>Удалить</span>";
}
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "<div class='ref-control-right'>";
$appRJ->response['result'].= "<input type='file' onchange='loadPage(".'"'."script".'"'.")' accept='.js'>";
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";