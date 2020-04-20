<?php
$h1 ="Diary";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
    "<meta name='robots' content='noindex'>".
    "<title>the D</title>".
    "<link rel='SHORTCUT ICON' href='/site/d/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/d/css/diaryHeader.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/mainDMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/dFooter.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/diaryHeader.php");
$appRJ->response['result'].="<div class='contentBlock-frame'><div class='contentBlock-center'><div class='mainDMenu'>";
foreach ($result as $k=>$v) {
    $appRJ->response['result'].=
        "<div class='dMenu-item'>".
        "<div class='dMenu-item-header'><h2>".$k."</h2></div>".
        "<div class='dMenu-item-img' style='background-image: url(/site/d/img/".$k."-menu.png)'>".
        "<span class='dSince'>".$v['noteDate']."</span>".
        "<span class='drCnt'>".$v['diaryCnt']."</span>".
        "<span class='dnCnt'>".$v['notesCnt']."</span>".
        "</div>".
        "<div class='dMenu-item-btn'>".
        "<a href='/d/newDiary?diaryType=".$k."'>new note</a>".
        "<a href='/d/".$k."/lastNote'>last note</a>".
        "<a href='/d/".$k."/findNote'>find note</a>".
        "</div>".
        "</div>";
}
$appRJ->response['result'].="</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dFooter.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";