<?php
//unset($_SESSION["bucket"]);
$pop_qry="select * from srvCards_dt INNER JOIN srvCat_dt ON srvCards_dt.srvCat_id=srvCat_dt.srvCat_id".
    " WHERE srvCat_dt.srvCat_id=1";
$pop_res=$DB->doQuery($pop_qry);
$pop_cnt=0;
if(mysql_num_rows($pop_res)>0){
    $pop_cnt=mysql_num_rows($pop_res);
}
$dev_qry="select * from srvCards_dt INNER JOIN srvCat_dt ON srvCards_dt.srvCat_id=srvCat_dt.srvCat_id".
    " WHERE srvCat_dt.srvCat_id=2";
$dev_res=$DB->doQuery($dev_qry);
$dev_cnt=0;
if(mysql_num_rows($dev_res)>0){
    $dev_cnt=mysql_num_rows($dev_res);
}
$h1 ="Услуги";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Услуги по созданию сайтов и ремонту компьютеров в г. Иваново'/>".
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
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
if($pop_cnt>0){
    $appRJ->response['result'].= "<div class='srv-frame'><h2>Популярные услуги</h2>";
    while ($pop_row=$DB->doFetchRow($pop_res)){
        $appRJ->response['result'].="<div class='srv-ln' id='srv".$pop_row['card_id']."'>".
            "<div class='srv-capt'><span class='before'></span><span>".$pop_row['cardName'].
            "</span><span class='after'></span></div>".
            "<div class='srv-img'><img src='".SRV_CARD_IMG_PAPH.$pop_row['card_id']."/preview/".
            $pop_row['cardImg']."'></div>".
            "<div class='srv-txt'>".
            "<div class='srv-cntrl'>".
            "<span class='srv-price'>от ".$pop_row['cardPrice']." руб.</span>".
            "<span class='addBucket ";
        if(!$_SESSION["bucket"]["prod"][$pop_row['card_id']]){
            $appRJ->response['result'].="active";
        }
        $appRJ->response['result'].="' onclick='addBucket(".$pop_row['card_id'].")'><img src='/site/services/img/bucket.png'>Заказать</span>".
            "<span class='rmBucket ";
        if($_SESSION["bucket"]["prod"][$pop_row['card_id']]){
            $appRJ->response['result'].="active";
        }
        $appRJ->response['result'].="' onclick='rmBucket(".$pop_row['card_id'].")'><img src='/source/img/drop-icon.png'>Отменить</span>".
                "<a class='toOrder ";
        if($_SESSION["bucket"]["prod"][$pop_row['card_id']]){
            $appRJ->response['result'].="active";
        }
        $appRJ->response['result'].="' href='/services/mkOrder'><img src='/site/siteHeader/img/handsShake-color.png'>Оформить</a>".
        "</div><div class='srv-descr'>".$pop_row['shortDescr']."</div>".
            "<div class='detail'><a href='/services/detail/".$pop_row['cardAlias']."'>подробнее</a></div>".
            "</div></div>";
    }
}else{
    $appRJ->response['result'].= "thre is no active pop services";
}
$appRJ->response['result'].="</div>";
if($dev_cnt>0){
    $appRJ->response['result'].= "<div class='srv-frame dev'><h2>Услуги по разработке сайтов</h2>";
    while ($dev_row=$DB->doFetchRow($dev_res)){
        $appRJ->response['result'].="<div class='srv-ln' id='srv".$dev_row['card_id']."'>".
            "<div class='srv-capt'><span class='before'></span><span>".$dev_row['cardName'].
            "</span><span class='after'></span></div>".
            "<div class='srv-img'><img src='".SRV_CARD_IMG_PAPH.$dev_row['card_id']."/preview/".
            $dev_row['cardImg']."'></div>".
            "<div class='srv-txt'>".
            "<div class='srv-cntrl'>".
            "<span class='srv-price'>от ".$dev_row['cardPrice']." руб.</span>".
            "<span class='addBucket ";
        if(!$_SESSION["bucket"]["prod"][$dev_row['card_id']]){
            $appRJ->response['result'].="active";
        }
        $appRJ->response['result'].="' onclick='addBucket(".$dev_row['card_id'].")'><img src='/site/services/img/bucket.png'>Заказать</span>".
            "<span class='rmBucket ";
        if($_SESSION["bucket"]["prod"][$dev_row['card_id']]){
            $appRJ->response['result'].="active";
        }
        $appRJ->response['result'].="' onclick='rmBucket(".$dev_row['card_id'].")'><img src='/source/img/drop-icon.png'>Отменить</span>".
            "<a class='toOrder ";
        if($_SESSION["bucket"]["prod"][$dev_row['card_id']]){
            $appRJ->response['result'].="active";
        }
        $appRJ->response['result'].="' href='/services/mkOrder'><img src='/site/siteHeader/img/handsShake-color.png'>Оформить</a>".
            "</div><div class='srv-descr'>".$dev_row['shortDescr']."</div>".
            "<div class='detail'><a href='/services/detail/".$dev_row['cardAlias']."'>подробнее</a></div>".
            "</div></div>";
    }
}else{
    $appRJ->response['result'].= "thre is no active dev services";
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";