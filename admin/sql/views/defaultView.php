<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Управление сайтом'/>".
    "<meta name='robots' content='noindex'>".
    "<title>".$adminModules[$adminModule]['aliasMenu']."</title>".
    "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/adminHeader/js/adminHeader.js'></script>".
    "<link rel='stylesheet' href='/admin/sql/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/sql/js/default.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminHeader/views/adminHeader.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<form><label for='tagretQuery'>Введите запрос:</label><textarea name='tagretQuery' rows='5'></textarea></form>".
    "<div class='queryPanel'><div class='queryPanel-left'><span class='resTxt'>Результат: </span>".
    "<div class='queryResults'>-</div></div><div class='queryPanel-right'>".
    "<input type='button' value='mkQuery' onclick='mkQuery()'></div></div>";

$appRJ->response['result'].= "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");
$appRJ->response['result'].= "</body></html>";