<?php
$h1 ="wiMan - edit OS";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование OS'/>".
    "<meta name='robots' content='noindex'>".
    "<title>wiMan-edit OS</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<script type='text/javascript' src='/site/win-pc-info/js/wiMan-edit.js'></script>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/wdEdit.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
$appRJ->response['result'].="<div class='wdEdit'>";
$appRJ->response['result'].= "<div class='info-line'><span class='fName'>osName:</span><span class='fVal'>".
    $slEnv_row['osName']."</span></div>".
    "<div class='info-line'><span class='fName'>osVal:</span><span class='fVal'>".
    $slEnv_row['osVal']."</span></div>";
$appRJ->response['result'].= "<form class='wdEditParams'>".
    "<div class='field-err'></div>".
    "<div class='input-line'><label>lastMod</label><input type='date' name='lastMod' value='".$slEnv_row['lastMod']."'></div>".
    "<textarea name='osDescr'>".$slEnv_row['osDescr']."</textarea>".
    "<input type='hidden' name='osEdit' value='yyy'>".
    "<input type='hidden' name='osName' value='".$slEnv_row['osName']."'>".
    "<input type='hidden' name='osVal' value='".$slEnv_row['osVal']."'>".
    "<div class='input-line'><input type='button' value='Сохранить' onclick='editDescr()'></div>".
    "</form>";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";