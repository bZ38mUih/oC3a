<?php
$artByAlias_qry="select art_dt.art_id, art_dt.artName, art_dt.artMeta, art_dt.artImg, artCat_dt.catAlias, ".
    "artCat_dt.catName, art_dt.pubDate, art_dt.refreshDate from art_dt ".
    "INNER JOIN artCat_dt ON art_dt.artCat_id = artCat_dt.artCat_id ".
    "WHERE art_dt.artAlias='".$appRJ->server['reqUri_expl'][2]."'";
$artByAlias_res=$DB->doQuery($artByAlias_qry);
if(mysql_num_rows($artByAlias_res)!==1){
    $appRJ->errors['404']['description']="такой статьи не существует";
    $appRJ->throwErr();
}
$artByAlias_row=$DB->doFetchRow($artByAlias_res);
$h1 =$artByAlias_row['artName'];
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='".$artByAlias_row['artMeta']."'/>".
    "<title>Справочник</title>".
    "<link rel='SHORTCUT ICON' href='/site/handbook/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/artMan/css/preview.css' type='text/css' media='screen, projection'/>".

    "<script src='/site/handbook/js/wpi-search.js'></script>".
    "<link rel='stylesheet' href='/site/handbook/css/wpi-styles.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='art-header'><div class='art-header-descr'><h2>".$artByAlias_row['artMeta']."</h2></div><div class='art-header-img'>".
    "<img src='".ARTS_IMG_PAPH.$artByAlias_row['art_id']."/preview/".$artByAlias_row['artImg']."' id='shareImg'>".
    "</div>";
$appRJ->response['result'].= "</div><div class='art-content'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/handbook/views/wpi/wpi-searchForm.php");
$appRJ->response['result'].="<div class='wiSearch'>";
if(!$appRJ->server['reqUri_expl'][3]){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/handbook/views/wpi/wpi-searchHw.php");
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";