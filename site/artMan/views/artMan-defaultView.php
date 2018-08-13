<?php
$h1 ="Статьи";

$curPage = 1;
$itLnP=10;

if(isset($_GET['page']) and $_GET['page']!=null){
    $curPage = $_GET['page'];
}


$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Управление статьями и справочником' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<title>artMan</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/downloads/css/dwlMan.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "</head>";
$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subMenu.php");

$cntArt_qry = "select COUNT(art_id) as cntArts from art_dt";
$cntArt_res = $DB->doQuery($cntArt_qry);
$cntArt_row = $DB->doFetchRow($cntArt_res);

$slArt_qry = "select art_dt.art_id, art_dt.artCat_id, art_dt.artName, art_dt.artAlias, art_dt.artMeta, ".
    "art_dt.artImg, art_dt.activeFlag, artCat_dt.catName from art_dt ".
    "LEFT JOIN artCat_dt ON art_dt.artCat_id=artCat_dt.artCat_id order by pubDate DESC limit ".strval(($curPage-1)*$itLnP).
    ", ".$itLnP;

$slArt_res=$DB->doQuery($slArt_qry);
$itmCnt=0;
if(mysql_num_rows($slArt_res)>0){
    $itmCnt=mysql_num_rows($slArt_res);
}
$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$cntArt_row['cntArts']."</span> записей";

if($cntArt_row['cntArts']/$itLnP>1){
    $appRJ->response['result'].= ", стр. ";
    $curPp=1;
    while($itLnP*($curPp-1) < $cntArt_row['cntArts']){
        $appRJ->response['result'].="<a href='?page=".$curPp."'";
        if($curPp==$curPage){
            $appRJ->response['result'].=" class='active'";
        }
        $appRJ->response['result'].=">";
        $appRJ->response['result'].=strval($curPp);
        $appRJ->response['result'].= "</a>";
        $curPp++;
    }
}

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='/artMan/newArt/'><img src='/source/img/create-icon.png'>Создать статью</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($itmCnt>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "art_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "artImg";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-name'>";
    $appRJ->response['result'].= "artName";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias'>";
    $appRJ->response['result'].= "artAlias";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-fCateg'>";
    $appRJ->response['result'].= "categ";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-flag'>";
    $appRJ->response['result'].= "activeFlag";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "preview";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    while ($slArt_row=$DB->doFetchRow($slArt_res)){
        $appRJ->response['result'].= "<div class='item-line'>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='/artMan/editArt/?art_id=".$slArt_row['art_id']."'>".$slArt_row['art_id']."</a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($slArt_row['artImg']){
            $appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH.$slArt_row['art_id']."/preview/".$slArt_row['artImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-name'>";
        $appRJ->response['result'].= $slArt_row['artName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-alias'>";
        $appRJ->response['result'].= $slArt_row['artAlias'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-fCateg'>";
        $appRJ->response['result'].= $slArt_row['catName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($slArt_row['activeFlag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='/artMan/preview/?art_id=".$slArt_row['art_id']."'>".
            $slArt_row['art_id']."</a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "there is no arts there<br>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";