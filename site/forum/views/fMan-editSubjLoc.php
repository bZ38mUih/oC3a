<?php
$h1 ="Местоположение";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Местоположение'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Местоположение</title>".
    "<link rel='SHORTCUT ICON' href='/site/forum/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    //"<script type='text/javascript' src='/site/forum/js/fMan-sDescr.js'></script>".
    //"<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".

    //"<script src='https://api-maps.yandex.ru/2.1/?apikey=<ваш API-ключ>&lang=ru_RU' type='text/javascript'>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subjContentMenu.php");
$appRJ->response['result'].= "<form class='s-descr'>".
    "<div id='map' style='width: 600px; height: 400px'></div>".
    //"<input type='hidden' name='fs_id' value='".$Subj_rd['result']['fs_id']."'>".
    //"<input type='hidden' name='flagField' value='longDescr'>".
    //"<textarea name='longDescr'>".$Subj_rd['result']['longDescr']."</textarea>".
    "<div class='input-line'><input type='button' value='save' onclick='updateSDescr()'></div>".
    "</form>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";