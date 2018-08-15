<?php
$appRJ->response['result'].= "<div class='modal order'><div class='overlay'></div><div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div></div>".
    "<div class='modal-left'><div class='modal-line'><div class='modal-line-img'>".
    "<img src='/site/status/img/logo-".$actStat['stName'].".png'></div>".
    "<div class='modal-line-text ".$actStat['stName']."'>".$actStat['descr']."<div>";
if($appRJ->server['reqUri_expl'][1] != "status"){
    $appRJ->response['result'].= "<div class='details'><a href='/status' title='Статус'>Подробнее</a></div>";
}
$appRJ->response['result'].= "</div></div></div><div class='modal-line'><div class='modal-line-img'>".
    "<img src='/site/siteHeader/img/Email-Logo-color.png'></div><div class='modal-line-text mail'>".
    "<span>rightjoint@yandex.ru</span></div></div>";

if($appRJ->server['reqUri_expl'][1]!='references'){
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/references/img/logo.png'></div><div class='modal-line-text ref'>".
        "<a href='/references' title='Посмотреть отзывы, написать отзыв'>Отзывы</a>".
        "</div></div>";
}
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/services/img/logo.png'></div><div class='modal-line-text'>".
        "<a href='/services/srvMan' title='Управление услугами' style='color: aqua'>Управление услугами</a>".
        "</div></div>";
}
$appRJ->response['result'].= "</div></div></div></div>";