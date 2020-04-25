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

$appRJ->response['result'].= "<div class='modal-line' ";
if($_SESSION["bucket"]["total"]<50){
    $appRJ->response['result'].="style='display: none' ";
}else{
    $appRJ->response['result'].="style='position: relative' ";
}
$appRJ->response['result'].="><div class='modal-line-img'>".
    "<img src='/site/siteHeader/img/handsShake-color.png'></div><div class='modal-line-text bucket'>".
    "<a href='/services/mkOrder'>Ваш заказ: <span>".$_SESSION["bucket"]["total"]."</span> руб.</a>";
if($_SESSION['bucket']['order_id']){
    $appRJ->response['result'].="<img src='/site/services/img/due.png' class='payStat'>";
}
$appRJ->response['result'].="</div></div>";
if($appRJ->server['reqUri_expl'][1]!='services') {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/services/img/logo.png'></div><div class='modal-line-text srv'>".
        "<a href='/services' title='Расценки и заказ услуг'>Услуги программиста</a>".
        "</div></div>";
}
if($appRJ->server['reqUri_expl'][2]!='faq'){
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/status/img/faq.png'></div><div class='modal-line-text ref'>".
        "<a href='/forum/faq' title='Задать вопрос, ответы на вопросы'>Часто задаваемые вопросы</a>".
        "</div></div>";
}
if($appRJ->server['reqUri_expl'][1]!='references'){
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/references/img/logo.png'></div><div class='modal-line-text ref'>".
        "<a href='/references' title='Посмотреть отзывы, написать отзыв'>Отзывы</a>".
        "</div></div>";
}
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/services/img/logo.png'></div><div class='modal-line-text'>".
        "<a href='/services/srvMan/cards/' title='Управление услугами' style='color: aqua'>Управление услугами</a>".
        "</div></div>";
}
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<div class='modal-line'><div class='modal-line-img'>".
        "<img src='/site/payments/img/logo.png'></div><div class='modal-line-text'>".
        "<a href='/payments/list' title='Список платежей' style='color: aqua'>Список платежей</a>".
        "</div></div>";
}
$appRJ->response['result'].= "</div></div></div></div>";