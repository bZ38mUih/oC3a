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

$h1 ="Пожертвования";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Пожертвования на развитие проекта' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='yandex-verification' content='e929004ef40cae1b' />";
$appRJ->response['result'].= "<title>Пожертвования</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/donate/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
//$appRJ->response['result'].= "<link rel='stylesheet' href='/site/status/css/status.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
//$appRJ->response['result'].= "<script src='/site/status/js/status.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");


$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='dnt-ttl'>";
$appRJ->response['result'].= "Сделать пожертвование на развитие проекта www.rightjoint.ru";
//$appRJ->response['result'].= "<img src='/site/services/img/mazda323moon.JPG'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<form method='POST' action='https://money.yandex.ru/quickpay/confirm.xml'>".
    "<input type='hidden' name='receiver' value='41001xxxxxxxxxxxx'>".
    "<input type='hidden' name='formcomment' value='Проект «Железный человек»: реактор холодного ядерного синтеза'>".
    "<input type='hidden' name='short-dest' value='Проект «Железный человек»: реактор холодного ядерного синтеза'>".
    "<input type='hidden' name='label' value='".$order_id."'>".
    "<input type='hidden' name='quickpay-form' value='donate'>".
    "<input type='hidden' name='targets' value='транзакция {order_id}'>".
    "<input type='hidden' name='sum' value='4568.25' data-type='number'>".
    "<input type='hidden' name='comment' value='Хотелось бы получить дистанционное управление.'>".
    "<input type='hidden' name='need-fio' value='true'>".
    "<input type='hidden' name='need-email' value='true'>".
    "<input type='hidden' name='need-phone' value='false'>".
    "<input type='hidden' name='need-address' value='false'>".
    "<label><input type='radio' name='paymentType' value='PC'>Яндекс.Деньгами</label>".
    "<label><input type='radio' name='paymentType' value='AC'>Банковской картой</label>".
    "<input type='submit' value='Перевести'>"."</form>";
/*
$appRJ->response['result'].= "<div class='srv-ln-txt'>";
$appRJ->response['result'].= "<span class='srv-nm'>Выезд к заказчику на час</span>";
$appRJ->response['result'].= "для консультации по части it-услуг, созданию сайта или ремонте компьютера";
$appRJ->response['result'].= "</div>";
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