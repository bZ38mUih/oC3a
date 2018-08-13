<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/printList.php");

$h1 ="Список статей";
$App['views']['social-block']=true;

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Статьи по разработке. Список статей и категорий' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<title>Разработка</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/dev/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";

if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}

$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<script src='/site/js/list-view.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='list-frame'>";

$prtLst= printList(3, $DB, $appRJ->server['reqUri_expl'][1]);

$appRJ->response['result'].= "<div class='cat-stat main'>";
if(isset($prtLst['cntItm']) or isset($prtLst['cntCat'])){
    $appRJ->response['result'].= "<strong>Всего: </strong>";
    if($prtLst['cntItm']){
        $appRJ->response['result'].= "<span class='flVal'>".$prtLst['cntItm']."</span> стат.";
    }
    if($prtLst['cntCat']){
        $appRJ->response['result'].= "<span class='flVal'>".$prtLst['cntCat']."</span> кат.";
    }
}
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= $prtLst['text'];

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";