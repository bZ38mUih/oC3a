<?php
$h1 ="it - услуги в г. Иваново";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Создание сайтов, ремонт компьютеров в г. Иваново' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='yandex-verification' content='e929004ef40cae1b' />".
    "<title>Компьютеры и разработка</title>".
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
$slDevArt_qry="select * from art_dt where artCat_id=3 and activeFlag is true ORDER BY pubDate DESC limit 4";
$slDevArt_res = $DB->doQuery($slDevArt_qry);
$devArtMain=$DB->doFetchRow($slDevArt_res);
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='contentBlock-table'><div class='contentBlock-table-left'><h2>Разработка</h2>";
while ($slDevArt_row=$DB->doFetchRow($slDevArt_res)){
    $appRJ->response['result'].= "<div class='list-item'>".
        "<div class='list-item-img'>".
        "<img src='".ARTS_IMG_PAPH."/".$slDevArt_row['art_id']."/preview/".$slDevArt_row['artImg']."'>".
        "</div><div class='list-item-text'>".
        "<a href='/dev/".$slDevArt_row['artAlias']."'>".$slDevArt_row['artName']."</a>".
        "<span>".$slDevArt_row['artMeta']."</span></div></div>";
}
$appRJ->response['result'].= "<div class='list-item all'>".
    "<a href='/dev/'>все статьи</a></div></div><div class='contentBlock-table-right'>".
    "<h2>Свежая статья</h2>".
    "<img src='".ARTS_IMG_PAPH."/".$devArtMain['art_id']."/preview/".$devArtMain['artImg']."'>".
    "<div><a href='/dev/".$devArtMain['artAlias']."'>".$devArtMain['artName']."</a>".
    "<span>".$devArtMain['artMeta']."</span></div></div></div></div></div></div>".
    "<div class='contentBlock-frame dark'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='contentBlock-table'><div class='contentBlock-table-left'>".
    "<div class='list-item'><div class='list-item-img'><img src='/site/downloads/img/logo.png'></div>".
    "<div class='list-item-text'><a href='/downloads/'>Загрузки</a>".
    "<span>Системное, офисное, популяное ПО. Ссылки на загрузки программ</span></div></div></div>".
    "<div class='contentBlock-table-left'><div class='list-item'><div class='list-item-img'>".
    "<img src='/site/handbook/img/logo.png'></div><div class='list-item-text'><a href='/handbook/'>Справочник</a>".
    "<span>Систематизированная информация о компьютерных технологиях</span>".
    "</div></div></div></div></div></div></div>".
    "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='contentBlock-table'><div class='contentBlock-table-left'><h2>Компьютеры и технологии</h2>";
$slPcArt_qry="select * from art_dt where artCat_id=1 and activeFlag is true ORDER BY pubDate DESC limit 4";
$slPcArt_res = $DB->doQuery($slPcArt_qry);
$devPcMain=$DB->doFetchRow($slPcArt_res);
while ($slPcArt_row=$DB->doFetchRow($slPcArt_res)){
    $appRJ->response['result'].= "<div class='list-item'>".
        "<div class='list-item-img'>".
        "<img src='".ARTS_IMG_PAPH."/".$slPcArt_row['art_id']."/preview/".$slPcArt_row['artImg']."'>".
        "</div><div class='list-item-text'>".
        "<a href='/pc/".$slPcArt_row['artAlias']."'>".$slPcArt_row['artName']."</a>".
        "<span>".$slPcArt_row['artMeta']."</span></div></div>";
}
$appRJ->response['result'].= "<div class='list-item all'><a href='/pc/'>все статьи</a></div></div>".
    "<div class='contentBlock-table-right'><h2>Свежая статья</h2>".
    "<img src='".ARTS_IMG_PAPH."/".$devPcMain['art_id']."/preview/".$devPcMain['artImg']."'>".
    "<div><a href='/pc/".$devPcMain['artAlias']."'>".$devPcMain['artName']."</a>".
    "<span>".$devPcMain['artMeta']."</span></div></div></div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";