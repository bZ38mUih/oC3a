<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Управление сайтом' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>".$adminModules[$adminModule]['aliasMenu']."</title>".
    "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/adminHeader/js/adminHeader.js'></script>".
    "<link rel='stylesheet' href='/admin/server/css/serverDefault.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/server/js/serverDefault.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>".
    "<div class='contentBlock-frame dark'><div class='contentBlock-center'><div class='contentBlock-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminHeader/views/adminHeader.php");
$appRJ->response['result'].= "</div></div></div>".
    "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'><hr>".
    "<div class='statusPanel'>";
require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/statusView.php");
$appRJ->response['result'].= "</div><hr><div class='settingsPanel'>";
require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
$appRJ->response['result'].= "</div><hr></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");
$appRJ->response['result'].= "</body></html>";
?>