<?php
$pop_qry="select * from srvCards_dt INNER JOIN srvCat_dt ON srvCards_dt.srvCat_id=srvCat_dt.srvCat_id";
$pop_res=$DB->doQuery($pop_qry);
$pop_cnt=0;
if(mysql_num_rows($pop_res)>0){
    $pop_cnt=mysql_num_rows($pop_res);
}

$h1 ="Услуги";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Услуги по созданию сайтов и ремонту компьютеров в г. Иваново' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Услуги</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/services/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/services/js/services.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>"."<div class='srv-frame'><h2>Популярные услуги</h2>";

if($pop_cnt>0){
    while ($pop_row=$DB->doFetchRow($pop_res)){
        $appRJ->response['result'].="<div class='srv-ln' id='srv".$pop_row['card_id']."'>".
            "<div class='srv-capt'><span class='before'></span><span>".$pop_row['cardName'].
            "</span><span class='after'></span></div>".
            "<div class='srv-img'><img src='".SRV_CARD_IMG_PAPH.$pop_row['card_id']."/preview/".
            $pop_row['cardImg']."'></div>".
            "<div class='srv-txt'>".
            "<div class='srv-cntrl'>".


            "<span class='srv-price'>от ".$pop_row['cardPrice']." руб.</span>".
            "<span class='addBucket' onclick='addBucket(".$pop_row['card_id'].")'><img src='/site/services/img/bucket.png'>Заказать</span>".
            "<span class='rmBucket' onclick='rmBucket(".$pop_row['card_id'].")'><img src='/source/img/drop-icon.png'>Отменить</span>".
            "<a class='toOrder' href='/services/order'><img src='/site/payments/img/logo.png'>Оплатить</a>".
            "</div>".


            "<div class='srv-descr'>".$pop_row['shortDescr'].
            "</div>".
            "<div class='detail'><a href='/services/detail/".$pop_row['cardAlias']."'>подробнее</a></div>".

            "</div>".
            "</div>";
    }
}else{
    $appRJ->response['result'].= "thre is no active services";
}


$appRJ->response['result'].="</div></div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";