<?php
$h1 ="Диагностика Windows - Анализ";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Проверка процессов и служб windows'/>".
    "<title>Win-diag</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-diag/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/win-diag/js/win-diag.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-diag/views/diagMenu.php");
//$appRJ->response['result'].= "<form><input type='file' onchange='loadDiagFile()' accept='file_extension image/jpeg,image/png,image/gif'></form>";
$appRJ->response['result'].= "<form class='diagSl'>".
    "<div class='input-line'><input type='file' onchange='loadDiagFile()' accept='application/JSON'></div>".
    "<div class='input-line'><input type='text' value=''>Поиск</div>".
    "</form>".
"<div class='diagResults'></div>";
/*
$appRJ->response['result'].= "<div class='diagMenu'>".
    "<a href='/win-diag'>Анализ</a>".
    "<a href='/win-diag/enviropment'>перОкружения</a>".
    "<a href='/win-diag/hardware'>Аппаратура</a>".
    "<a href='/win-diag/process'>Процессы</a>".
    "<a href='/win-diag/services'>Службы</a>";
*/
$appRJ->response['result'].= "</div></div></div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";