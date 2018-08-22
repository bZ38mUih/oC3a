<?php
$h1 ="Оформление заказа - оплата";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Оформление заказа. Оплата' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
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
        $Card_rd->result['card_id']=$key;
        if($Card_rd->copyOne()){
            $appRJ->response['result'].="<div class='order-line'><div class='order-img'><img src='".
                SRV_CARD_IMG_PAPH.$Card_rd->result['card_id']."/preview/".
                $Card_rd->result['cardImg']."'></div>".
                "<div class='order-nm'><a href='/services/detail/".$Card_rd->result['cardAlias']."'>".
                $Card_rd->result['cardName']."</a></div><div class='order-price'> ".$val." руб.</div></div>";
            $prod_lst.=$Card_rd->result['cardName']."; ";
        }
    }
    $prod_lst=substr($prod_lst, 0, 150);
    $appRJ->response['result'].="</div></div>";
    $appRJ->response['result'].= "<form class='order' method='post' action='https://money.yandex.ru/quickpay/confirm.xml'>".
        "<input type='hidden' name='receiver' value='410017333214411'>".
        "<input type='hidden' name='formcomment' value='Right Joint: оплата услуг'>".
        "<input type='hidden' name='short-dest' value='Right Joint: оплата услуг'>".
        "<input type='hidden' name='label' value='".uniqid('', true)."'>".
        "<input type='hidden' name='quickpay-form' value='shop'>".
        "<input type='hidden' name='targets' value='".$prod_lst."'>".
        "<input type='hidden' name='sum' value='".$_SESSION["bucket"]["total"]."' data-type='number'>".
        "<label>Коментарий к переводу (необязательно)</label><textarea name='comment' rows='3'>";
    if($_SESSION['bucket']['order_id']) {
        $Order_rd = new recordDefault("ordersList_dt", "order_id");
        $Order_rd->result["order_id"] = $_SESSION['bucket']['order_id'];
        $Order_rd->copyOne();
        $appRJ->response['result'].=$Order_rd->result["comment"];
    }
    $appRJ->response['result'].="</textarea>".//your comment
        "<input type='hidden' name='need-fio' value='false'>".
        "<input type='hidden' name='need-email' value='true'>".
        "<input type='hidden' name='need-phone' value='true'>".
        "<input type='hidden' name='need-address' value='false'>".
        "<label><input type='radio' name='paymentType' value='PC'>Яндекс.Деньгами</label>".
        "<label><input type='radio' name='paymentType' value='AC' checked>Банковской картой</label>".
        "<input type='button' value='Далее' onclick='mkOrder()'>".
        "</form>".
        "<div class='att'><strong>Внимание:</strong> узнавайте возможность выполнения услуг по телефону или ".
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