<?php
$h1 ="Редактирование услуги";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование услуги'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление услугами</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    //"<link rel='stylesheet' href='/site/services/css/srvMan-longDescr.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<script type='text/javascript' src='/site/services/js/srvMan-longDescr.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
    //"<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    //"<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subContentMenu.php");
$appRJ->response['result'].= "<form name='xyi' method='post'>".
    "<input type='hidden' name='flagField' value='longDescr'>".
    "<textarea name='longDescr'>";
if($Card_rd['result']['longDescr']){
    $appRJ->response['result'].= $Card_rd['result']['longDescr'];
}

$appRJ->response['result'].="</textarea>";

$appRJ->response['result'].="<div class='input-line'>".
    //"<span class='longDescr' onclick='longDescr()'>Сохр.</span></div>".
    "<input type='submit' onclick='tinymce.triggerSave()' value='Сохр.'>".
    "</form>";
$appRJ->response['result'].= "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";