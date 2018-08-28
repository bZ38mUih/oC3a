<?php
$h1 ="Файлы";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Системное, офисное, популяное ПО. Ссылки на загрузки программ.'/>".
    "<title>Файлы</title>".
    "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/dwlMan-subMenu.php");
$selectFiles_query = "select * from dwlFiles_dt LEFT JOIN dwlCat_dt ON dwlFiles_dt.dwlCat_id=dwlCat_dt.dwlCat_id";
$selectFiles_res=$DB->doQuery($selectFiles_query);
$filesCount=0;
if(mysql_num_rows($selectFiles_res)>0){
    $filesCount=mysql_num_rows($selectFiles_res);
}
$appRJ->response['result'].= "<div class='manFrame'><div class='manTopPanel'>".
    "<div class='itemsCount'>Всего: <span>".$filesCount."</span> записей</div>".
    "<div class='newItem'>".
    "<a href='/downloads/dwlManager/newFile/'><img src='/source/img/create-icon.png'>Добавить файл</a>".
    "</div></div>";
if($filesCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'><div class='item-line-id'>file_id</div>".
        "<div class='item-line-img'>fileImg</div><div class='item-line-name'>fileName</div>".
        "<div class='item-line-alias'>fileAlias</div><div class='item-line-fVersion'>fileVers</div>".
        "<div class='item-line-flag'>fileFlag</div><div class='item-line-fCateg'>categ</div></div>";
    while ($selectFile_row=$DB->doFetchRow($selectFiles_res)){
        $appRJ->response['result'].= "<div class='item-line'>".
            "<div class='item-line-id'>".
            "<a href='/downloads/dwlManager/editFile/?file_id=".$selectFile_row['dwlFile_id']."'>".
            $selectFile_row['dwlFile_id']."</a>".
            "</div>".
            "<div class='item-line-img'>";
        if($selectFile_row['fileImg']){
            $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$selectFile_row['dwlFile_id']."/preview/".$selectFile_row['fileImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>".
            "<div class='item-line-name'>".$selectFile_row['dwlFileName']."</div>".
            "<div class='item-line-alias'>".$selectFile_row['dwlFileAliace']."</div>".
            "<div class='item-line-fVersion'>";
        if($selectFile_row['fileVersion']){
            $appRJ->response['result'].= $selectFile_row['fileVersion'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div><div class='item-line-flag'>".
            "<input type='checkbox' ";
        if($selectFile_row['fileActive_flag']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled></div><div class='item-line-fCateg'>".
            $selectFile_row['catName']."</div></div>";
    }
}else{
    $appRJ->response['result'].= "there is no files there<br>";
}
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";