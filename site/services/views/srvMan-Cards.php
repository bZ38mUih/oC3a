<?php
$h1 ="Управление услугами";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Управление услугами' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Управление услугами</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>".
    /*toDo common style dwlMan.css*/
    "<link rel='stylesheet' href='/site/downloads/css/dwlMan.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subMenu.php");
$slSrv_qry = "select * from srvCards_dt LEFT JOIN srvCat_dt ON srvCards_dt.srvCat_id=srvCat_dt.srvCat_id";
$slSrv_res=$DB->doQuery($slSrv_qry);
$srvCnt=0;
if(mysql_num_rows($slSrv_res)>0){
    $srvCnt=mysql_num_rows($slSrv_res);
}
$appRJ->response['result'].= "<div class='manFrame'><div class='manTopPanel'>".
    "<div class='itemsCount'>Всего: <span>".$srvCnt."</span> записей</div>".
    "<div class='newItem'>".
    "<a href='/services/srvMan/cards/newService'><img src='/source/img/create-icon.png'>Создать услугу</a></div></div>";
if($srvCnt>0){
    $appRJ->response['result'].= "<div class='item-line caption'>".
        "<div class='item-line-id'>srv_id</div>".
        "<div class='item-line-img'>Img</div>".
        "<div class='item-line-name'>srvName</div>".
        "<div class='item-line-alias'>srvAlias</div>".
        "<div class='item-line-flag'>active</div>".
        "<div class='item-line-fCateg'>categ</div></div>";
    while ($slSrv_row=$DB->doFetchRow($slSrv_res)){
        $appRJ->response['result'].= "<div class='item-line'><div class='item-line-id'>".
            "<a href='/services/srvMan/cards/editCard/?card_id=".$slSrv_row['card_id']."'>".
            $slSrv_row['card_id']."</a></div>".
            "<div class='item-line-img'>";
        if($slSrv_row['cardImg']){
            $appRJ->response['result'].= "<img src='".SRV_CARD_IMG_PAPH.$slSrv_row['card_id']."/preview/".
                $slSrv_row['cardImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name'>".$slSrv_row['cardName']."</div>".
            "<div class='item-line-alias'>".$slSrv_row['cardAlias']."</div>".
            "<div class='item-line-flag'><input type='checkbox' ";
        if($slSrv_row['cardActive']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled></div>".
            "<div class='item-line-fCateg'>".$slSrv_row['catName']."</div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no srvCards there<br>";
}
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";