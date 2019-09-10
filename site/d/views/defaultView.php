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

$appRJ->response['result'].=
    "<div class='mainDMenu'>".
    "<div class='dMenu-item'>".
    "<div class='dMenu-item-header'><h2>Daily</h2></div>".
    "<div class='dMenu-item-img' style='background-image: url(/site/d/img/daily-menu.png)'>".
    "<span class='dSince'>".$firstDailyNt_row['noteDate']."</span>".
    "<span class='drCnt'>".$countDailyDiary_row['cnt']."</span>".
    "<span class='dnCnt'>".$countDailyNt_row['cnt']."</span>".
    "</div>".
    "<div class='dMenu-item-btn'>".
    "<a href='/d/newDiary?diaryType=daily'>new note</a>".
    "<a href='/d/daily/lastNote'>last note</a>".
    "<a href='/d/daily/findNote'>find note</a>".
    "</div>".
    "</div>".

    "<div class='dMenu-item'>".
    "<div class='dMenu-item-header'><h2>Quarterly</h2></div>".
    "<div class='dMenu-item-img' style='background-image: url(/site/d/img/quarter-menu.png)'>".
    "<span class='dSince'>".$firstQtNt_row['noteDate']."</span>".
    "<span class='drCnt'>".$countQtDiary_row['cnt']."</span>".
    "<span class='dnCnt'>".$countQtNt_row['cnt']."</span>".
    "</div>".
    "<div class='dMenu-item-btn'>".
    "<a href='/d/quarterly/newNote'>new note</a>".
    "<a href='/d/quarterly/lastNote'>last note</a>".
    "<a href='/d/quarterly/findNote'>find note</a>".
    "</div>".
    "</div>".

    "<div class='dMenu-item'>".
    "<div class='dMenu-item-header'><h2>Yearly</h2></div>".
    "<div class='dMenu-item-img' style='background-image: url(/site/d/img/year-menu.jpg)'>".
    "<span class='dSince'>".$firstYrNt_row['noteDate']."</span>".
    "<span class='drCnt'>".$countYrDiary_row['cnt']."</span>".
    "<span class='dnCnt'>".$countYrNt_row['cnt']."</span>".
    "</div>".
    "<div class='dMenu-item-btn'>".
    "<a href='/d/yearly/newNote'>new note</a>".
    "<a href='/d/yearly/lastNote'>last note</a>".
    "<a href='/d/yearly/findNote'>find note</a>".
    "</div>".
    "</div>".


    "<div class='dMenu-item'>".
    "<div class='dMenu-item-header'><h2>Conception</h2></div>".
    "<div class='dMenu-item-img' style='background-image: url(/site/d/img/conception-menu.png)'>".
    "<span class='dSince'>".$firstCnNt_row['noteDate']."</span>".
    "<span class='drCnt'>".$countCnDiary_row['cnt']."</span>".
    "<span class='dnCnt'>".$countCnNt_row['cnt']."</span>".
    "</div>".
    "<div class='dMenu-item-btn'>".
    "<a href='/d/conception/newNote'>new note</a>".
    "<a href='/d/conception/lastNote'>last note</a>".
    "<a href='/d/conception/findNote'>find note</a>".
    "</div>".
    "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dFooter.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";