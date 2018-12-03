<?php
$h1 ="it - услуги в г. Иваново";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Создание сайтов, ремонт компьютеров в г. Иваново. ".
    "Блог, полезные ссылки, услуги, портфолио'/>".
    "<meta name='yandex-verification' content='e929004ef40cae1b' />".
    "<title>Частный it-мастер</title>".
    "<link rel='SHORTCUT ICON' href='/site/landing/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/landing/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
    }
$appRJ->response['result'].= "</head><body>";





require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");



$appRJ->response['result'].="<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='contentBlock-table'><div class='contentBlock-table-left'><h2>Услуги</h2>";
$slSrv_qry="select * from srvCards_dt where cardActive is true ORDER BY sortDate DESC limit 4";
$slSrv_res = $DB->doQuery($slSrv_qry);
$slSrvMain=$DB->doFetchRow($slSrv_res);
while ($slSrv_row=$DB->doFetchRow($slSrv_res)){
    $appRJ->response['result'].= "<div class='list-item'>".
        "<div class='list-item-img'>".
        "<img src='".SRV_CARD_IMG_PAPH."/".$slSrv_row['card_id']."/preview/".$slSrv_row['cardImg']."' alt='srvCover'>".
        "</div><div class='list-item-text'>".
        "<a href='/services/detail/".$slSrv_row['cardAlias']."' title='Подробнее об услуге'>".$slSrv_row['cardName']."</a>".
        "<span>".$slSrv_row['shortDescr']."</span></div></div>";
}
$appRJ->response['result'].= "<div class='list-item all'><a href='/services/'>все услуги</a></div></div>".
    "<div class='contentBlock-table-right'><h2>Популярная услуга</h2>".
    "<img src='".SRV_CARD_IMG_PAPH."/".$slSrvMain['card_id']."/preview/".$slSrvMain['cardImg']."' alt='srvCover'>".
    "<div><a href='/services/detail/".$slSrvMain['cardAlias']."' title='Подробнее об услуге'>".$slSrvMain['cardName']."</a>".
    "<span>".$slSrvMain['shortDescr']."</span></div></div></div></div></div>";


$appRJ->response['result'].="<div class='contentBlock-frame dark'><div class='contentBlock-center'>".

    "<div class='contentBlock-wrap portf'><h2>Портфолио</h2>".
    "<div class='contentBlock-table'><div class='contentBlock-table-left'>".
    "<div class='list-item'><div class='list-item-img'><img src='/site/gallery/img/logo.png'></div>".
    "<div class='list-item-text'><a href='/gallery/' title='Фото в галерее'>Галерея</a>".
    "<span>Альбомы фотографий на разные темы</span></div></div></div></div></div>".

    "<div class='contentBlock-wrap hfLinks'><h2>Полезные ссылки</h2>".
    "<div class='contentBlock-table'><div class='contentBlock-table-left'>".
    "<div class='list-item'><div class='list-item-img'><img src='/site/downloads/img/logo.png'></div>".
    "<div class='list-item-text'><a href='/downloads/' title='Ссылки на загрузки программ'>Загрузки</a>".
    "<span>Системное, офисное, популяное ПО. Ссылки на загрузки программ</span></div></div></div>".
    "<div class='contentBlock-table-left'><div class='list-item'><div class='list-item-img'>".
    "<img src='/site/handbook/img/logo.png'></div><div class='list-item-text'><a href='/handbook/'>Справочник</a>".
    "<span>Систематизированная информация о компьютерных технологиях</span>".
    "</div></div></div></div></div>".



    "</div></div>";



$slDevArt_qry="select * from art_dt where artCat_id=3 OR artCat_id=1 and activeFlag is true ORDER BY pubDate DESC limit 4";
$slDevArt_res = $DB->doQuery($slDevArt_qry);
$devArtMain=$DB->doFetchRow($slDevArt_res);
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='contentBlock-table'><div class='contentBlock-table-left'><h2>Блог</h2>";
while ($slDevArt_row=$DB->doFetchRow($slDevArt_res)){
    $appRJ->response['result'].= "<div class='list-item'>".
        "<div class='list-item-img'>".
        "<img src='".ARTS_IMG_PAPH."/".$slDevArt_row['art_id']."/preview/".$slDevArt_row['artImg']."' alt='artCover'>".
        "</div><div class='list-item-text'>".
        "<a href='/dev/".$slDevArt_row['artAlias']."' title='Читать статью'>".$slDevArt_row['artName']."</a>".
        "<span>".$slDevArt_row['artMeta']."</span></div></div>";
}
$appRJ->response['result'].= "<div class='list-item all'>".
    "<a href='/dev/'>все статьи</a></div></div><div class='contentBlock-table-right'>".
    "<h2>Свежая статья</h2>".
    "<img src='".ARTS_IMG_PAPH."/".$devArtMain['art_id']."/preview/".$devArtMain['artImg']."' alt='artCover'>".
    "<div><a href='/dev/".$devArtMain['artAlias']."' title='Читать статью'>".$devArtMain['artName']."</a>".
    "<span>".$devArtMain['artMeta']."</span></div></div></div></div></div>";



require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";