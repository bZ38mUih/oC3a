<?php
$Order_rd = array("table" => "ordersList_dt", "field_id" => "order_id");
if($_SESSION['bucket']['order_id']) {
    $Order_rd['result']["order_id"] = $_SESSION['bucket']['order_id'];
    $Order_rd = $DB->copyOne($Order_rd);
}
$h1 ="Оформление заказа - оплата";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Оформление заказа. Оплата'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Услуги</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/services/css/mkOrder.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/services/js/mkOrder.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>"."<div class='srv-frame'><h2><img src='/site/siteHeader/img/handsShake-color.png'>".
    " Ваш заказ: <span class='totalSum'>".$_SESSION["bucket"]["total"]." руб.";
if($_SESSION["bucket"]["discont"]){
    $appRJ->response['result'].=", скидка ".$_SESSION["bucket"]["discont"]." руб.";
}
$appRJ->response['result'].="</span>";
if($_SESSION['bucket']['order_id']){
    $appRJ->response['result'].="<img src='/site/services/img/due.png'>";
}
$appRJ->response['result'].="</h2>".
    "<div class='toSrv'><a href='/services'>Редактировать заказ</a></div>";
$Card_rd=new recordDefault("srvCards_dt", "card_id");
$prod_lst=null;
if($_SESSION['bucket']['total']>=100){
    foreach ($_SESSION['bucket']['prod'] as $key=>$val){
        $Card_rd['result']['card_id']=$key;
        if($Card_rd->copyOne()){
            $appRJ->response['result'].="<div class='order-line'><div class='order-img'><img src='".
                SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/preview/".
                $Card_rd['result']['cardImg']."'></div>".
                "<div class='order-nm'><a href='/services/detail/".$Card_rd['result']['cardAlias']."'>".
                $Card_rd['result']['cardName']."</a></div><div class='order-price'> ".$val." руб.</div></div>";
            $prod_lst.=$Card_rd['result']['cardName']."; ";
        }
    }
    $prod_lst=substr($prod_lst, 0, 150);
    $appRJ->response['result'].="</div></div>";
    $appRJ->response['result'].= "<form class='order' method='post' action='https://money.yandex.ru/quickpay/confirm.xml'>".
        "<input type='hidden' name='receiver' value='".$ym['receiver']."'>".
        "<input type='hidden' name='successURL' value='https://".$_SERVER["HTTP_HOST"]."/payments'>".
        "<input type='hidden' name='formcomment' value='Right Joint - услуги'>".
        "<input type='hidden' name='short-dest' value='Right Joint - услуги'>".
        "<input type='hidden' name='label' value='".uniqid('', true)."'>".
        "<input type='hidden' name='targets' value='".$prod_lst."'>".
        "<div class='paymType'><span>Выберете вид платежа:</span><div class='paymType-selector'>".
        "<label><input type='radio' name='quickpay-form' value='donate' onclick='paymType(0)' ";
    if(!$Order_rd['result']["quickpayForm"] or (isset($Order_rd['result']["quickpayForm"]) and $Order_rd['result']["quickpayForm"]=='donate')){
        $appRJ->response['result'].="checked";
    }
    $appRJ->response['result'].=">Благотворительный</label>".
        "<label><input type='radio' name='quickpay-form' value='shop' onclick='paymType(1)' ";
    if(isset($Order_rd['result']["quickpayForm"]) and $Order_rd['result']["quickpayForm"]=='shop'){
        $appRJ->response['result'].="checked";
    }
    $appRJ->response['result'].=">Оплата услуг</label>".
        "</div><div class='paymType-descr donate ";
    if(!$Order_rd['result']["quickpayForm"] or (isset($Order_rd['result']["quickpayForm"]) and
            $Order_rd['result']["quickpayForm"]=='donate')){
        $appRJ->response['result'].="active";
    }
    $appRJ->response['result'].="'>когда нет необходимости официального оформления, работы будут выполнены".
        " от чистого сердца из бескорыстных побуждений</div>".
        "<div class='paymType-descr shop ";
    if(isset($Order_rd['result']["quickpayForm"]) and $Order_rd['result']["quickpayForm"]=='shop'){
        $appRJ->response['result'].="active";
    }
    $appRJ->response['result'].="'>когда необходимо официально оформить работы, кроме стоимости услуг".
        " заказчик обязуется возместить исполнителю все расходы, понесенные им при оформлении деятельности по оказанию заказанных ".
        "услуг включая налоги, штрафы и т.п. в соответсвии с законодательством РФ.</div></div>".
        "<input type='hidden' name='sum' value='".$_SESSION["bucket"]["total"]."' data-type='number' min='100' max='10000'>".
        "<label>Комментарий к переводу (необязательно)</label><textarea name='comment' rows='3'>";
    if($Order_rd['result']["comment"]) {
        $appRJ->response['result'].=$Order_rd['result']["comment"];
    }
    $appRJ->response['result'].="</textarea>".//your comment
        "<input type='hidden' name='need-fio' value='false'>".
        "<input type='hidden' name='need-email' value='true'>".
        "<input type='hidden' name='need-phone' value='true'>".
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
        "<input type='button' value='Далее' onclick='mkOrder()'>".
        "</form>".
        "<div class='att'><strong>Внимание!:</strong> узнавайте <a href='/status'>возможность</a> выполнения услуг по телефону или ".
        "e-Mail перед оплатой.</div>".
        "<div class='nb'><strong>Примечание:</strong> платеж осуществляется через шлюз money.yandex.ru. Далее укажите ".
        "ваш E-Mail, на него в письме придет ссылка для отслеживания статуса заказа. Номер вашего мобильного ".
        "необходим обратной связи.</div>";
}else{
    $appRJ->response['result'].= "</div>";
}
$appRJ->response['result'].= "</div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";