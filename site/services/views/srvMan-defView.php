<?php
$h1 ="Управление услугами";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Управление услугами' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Управление услугами</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>".
    /*toDo common style dwlMan.css*/
    "<link rel='stylesheet' href='/site/downloads/css/dwlMan.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subMenu.php");
$appRJ->response['result'].="Воспользуйтесь меню для начала работы".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";