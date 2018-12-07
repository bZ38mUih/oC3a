<?php
$h1 ="Дневник";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
    "<meta name='description' content='Заметки, планы, мировозрение' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='yandex-verification' content='e929004ef40cae1b' />".
    "<meta name='robots' content='noindex'>".
    "<title>Дневник</title>".
    "<link rel='SHORTCUT ICON' href='/site/landing/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/diary/styles/main.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
    "<script src='/site/diary/js/main.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='mainMenu'>".
    "<a href='#' id='daily' onclick='subMemu(this.id)'><img src='/site/diary/img/dialy-menu.png'>-Daily</a>".
    "<a href='#' id='quarterly' onclick='subMemu(this.id)'><img src='/site/diary/img/quarter-menu.png'>-Quarterly</a>".
    "<a href='#' id='yearly' onclick='subMemu(this.id)'><img src='/site/diary/img/year-menu.jpg'>-Yearly</a>".
    "<a href='#' id='conception' onclick='subMemu(this.id)'><img src='/site/diary/img/conception-menu.png'>-Conception</a>".
    "<div class='subMenu'>Воспользуйтесь меню для начала работы</div>".
    "</div>".
    "<div class='leftPanel'></div>".
    "<div class='middlePanel'></div>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";
