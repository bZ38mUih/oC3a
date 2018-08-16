<?php
$h1 ="Услуги";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Услуги по созданию сайтов и ремонту компьютеров в г. Иваново' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Услуги</title>".
    "<link rel='SHORTCUT ICON' href='/site/status/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/status/css/status.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");


$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='srv-ln'>";
$appRJ->response['result'].= "<div class='srv-ln-im'>";
$appRJ->response['result'].= "<img src='/site/services/img/mazda323moon.JPG'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='srv-ln-txt'>";
$appRJ->response['result'].= "<span class='srv-nm'>Выезд к заказчику на час</span>";
$appRJ->response['result'].= "для консультации по части it-услуг, созданию сайта или ремонте компьютера";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
/*
$appRJ->response['result'].= "<div class='stat-block ".$actStat['stName']."'>";
$appRJ->response['result'].= "<span class='status'>".$actStat['alias']."</span>";
$appRJ->response['result'].= "<div class='stat-block-img'>";
$appRJ->response['result'].= "<img src='/site/status/img/logo-".$actStat['stName'].".png' ";
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "onclick='changeStatus()'";
}
$appRJ->response['result'].=">";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='stat-block-txt'>";
$appRJ->response['result'].= $actStat['descr'];
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='stat-descr'>";
$appRJ->response['result'].=$actStat['detail'];
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='contentBlock-frame dark'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='yMap-frame'>";
$appRJ->response['result'].= "<div class='yMap-wrap'>";

$appRJ->response['result'].= "<script type='text/javascript' charset='utf-8' async
src='https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2d466e2d4f1632789b9df6fd6d34e6e4f660b8caa1bed15db7a0dd231e4c7a31&amp;width=300&amp;height=300&amp;lang=ru_RU&amp;scroll=true'></script>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<img src='/site/status/img/demidova-10-img1.jpg' id='img1'>";
$appRJ->response['result'].= "<img src='/site/status/img/demidova-10-img2.jpg' id='img2'>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='descr-frame'>";
$appRJ->response['result'].= "<div class='descr-line'><img src='/site/siteHeader/img/site-logo.png'><span class='fmNm'>Right Joint</span></div>";
$appRJ->response['result'].= "<div class='descr-line'><span>Адрес:</span> г. Иваново, ул. Демидова, д. 10</div>";
$appRJ->response['result'].= "<div class='descr-line'><span>Режим работы:</span> пнд. - птн. с 9.00 до 18.00, сбт., вск. - выходной</div>";
$appRJ->response['result'].= "<div class='descr-line'><span>E-Mail:</span> rightjoint@yandex.ru</div>";
$appRJ->response['result'].= "<div class='locPr-block'>";
$appRJ->response['result'].= "<img src='/site/status/img/yMap.png' id='yMap-lk' class='active' onclick='showLoc(".'"'."yMap".'"'.")'>";
$appRJ->response['result'].= "<img src='/site/status/img/demidova-10-img1.jpg' id='img1-lk' onclick='showLoc(".'"'."img1".'"'.")'>";
$appRJ->response['result'].= "<img src='/site/status/img/demidova-10-img2.jpg' id='img2-lk' onclick='showLoc(".'"'."img2".'"'.")'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='add-ref'>";
$appRJ->response['result'].= "<a href='/services'><img src='/site/services/img/logo.png'>Все услуги</a>";
$appRJ->response['result'].= "<a href='/forum/faq'><img src='/site/status/img/faq.jpg'>Часто задаваемые вопросы</a>";
$appRJ->response['result'].= "<a href='/references'><img src='/site/references/img/logo.png'>Отзывы</a>";
$appRJ->response['result'].= "</div>";
*/
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";