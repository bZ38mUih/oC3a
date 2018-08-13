<?php
$h1 ="Фото к теме";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Редактирование фоток к теме' http-equiv='Content-Type' charset='charset=utf-8'>";
//$appRJ->response['result'].= "<meta name='yandex-verification' content='02913709ba09b678' />";
$appRJ->response['result'].= "<title>Фото к теме</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/forum/css/editSubjDescrForm.css' type='text/css' media='screen, projection'/>";
//$appRJ->response['result'].= "<link rel='stylesheet' href='/site/forum/css/subjEditMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "<script src='/source/js/tinymce/tinymce.min.js'></script>";
$appRJ->response['result'].= "<script src='/site/forum/js/main.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subjContentMenu.php");

$appRJ->response['result'].= "<form class='editSubjDescr' method='post'>";
if(isset($subjErr['common']) and $subjErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($subjErr['common']) and $subjErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editSubjDescr'>";

$appRJ->response['result'].= "<label for='catName'>Тема:</label>";
$appRJ->response['result'].= "<a href='/forum/forumManager/editSubject/?subj_id=".$Subj_rd->result['subject_id']."'>";
if($Subj_rd->result['subjName']){
    $appRJ->response['result'].= $Subj_rd->result['subjName'];
}else{
    $Subj_rd->result['subject_id'];
}
$appRJ->response['result'].= "</a>";

$appRJ->response['result'].= "<label for='subjDescr'>Описание:</label>";
$appRJ->response['result'].= "<textarea name='subjDescr'>";
if($Descr_rd->result['subjectDescr']){
    $appRJ->response['result'].= $Descr_rd->result['subjectDescr'];
}
$appRJ->response['result'].= "</textarea>";

$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<input type='submit' value='save'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";