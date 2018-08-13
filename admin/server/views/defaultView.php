<?php
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";

$appRJ->response['result'].= "<meta name='description' content='Управление сайтом' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>";
$appRJ->response['result'].= $adminModules[$adminModule]['aliasMenu'];
$appRJ->response['result'].= "</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>";

$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/admin/adminHeader/js/adminHeader.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/server/css/serverDefault.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/admin/server/js/serverDefault.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";

$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

$appRJ->response['result'].= "<div class='contentBlock-frame dark'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminHeader/views/adminHeader.php");
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<hr>";

$appRJ->response['result'].= "<div class='statusPanel'>";
require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/statusView.php");
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<hr>";

$appRJ->response['result'].= "<div class='settingsPanel'>";
require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<hr>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";
?>