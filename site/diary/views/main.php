<?php
$h1 ="Дневник";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Заметки, планы, мировозрение' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='yandex-verification' content='e929004ef40cae1b' />";
$appRJ->response['result'].= "<title>Дневник</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/landing/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/diary/styles/main.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>";
$appRJ->response['result'].= "<script src='/site/diary/js/main.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='mainMenu'>";
$appRJ->response['result'].= "<a href='#' id='daily' onclick='subMemu(this.id)'>DailyReports</a>";
$appRJ->response['result'].= "<a href='#' id='quarterly' onclick='subMemu(this.id)'>quarterReports</a>";
$appRJ->response['result'].= "<a href='#' id='yearly' onclick='subMemu(this.id)'>yearReports</a>";
$appRJ->response['result'].= "<a href='#' id='conception' onclick='subMemu(this.id)'>Conception</a>";
$appRJ->response['result'].= "<div class='subMenu'>";
$appRJ->response['result'].= "Воспользуйтесь меню для начала работы";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='leftPanel'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='middlePanel'>";
//require_once($_SERVER['DOCUMENT_ROOT']."/site/diary/views/diaryNote_new.php");
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";


require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";