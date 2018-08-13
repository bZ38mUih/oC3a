<?php
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";

$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Управление сайтом' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Tables</title>";

$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>";

$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/admin/adminHeader/js/adminHeader.js'></script>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/admin/tables/css/tables.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' id='menu_script' src='/admin/tables/js/tables.js'></script>";

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

$appRJ->response['result'].= "<div class='optionsPanel'>";

$appRJ->response['result'].= "<div class='uploadOptions'>";
$appRJ->response['result'].= "<label for='prefixTag'>pefix</label><input type='text' name='prefixTag'>";
$appRJ->response['result'].= "<label for='dateTag'>dateTag</label>";
$appRJ->response['result'].= "<input type='checkbox' name='dateTag' checked>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='btnPanel'>";
$appRJ->response['result'].= "<input type='button' class='uploadAll' value='upLoadAll' onclick='tables(" . '"upLoadAll"' . ")'>";
$appRJ->response['result'].= "<input type='button' class='refresh' value='refresh' onclick='refreshTables()'>";
$appRJ->response['result'].= "<input type='button' class='showLog' value='Log' onclick='showLog()'>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='tablesList'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tables/actions/tablesView.php");
$appRJ->response['result'].= $tables->result['log'];
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='modal'>";
$appRJ->response['result'].= "<div class='overlay'></div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";

$appRJ->response['result'].= "<div class='modal-right'>";
$appRJ->response['result'].= "<img src='/source/img/closeModal.png' title='закрыть'>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='logPanel'>";
$appRJ->response['result'].= "<h3>action log:</h3>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");
$appRJ->response['result'].= "</body>";
