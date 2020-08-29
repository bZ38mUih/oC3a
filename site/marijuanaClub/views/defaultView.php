<?php
$h1='Marijuana Club - Сводка';
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Вход на сайт. Авторизация через социальные сети или аккаунт на rightjoint.ru' />".
    "<meta name='robots' content='noindex'>".
    "<title>MarijuanaClub - Сводка</title>".
    "<link rel='SHORTCUT ICON' href='/site/marijuanaClub/img/logo.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/signIn/css/defaultForm.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/signIn/js/default.js'></script>";

$appRJ->response['result'].=
    "<link rel='stylesheet' href='/source/js/jQueryUI/jquery-ui.css'>".
    //"<link rel='stylesheet' href='/resources/demos/style.css'>".
    //"<script src='https://code.jquery.com/jquery-1.12.4.js'></script>".
    "<script src='/source/js/jQueryUI/jquery-1.12.4.js'></script>".
    "<script src='/source/js/jQueryUI/jquery-ui.js'></script>";
$appRJ->response['result'].= "<script src='/site/marijuanaClub/js/growBox.js'></script>";
if($signInActiveSite){
    $appRJ->response['result'].= "<script type='text/javascript' src='/site/signIn/js/site.js'></script>";
}
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/marijuanaClub/css/growBox.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
//require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/signIn-frame.php");

$appRJ->response['result'].= "<div class='mc-wrap'>".
    "<div class='mc-container-wrap gbLights'><div class='mc-container'>".

    "<div class='mode-controls'>".
    "<div class='mode-controls-btn-wrap'>".
    "<div class='mode-controls-btn mcBtnDelete'>".
    //"<a href='javaScrip: void(0)' onclick = 'modeGbRemove(".$gbSchedule['result']['sch_id'].")' class='create-btn'><img src='/source/img/drop-icon.png'> - Delete</a>".
    "</div>".
    "<div class='mode-controls-btn mcBtnCreate'>".
    "<a href='/marijuanaClub/gbLamps' class='create-btn'><img src='/source/img/create-icon.png'> - Lamps</a>".
    "</div>".
    "<div class='mode-controls-btn mcBtnCreate'>".
    "<a href='/marijuanaClub/gbLightsModels' class='create-btn'><img src='/source/img/create-icon.png'> - Models</a>".
    "</div>"."</div>".

    "</div></div>".
    "<div class='mc-container-wrap gbMode'>".$showGbMode."</div>".
    "<div class='mc-container-wrap gbNote'>".$showGbNote."</div>".
    "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
$appRJ->response['result'].= "</body></html>";