<?php
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

$srv_qry="select * from srvCat_dt WHERE catActive is TRUE ORDER BY srvCat_id";
$srv_res=$DB->doQuery($srv_qry);
if(mysql_num_rows($srv_res)>0){
    while($srv_row = $DB->doFetchRow($srv_res)){
        $cards_qry="select * from srvCards_dt WHERE srvCat_id=".$srv_row['srvCat_id'];
        $cards_res=$DB->doQuery($cards_qry);
        if(mysql_num_rows($cards_res)>0){
            $appRJ->response['result'].= "<div class='srv-frame ".$srv_row['catAlias']."'><h2>".$srv_row['catName']."</h2>";
            while ($cards_row=$DB->doFetchRow($cards_res)){
                $appRJ->response['result'].="<div class='srv-ln' id='srv".$cards_row['card_id']."'>".
                    "<div class='srv-capt'><span class='before'></span><span>".$cards_row['cardName'].
                    "</span><span class='after'></span></div>".
                    "<div class='srv-img'><img src='".SRV_CARD_IMG_PAPH.$cards_row['card_id']."/preview/".
                    $cards_row['cardImg']."'></div>".
                    "<div class='srv-txt'>".
                    "<div class='srv-cntrl'>".
                    "<span class='srv-price'>от ".$cards_row['cardPrice']." руб.</span>".
                    "<span class='addBucket ";
                if(!$_SESSION["bucket"]["prod"][$cards_row['card_id']]){
                    $appRJ->response['result'].="active";
                }
                $appRJ->response['result'].="' onclick='addBucket(".$cards_row['card_id'].")'><img src='/site/services/img/bucket.png'>Заказать</span>".
                    "<span class='rmBucket ";
                if($_SESSION["bucket"]["prod"][$cards_row['card_id']]){
                    $appRJ->response['result'].="active";
                }
                $appRJ->response['result'].="' onclick='rmBucket(".$cards_row['card_id'].")'><img src='/source/img/drop-icon.png'>Отменить</span>".
                    "<a class='toOrder ";
                if($_SESSION["bucket"]["prod"][$cards_row['card_id']]){
                    $appRJ->response['result'].="active";
                }
                $appRJ->response['result'].="' href='/services/mkOrder'><img src='/site/siteHeader/img/handsShake-color.png'>Оформить</a>".
                    "</div><div class='srv-descr'>".$cards_row['shortDescr']."</div>".
                    "<div class='detail'><a href='/services/detail/".$cards_row['cardAlias']."'>подробнее</a></div>".
                    "</div></div>";
            }
        }
    }
}else{
    $appRJ->response['result'].= "there is no active services";
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";