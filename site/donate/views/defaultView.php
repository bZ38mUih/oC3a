<?php
if($_SESSION['donate']['order_id']) {
    $Order_rd['result']["order_id"] = $_SESSION['donate']['order_id'];
    $Order_rd->copyOne();
}
$donate_qry="select SUM(amount) as dntAmount from payments_dt WHERE ".
    "label IN (SELECT label FROM ordersList_dt WHERE shortDest='Right Joint: пожертвование') and hashEqual IS TRUE";
$DB->doQuery($donate_qry);
$donate_res=$DB->doQuery($donate_qry);
$donate_row=$DB->doFetchRow($donate_res);
$h1 ="Пожертвования";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Вы можете помочь развитию проекта. www.rightjoint.ru нуждается в спонсорах ".
    "Если вам нравится проект www.rightjoint.ru, вы можете сделать анонимное пожертвование ".
    "чтобы поддержать его дальнейшее развитие. Буду вам очень благодарен за любую финансовую помощь.'/>".
    "<title>Помощь проекту</title>".
    "<link rel='SHORTCUT ICON' href='/site/donate/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/donate/css/dnt.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/donate/js/donate.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='dnt-ttl-frame'>".
    "<div class='dnt-ttl'>".
    "<span class='spons'>Вы можете помочь развитию проекта.</span><span class='projName'>www.rightjoint.ru</span>".
    "<span class='spons'>нуждается в спонсорах</span>".
    "</div></div></div></div></div>";
$appRJ->response['result'].= "<div class='contentBlock-frame dark'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='dnt-form'>".
    "<form class='donate' method='post' action='https://money.yandex.ru/quickpay/confirm.xml'>".
    "<label class='dnt-sum'><input type='number' name='sum' value='";
if($Order_rd['result']["orderSum"]){
    $appRJ->response['result'].=$Order_rd['result']["orderSum"];
}else{
    $appRJ->response['result'].='100';
}
$appRJ->response['result'].=$_SESSION["donate"]["total"].
    "' data-type='number' min='100' max='10000'> руб.</label>".
    "<input type='hidden' name='receiver' value='".$ym['receiver']."'>".
    "<input type='hidden' name='successURL' value='https://".$_SERVER["HTTP_HOST"]."/payments'>".
    "<input type='hidden' name='formcomment' value='Right Joint: пожертвование'>".
    "<input type='hidden' name='short-dest' value='Right Joint: пожертвование'>".
    "<input type='hidden' name='label' value='".uniqid('', true)."'>".
    "<input type='hidden' name='quickpay-form' value='donate'>".
    "<input type='hidden' name='targets' value='Right Joint: пожертвование'>".
    "<label>Коментарий к переводу (необязательно)</label><textarea name='comment' rows='3'>";
if($Order_rd['result']["comment"]) {
    $appRJ->response['result'].=$Order_rd['result']["comment"];
}
$appRJ->response['result'].="</textarea>".
    "<input type='hidden' name='need-fio' value='false'>".
    "<input type='hidden' name='need-email' value='false'>".
    "<input type='hidden' name='need-phone' value='false'>".
    "<input type='hidden' name='need-address' value='false'>".
    "<label><input type='radio' name='paymentType' value='PC' ";
if(isset($Order_rd['result']["paymentType"]) and $Order_rd['result']["paymentType"]=='PC'){
    $appRJ->response['result'].="checked";
}
$appRJ->response['result'].=">Яндекс.Деньгами</label>".
    "<label><input type='radio' name='paymentType' value='AC' ";
if(!$Order_rd['result']["paymentType"] or (isset($Order_rd['result']["paymentType"]) and $Order_rd['result']["paymentType"]=='AC')){
    $appRJ->response['result'].="checked";
}
$appRJ->response['result'].=">Банковской картой</label>".
    "<input type='button' value='Далее' onclick='Donate()'>".
    "</form>".
    "<div class='dnt-stat'>Уже собрано<label class='dnt-amount'>";
if($donate_row['dntAmount']>0){
    $appRJ->response['result'].=$donate_row['dntAmount'];
}else{
    $appRJ->response['result'].="0";
}
$appRJ->response['result'].="</label></div></div>".
    "</div></div></div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='dnt-thankful-frame'>".
    "<div class='dnt-thankful'>".
    "Если вам нравится проект www.rightjoint.ru, вы можете сделать анонимное пожертвование ".
    "чтобы поддержать его дальнейшее развитие. Буду вам очень благодарен за любую финансовую помощь.".
    "<span class='rj_sign'>Right Joint</span></div></div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";