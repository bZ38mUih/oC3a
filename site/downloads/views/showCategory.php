<?php

$h1 =$selectCat_row['catName'];
$App['views']['social-block']=true;

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='".$selectCat_row['catDescr']."' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<title>Загрузки - ".$selectCat_row['catName']."</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";


$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/downloads/css/showCategory.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}

$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

$appRJ->response['result'].= "<div class='cat-caption'>";

$appRJ->response['result'].= "<div class='cat-caption-img'>";
if($selectCat_row['catImg']){
    $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectCat_row['dwlCat_id'].
        "/preview/".$selectCat_row['catImg']."'  id='shareImg'>";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='cat-caption-text'>";
if($selectCat_row['catDescr']){
    $appRJ->response['result'].= "<h2>".$selectCat_row['catDescr']."</h2>";
}else{
    $appRJ->response['result'].= "-";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='files-frame'>";
$appRJ->response['result'].= "<h3>Файлы: <span class='qty'>(".$selectFiles_count.")</span></h3>";

if($selectFiles_count>0){
    while ($selectFiles_row=$DB->doFetchRow($selectFiles_res)){
        $appRJ->response['result'].= "<a href='/downloads/file/".$selectFiles_row['dwlFileAliace']."' class='file-line'>";
        $appRJ->response['result'].= "<div class='file-line-img'>";
        if($selectFiles_row['fileImg']){
            $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$selectFiles_row['dwlFile_id'].
                "/preview/".$selectFiles_row['fileImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='file-line-text'>";
        $appRJ->response['result'].= "<div class='file-line-name'>";
        $appRJ->response['result'].= $selectFiles_row['dwlFileName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='file-line-descr'>";
        if($selectFiles_row['dwlFileDescr']){
            $appRJ->response['result'].= mb_substr($selectFiles_row['dwlFileDescr'], 0, 120, "UTF-8")." ...";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='file-line-version'>";
        $appRJ->response['result'].= "<strong>Версия: </strong>";
        if($selectFiles_row['fileVersion']){
            $appRJ->response['result'].= $selectFiles_row['fileVersion'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='file-line-licence'>";
        $appRJ->response['result'].= "<strong>Лицензия: </strong>";
        if($selectFiles_row['fileLicence']){
            $appRJ->response['result'].= $selectFiles_row['fileLicence'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";;
        $appRJ->response['result'].= "</div>";;
        $appRJ->response['result'].= "</a>";
    }
}else{
    $appRJ->response['result'].= "нет файлов для этой категории";
}
$appRJ->response['result'].= "</div>";

if($selectSubCat_count>0){
    $appRJ->response['result'].= "<div class='subCat-frame'>";
    $appRJ->response['result'].= "<h3>Еще в этой категории: <span class='qty'>(".$selectSubCat_count.")</span></h3>";
    while ($selectSubCat_row=$DB->doFetchRow($selectSubCat_res)){

        $appRJ->response['result'].= "<a href='/downloads/".$selectSubCat_row['catAlias']."' class='cat-line'>";
        $appRJ->response['result'].= "<div class='cat-line-img'>";
        if($selectSubCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectSubCat_row['dwlCat_id']."/preview/".$selectSubCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='cat-line-text'>";
        $appRJ->response['result'].= "<div class='cat-line-name'>";
        $appRJ->response['result'].= $selectSubCat_row['catName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='cat-line-descr'>";
        if($selectSubCat_row['catDescr']){
            $appRJ->response['result'].= $selectSubCat_row['catDescr'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";;
        $appRJ->response['result'].= "</a>";
    }
    $appRJ->response['result'].= "</div>";
}


$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";
