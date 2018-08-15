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
    "<link rel='stylesheet' href='/site/downloads/css/dwlMan.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "</head>".
    "<body>";

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
$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$srvCnt."</span> записей";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='newItem'>";
$appRJ->response['result'].= "<a href='/services/srvMan/newService'><img src='/source/img/create-icon.png'>Создать услугу</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
if($srvCnt>0){
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