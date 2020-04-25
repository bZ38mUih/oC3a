<?php
/*
$curStatus['free']['active']=true;
$curStatus['free']['stName']='free';
$curStatus['free']['alias']='СВОБОДЕН';
$curStatus['free']['descr']="<span class=".'"'."phone".'"'.">8-903-888-7772</span>Ищу проект чтобы принять участие, готов приступить к работе в ближайшее время";
$curStatus['free']['detail']='Получить консультацию о возможности выполнения, сроках и стоимости услуг вы можете по телефону или E-Mail';

$curStatus['lookFor']['active']=false;
$curStatus['lookFor']['stName']='lookFor';
$curStatus['lookFor']['alias']='В ПОИСКЕ';
$curStatus['lookFor']['descr']="<span class=".'"'."phone".'"'.">8-903-888-7772</span>Присматриваю варианты для взаимовыгодного сотрудничества. Готов приступить к работе по договоренности.";
$curStatus['lookFor']['detail']='Получить консультацию о возможности выполнения, сроках и стоимости услуг вы можете по телефону или E-Mail';

$curStatus['busy']['active']=false;
$curStatus['busy']['stName']='busy';
$curStatus['busy']['alias']='ЗАНЯТ';
$curStatus['busy']['descr']='Сейчас у меня много работы. Не могу ответить на звонок. Рассматриваю предложения очень ограниченно';
$curStatus['busy']['detail']='Попробуйте написать на E-Mail';

file_put_contents($_SERVER['DOCUMENT_ROOT']."/site/status/status.txt", json_encode($curStatus));

exit;
*/
$h1 ="Статус";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='".$actStat['alias'].": ".$actStat['descr']."'/>".
    "<title>Статус</title>".
    "<link rel='SHORTCUT ICON' href='/site/status/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/status/css/status.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/status/css/statBlock.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/status/js/status.js'></script>";
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "<script src='/site/status/js/change.js'></script>";
}
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='stat-block ".$actStat['stName']."'>".
    "<span class='status'>".$actStat['alias']."</span><div class='stat-block-img'>".
    "<img src='/site/status/img/logo-".$actStat['stName'].".png' ";
if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
    $appRJ->response['result'].= "onclick='changeStatus()'";
}
$appRJ->response['result'].="></div><div class='stat-block-txt'>".$actStat['descr']."</div></div>".
    "<div class='stat-descr'>".$actStat['detail']."</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/status/views/contactsBlock.php");
$appRJ->response['result'].="<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='add-ref'>".
    "<a href='/services'><img src='/site/services/img/logo.png'>Все услуги</a>".
    "<a href='/forum/faq'><img src='/site/status/img/faq.jpg'>Часто задаваемые вопросы</a>".
    "<a href='/references'><img src='/site/references/img/logo.png'>Отзывы</a>".
    "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body>".
    "</html>";