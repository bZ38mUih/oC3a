<?php
$srv_qry="select * from srvCards_dt INNER JOIN srvCat_dt ON srvCards_dt.srvCat_id=srvCat_dt.srvCat_id ".
    "WHERE srvCards_dt.cardAlias='".$appRJ->server['reqUri_expl'][3]."'";
$srv_res=$DB->doQuery($srv_qry);
if(mysql_num_rows($srv_res)==1){
    $srv_row=$DB->doFetchRow($srv_res);
    $h1 ="Описание услуги";
    $App['views']['social-block']=true;
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
        "<meta name='description' content='".$srv_row['shortDescr']." - от ".$srv_row['cardPrice']." руб.'/>".
        "<title>Услуги</title>".
        "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
        "<script src='/source/js/jquery-3.2.1.js'></script>".
        "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/services/css/default.css' type='text/css' media='screen, projection'/>".
        "<script src='/site/siteHeader/js/modalHeader.js'></script>".
        "<script src='/site/services/js/services.js'></script>";
    if($App['views']['social-block']){
        $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
    }
    $appRJ->response['result'].=
        "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
        "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
        "</head><body>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
    $appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>";
    $appRJ->response['result'].="<div class='srv-frame ".$srv_row['catAlias']."'>".
        "<div class='srv-ln' id='srv".$srv_row['card_id']."' style='margin-top: 1em'>".
        "<div class='srv-capt'><span class='before'></span><span>".$srv_row['cardName'].
        "</span><span class='after'></span></div>".
        "<div class='srv-img'><img src='".SRV_CARD_IMG_PAPH.$srv_row['card_id']."/preview/".
        $srv_row['cardImg']."' id='shareImg'></div>".
        "<div class='srv-txt'>".
        "<div class='srv-cntrl'>".
        "<span class='srv-price'>от ".$srv_row['cardPrice']." руб.</span>".
        "<span class='addBucket ";
    if(!$_SESSION["bucket"]["prod"][$srv_row['card_id']]){
        $appRJ->response['result'].="active";
    }
    $appRJ->response['result'].="' onclick='addBucket(".$srv_row['card_id'].")'><img src='/site/services/img/bucket.png'>Заказать</span>".
        "<span class='rmBucket ";
    if($_SESSION["bucket"]["prod"][$srv_row['card_id']]){
        $appRJ->response['result'].="active";
    }
    $appRJ->response['result'].="' onclick='rmBucket(".$srv_row['card_id'].")'><img src='/source/img/drop-icon.png'>Отменить</span>".
        "<a class='toOrder ";
    if($_SESSION["bucket"]["prod"][$srv_row['card_id']]){
        $appRJ->response['result'].="active";
    }
    $appRJ->response['result'].="' href='/services/mkOrder'><img src='/site/siteHeader/img/handsShake-color.png'>Оформить</a>".
        "</div><div class='srv-descr'>".$srv_row['shortDescr']."</div></div></div>".
        "<div class='longDescr'>";
    if($srv_row['longDescr']){
        $appRJ->response['result'].=$srv_row['longDescr'];
    }else{
        $appRJ->response['result'].="подробное описание не задано";
    }
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].=
        "<div class='toSrv'><a href='/services'><img src='/site/services/img/logo.png'>Все услуги</a></div>".
        "</div></div></div>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
    $appRJ->response['result'].= "</body></html>";
}else{
    $appRJ->errors["404"]["description"]="Услуга не существует";
}
