<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/site/artMan/actions/printList.php");
$h1 ="it-Блог";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Блог на темы web и net разработки и компьютерых технологий.'/>".
    "<title>it-Блог</title>".
    "<link rel='SHORTCUT ICON' href='/site/blog/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<script src='/source/js/jquery.cookie.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/gallery/css/mainView.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/js/list-view.js'></script>".
    "<link rel='stylesheet' href='/site/css/listView.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/blog/css/blog.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/js/social-block.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'><div class='contentBlock-wrap'><div class='list-frame'>";
$artByAlias_qry="select art_dt.art_id, art_dt.artName, art_dt.artMeta, art_dt.artImg, art_dt.allowCm, artCat_dt.catAlias, ".
    "artCat_dt.catName, artCat_dt.artCat_id, art_dt.artAlias, art_dt.pubDate, art_dt.refreshDate from art_dt ".
    "INNER JOIN artCat_dt ON art_dt.artCat_id = artCat_dt.artCat_id ".
    "where artCat_dt.artCat_id=3 OR artCat_dt.artCat_id=1 order by art_dt.pubDate DESC LIMIT 1 ";
$artByAlias_res=$DB->doQuery($artByAlias_qry);
$artByAlias_row=$DB->doFetchRow($artByAlias_res);
$appRJ->response['result'].="<h2>Свежая статья</h2>";
$ref=null;
if($artByAlias_row['artCat_id']==3){
    $ref="dev";
}elseif ($artByAlias_row['artCat_id']==1){
    $ref="pc";
}
$appRJ->response['result'].="<div class='art-header'><div class='art-header-descr'><a href='/".$ref."/".$artByAlias_row['artAlias'];

$appRJ->response['result'].="'>".$artByAlias_row['artName']."</a><div>".$artByAlias_row['artMeta']."</div></div><div class='art-header-img'>".
"<img src='".ARTS_IMG_PAPH.$artByAlias_row['art_id']."/preview/".$artByAlias_row['artImg']."' id='shareImg'>".
"</div>";

if($artByAlias_row['pubDate']){
    $appRJ->response['result'].= "<div class='dateLine'><span class='dateFld'>Опубликовано:</span>".
        "<span class='dateVal'>".$artByAlias_row['pubDate']."</span></div>";
}


if($artByAlias_row['refreshDate']){
    $appRJ->response['result'].= "<div class='dateLine'><span class='dateFld'>Обновлено:</span>".
        "<span class='dateVal'>".$artByAlias_row['refreshDate']."</span></div>";
}
$appRJ->response['result'].= "</div>";


//$prtLst= printList(3, $DB, $appRJ->server['reqUri_expl'][1]);
$prtLst= printList(null, $DB, $appRJ->server['reqUri_expl'][1]);
$appRJ->response['result'].= "<div class='cat-stat main'>";
if(isset($prtLst['cntItm']) or isset($prtLst['cntCat'])){
    $appRJ->response['result'].= "<strong>Всего: </strong>";
    if($prtLst['cntItm']){
        $appRJ->response['result'].= "<span class='flVal'>".$prtLst['cntItm']."</span> стат.";
    }
    if($prtLst['cntCat']){
        $appRJ->response['result'].= "<span class='flVal'>".$prtLst['cntCat']."</span> кат.";
    }
}
$appRJ->response['result'].= "</div>".$prtLst['text']."</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";