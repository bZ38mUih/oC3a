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

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/sql/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/admin/sql/js/default.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/queryPrint/css/queryPrint.css' type='text/css' media='screen, projection'/>";

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

$appRJ->response['result'].= "<form>";
$appRJ->response['result'].= "<label for='tagretQuery'>SELECT </label>";
$appRJ->response['result'].= "<textarea name='tagretQuery' rows='5'>";

$appRJ->response['result'].= "</textarea>";
$appRJ->response['result'].= "</form>";

$appRJ->response['result'].= "<div class='queryPanel'>";

$appRJ->response['result'].= "<div class='queryPanel-left'>";
$appRJ->response['result'].= "<span class='resTxt'>Результат: </span>";
$appRJ->response['result'].= "<div class='queryResults'>";
$appRJ->response['result'].= "-";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='queryPanel-right'>";
$appRJ->response['result'].= "<input type='button' value='mkQuery' onclick='mkQuery()'>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='res-frame'>";

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";