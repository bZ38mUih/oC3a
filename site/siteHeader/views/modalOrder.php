<?php
$appRJ->response['result'].= "<div class='modal order'>";
$appRJ->response['result'].= "<div class='overlay'></div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";

$appRJ->response['result'].= "<div class='modal-right'>";
$appRJ->response['result'].= "<div class='modal-close'></div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='modal-left'>";
$appRJ->response['result'].= "<div class='modal-line'>";
$appRJ->response['result'].= "<div class='modal-line-img'>";
$appRJ->response['result'].= "<img src='/site/status/img/logo-".$actStat['stName'].".png'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='modal-line-text ".$actStat['stName']."'>";
$appRJ->response['result'].=$actStat['descr'];
$appRJ->response['result'].= "<div>";
if($appRJ->server['reqUri_expl'][1] != "status"){
    $appRJ->response['result'].= "<div class='details'>";
    $appRJ->response['result'].= "<a href='/status' title='Статус'>Подробнее</a>";
    $appRJ->response['result'].= "</div>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='modal-line'>";
$appRJ->response['result'].= "<div class='modal-line-img'>";
$appRJ->response['result'].= "<img src='/site/siteHeader/img/Email-Logo-color.png'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='modal-line-text mail'>";
$appRJ->response['result'].= "<span>rightjoint@yandex.ru</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

if($appRJ->server['reqUri_expl'][1]!='references'){
    $appRJ->response['result'].= "<div class='modal-line'>";
    $appRJ->response['result'].= "<div class='modal-line-img'>";
    $appRJ->response['result'].= "<img src='/site/references/img/logo.png'>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='modal-line-text ref'>";
    $appRJ->response['result'].= "<a href='/references' title='Посмотреть отзывы, написать отзыв'>Отзывы</a>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
}

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";