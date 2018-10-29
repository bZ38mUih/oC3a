<?php
$h1 ="Сравнение диаг-файлов";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Сравнение диаг-файлов'/>";
if($_GET['envList_id']){
    $appRJ->response['result'].= "<meta name='robots' content='noindex'>";
}
$appRJ->response['result'].= "<title>Compare</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/win-pc-info/js/wi-form.js'></script>" .
    "<script src='/site/win-pc-info/js/wdCompare.js'></script>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/compareView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/win-pc-info/css/wi-default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='lrp-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMenu.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareMenu.php");
$appRJ->response['result'].="<div class='cmp-res'>";
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareResults.php");
$appRJ->response['result'].= "</div></div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";