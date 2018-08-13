<?php
$h1 ="Форум";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Обсуждение тем' http-equiv='Content-Type' charset='charset=utf-8'>";
//$appRJ->response['result'].= "<meta name='yandex-verification' content='02913709ba09b678' />";
$appRJ->response['result'].= "<title>Форум</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/forum/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/landing/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
//$appRJ->response['result'].= "<link rel='stylesheet' href='/modules/landing/css/main.css' type='text/css' media='screen, projection'/>";
//$appRJ->response['result'].= "<script type='text/javascript' src='/site'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";

