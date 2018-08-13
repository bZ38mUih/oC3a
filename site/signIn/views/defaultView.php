<?php
$h1='Вход на сайт';
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Вход на сайт' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Вход на сайт</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/signIn/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<script src='/source/js/jquery.cookie.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/signIn/css/defaultForm.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/signIn/js/default.js'></script>";
if($method === 'site'){
    $appRJ->response['result'].= "<script type='text/javascript' src='/site/signIn/js/site.js'></script>";
}
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";

$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/signIn-frame.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";