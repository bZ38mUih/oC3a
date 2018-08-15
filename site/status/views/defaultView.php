<?php
/*
$curStatus['free']['active']=true;
$curStatus['free']['stName']='free';
$curStatus['free']['alias']='СВОБОДЕН';
$curStatus['free']['descr']="<span class='phone'>8-903-888-7772</span>Ищу проект чтобы принять участие, готов приступить к работе в ближайшее время";
$curStatus['free']['detail']='Получить консультацию о возможности выполнения, сроках и стоимости услуг вы можете по телефону или E-Mail';

$curStatus['lookFor']['active']=false;
$curStatus['lookFor']['stName']='lookFor';
$curStatus['lookFor']['alias']='В ПОИСКЕ';
$curStatus['lookFor']['descr']='Присматриваю варианты для взаимовыгодного сотрудничества. Готов приступить к работе по договоренности.';
$curStatus['lookFor']['detail']='Получить консультацию о возможности выполнения, сроках и стоимости услуг вы можете по E-Mail';

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
    "<meta name='description' content='".$actStat['alias'].": ".$actStat['descr']."' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Статус</title>".
    "<link rel='SHORTCUT ICON' href='/site/status/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/status/css/status.css' type='text/css' media='screen, projection'/>".
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
    "<div class='stat-descr'>".$actStat['detail']."</div></div></div></div>".
    "<div class='contentBlock-frame dark'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='yMap-frame'><div class='yMap-wrap'>".
    "<script type='text/javascript' charset='utf-8' async
src='https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2d466e2d4f1632789b9df6fd6d34e6e4f660b8caa1bed15db7a0dd231e4c7a31&amp;width=300&amp;height=300&amp;lang=ru_RU&amp;scroll=true'></script>".
    "</div><img src='/site/status/img/demidova-10-img1.jpg' id='img1'>".
    "<img src='/site/status/img/demidova-10-img2.jpg' id='img2'></div>".
    "<div class='descr-frame'>".
    "<div class='descr-line'><img src='/site/siteHeader/img/site-logo.png'><span class='fmNm'>Right Joint</span></div>".
    "<div class='descr-line'><span>Адрес:</span> г. Иваново, ул. Демидова, д. 10</div>".
    "<div class='descr-line'><span>Режим работы:</span> пнд. - птн. с 9.00 до 18.00, сбт., вск. - выходной</div>".
    "<div class='descr-line'><span>E-Mail:</span> rightjoint@yandex.ru</div>".
    "<div class='locPr-block'>".
    "<img src='/site/status/img/yMap.png' id='yMap-lk' class='active' onclick='showLoc(".'"'."yMap".'"'.")'>".
    "<img src='/site/status/img/demidova-10-img1.jpg' id='img1-lk' onclick='showLoc(".'"'."img1".'"'.")'>".
    "<img src='/site/status/img/demidova-10-img2.jpg' id='img2-lk' onclick='showLoc(".'"'."img2".'"'.")'>".
    "</div></div></div></div></div>".
    "<div class='contentBlock-frame'><div class='contentBlock-center'>".
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