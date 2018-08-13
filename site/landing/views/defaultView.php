<?php
$h1 ="it - услуги в г. Иваново";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Создание сайтов, ремонт компьютеров в г. Иваново' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='yandex-verification' content='e929004ef40cae1b' />";
$appRJ->response['result'].= "<title>Компьютеры и разработка</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/landing/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/landing/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
    }
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$slDevArt_qry="select * from art_dt where artCat_id=3 and activeFlag is true ORDER BY pubDate DESC limit 4";
$slDevArt_res = $DB->doQuery($slDevArt_qry);
$devArtMain=$DB->doFetchRow($slDevArt_res);

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='contentBlock-table'>";
$appRJ->response['result'].= "<div class='contentBlock-table-left'>";
$appRJ->response['result'].= "<h2>Разработка</h2>";

while ($slDevArt_row=$DB->doFetchRow($slDevArt_res)){
    $appRJ->response['result'].= "<div class='list-item'>";
    $appRJ->response['result'].= "<div class='list-item-img'>";
    $appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH."/".$slDevArt_row['art_id']."/preview/".$slDevArt_row['artImg']."'>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='list-item-text'>";
    $appRJ->response['result'].= "<a href='/dev/".$slDevArt_row['artAlias']."'>".$slDevArt_row['artName']."</a>";
    $appRJ->response['result'].= "<span>".$slDevArt_row['artMeta']."</span>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
}
$appRJ->response['result'].= "<div class='list-item all'>";
$appRJ->response['result'].= "<a href='/dev/'>все статьи</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='contentBlock-table-right'>";
$appRJ->response['result'].= "<h2>Свежая статья</h2>";
$appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH."/".$devArtMain['art_id']."/preview/".$devArtMain['artImg']."'>";
$appRJ->response['result'].= "<div>";
$appRJ->response['result'].= "<a href='/dev/".$devArtMain['artAlias']."'>".$devArtMain['artName']."</a>";
$appRJ->response['result'].= "<span>".$devArtMain['artMeta']."</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentBlock-frame dark'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='contentBlock-table'>";
$appRJ->response['result'].= "<div class='contentBlock-table-left'>";
$appRJ->response['result'].= "<div class='list-item'>";
$appRJ->response['result'].= "<div class='list-item-img'>";
$appRJ->response['result'].= "<img src='/site/downloads/img/logo.png'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='list-item-text'>";
$appRJ->response['result'].= "<a href='/downloads/'>Загрузки</a>";
$appRJ->response['result'].= "<span>Системное, офисное, популяное ПО. Ссылки на загрузки программ</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='contentBlock-table-left'>";
$appRJ->response['result'].= "<div class='list-item'>";
$appRJ->response['result'].= "<div class='list-item-img'>";
$appRJ->response['result'].= "<img src='/site/handbook/img/logo.png'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='list-item-text'>";
$appRJ->response['result'].= "<a href='/handbook/'>Справочник</a>";
$appRJ->response['result'].= "<span>Систематизированная информация о компьютерных технологиях</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='contentBlock-table'>";
$appRJ->response['result'].= "<div class='contentBlock-table-left'>";
$appRJ->response['result'].= "<h2>Компьютеры и технологии</h2>";

$slPcArt_qry="select * from art_dt where artCat_id=1 and activeFlag is true ORDER BY pubDate DESC limit 4";
$slPcArt_res = $DB->doQuery($slPcArt_qry);
$devPcMain=$DB->doFetchRow($slPcArt_res);
while ($slPcArt_row=$DB->doFetchRow($slPcArt_res)){
    $appRJ->response['result'].= "<div class='list-item'>";
    $appRJ->response['result'].= "<div class='list-item-img'>";
    $appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH."/".$slPcArt_row['art_id']."/preview/".$slPcArt_row['artImg']."'>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='list-item-text'>";
    $appRJ->response['result'].= "<a href='/pc/".$slPcArt_row['artAlias']."'>".$slPcArt_row['artName']."</a>";
    $appRJ->response['result'].= "<span>".$slPcArt_row['artMeta']."</span>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
}
$appRJ->response['result'].= "<div class='list-item all'>";
$appRJ->response['result'].= "<a href='/pc/'>все статьи</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentBlock-table-right'>";
$appRJ->response['result'].= "<h2>Свежая статья</h2>";
$appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH."/".$devPcMain['art_id']."/preview/".$devPcMain['artImg']."'>";

$appRJ->response['result'].= "<div>";
$appRJ->response['result'].= "<a href='/pc/".$devPcMain['artAlias']."'>".$devPcMain['artName']."</a>";
$appRJ->response['result'].= "<span>".$devPcMain['artMeta']."</span>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";