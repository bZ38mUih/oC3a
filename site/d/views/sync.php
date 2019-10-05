<?php
$h1 ="Diary-sync";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
"<meta name='robots' content='noindex'>".
"<title>the D - sync</title>".
"<link rel='SHORTCUT ICON' href='/site/d/img/favicon.png' type='image/png'>".
"<script src='/source/js/jquery-3.2.1.js'></script>".
"<link rel='stylesheet' href='/site/d/css/diaryHeader.css' type='text/css' media='screen, projection'/>".
"<link rel='stylesheet' href='/site/d/css/mainDMenu.css' type='text/css' media='screen, projection'/>".
"<link rel='stylesheet' href='/site/d/css/dFooter.css' type='text/css' media='screen, projection'/>".
"<script src='/site/siteHeader/js/modalHeader.js'></script>".
"<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
"<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
"<script src='/site/d/js/syncD.js'></script>".
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/diaryHeader.php");
$appRJ->response['result'].="<div class='syncD'>".
    "<form>".
    "<label>dateFrom: <input type='date' name='dateFrom' value='".date( "Y-m-d", strtotime("-30 days"))."'></label>".
    "<label>dateTo: <input type='date' name='dateTo' value='".date_format( $appRJ->date['curDate'], "Y-m-d")."'></label>".
    "<input type='hidden' name='syncD' value='syncMe'>".
    "<span onclick='syncD(123)'>SyncMe</span>".

    "</form>".
    "<div class='syncRes'></div>".
    "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dFooter.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";