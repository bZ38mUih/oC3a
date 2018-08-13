<?php

$h1 ="Файлы";

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Системное, офисное, популяное ПО. Ссылки на загрузки программ.' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<title>Файлы</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
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

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/dwlMan-subMenu.php");

$selectFiles_query = "select * from dwlFiles_dt LEFT JOIN dwlCat_dt ON dwlFiles_dt.dwlCat_id=dwlCat_dt.dwlCat_id";
$selectFiles_res=$DB->doQuery($selectFiles_query);
$filesCount=0;
if(mysql_num_rows($selectFiles_res)>0){
    $filesCount=mysql_num_rows($selectFiles_res);
}
$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$filesCount."</span> записей";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='/downloads/dwlManager/newFile/'><img src='/source/img/create-icon.png'>Добавить файл</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($filesCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "file_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "fileImg";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-name'>";
    $appRJ->response['result'].= "fileName";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias'>";
    $appRJ->response['result'].= "fileAlias";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-fVersion'>";
    $appRJ->response['result'].= "fileVers";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-flag'>";
    $appRJ->response['result'].= "fileFlag";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-fCateg'>";
    $appRJ->response['result'].= "categ";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    while ($selectFile_row=$DB->doFetchRow($selectFiles_res)){
        $appRJ->response['result'].= "<div class='item-line'>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='/downloads/dwlManager/editFile/?file_id=".$selectFile_row['dwlFile_id']."'>".$selectFile_row['dwlFile_id']."</a>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($selectFile_row['fileImg']){
            $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$selectFile_row['dwlFile_id']."/preview/".$selectFile_row['fileImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-name'>";
        $appRJ->response['result'].= $selectFile_row['dwlFileName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-alias'>";
        $appRJ->response['result'].= $selectFile_row['dwlFileAliace'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-fVersion'>";
        if($selectFile_row['fileVersion']){
            $appRJ->response['result'].= $selectFile_row['fileVersion'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($selectFile_row['fileActive_flag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-fCateg'>";
        $appRJ->response['result'].= $selectFile_row['catName'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "there is no files there<br>";
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