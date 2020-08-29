<?php
$h1 =$selectCat_row['catName'];
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='".$selectCat_row['catDescr']."'/>".
    "<title>Загрузки - ".$selectCat_row['catName']."</title>".
    "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/downloads/css/showCategory.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>".
    "<div class='cat-caption'><div class='cat-caption-img'>";
if($selectCat_row['catImg']){
    $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectCat_row['dwlCat_id'].
        "/preview/".$selectCat_row['catImg']."'  id='shareImg'>";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='cat-caption-text'>";
if($selectCat_row['catDescr']){
    $appRJ->response['result'].= "<h2>".$selectCat_row['catDescr']."</h2>";
}else{
    $appRJ->response['result'].= "-";
}
$appRJ->response['result'].= "</div></div></div>".
    "<div class='files-frame'><h3>Файлы: <span class='qty'>(".$selectFiles_count.")</span></h3>";
if($selectFiles_count>0){
    while ($selectFiles_row = $selectFiles_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].= "<a href='/downloads/file/".$selectFiles_row['dwlFileAliace'].
            "' class='file-line'><div class='file-line-img'>";
        if($selectFiles_row['fileImg']){
            $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$selectFiles_row['dwlFile_id'].
                "/preview/".$selectFiles_row['fileImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div><div class='file-line-text'><div class='file-line-name'>".
            $selectFiles_row['dwlFileName']."</div><div class='file-line-descr'>";
        if($selectFiles_row['dwlFileDescr']){
            $appRJ->response['result'].= mb_substr($selectFiles_row['dwlFileDescr'], 0, 120, "UTF-8")." ...";
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div><div class='file-line-version'><strong>Версия: </strong>";
        if($selectFiles_row['fileVersion']){
            $appRJ->response['result'].= $selectFiles_row['fileVersion'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div><div class='file-line-licence'><strong>Лицензия: </strong>";
        if($selectFiles_row['fileLicence']){
            $appRJ->response['result'].= $selectFiles_row['fileLicence'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div></div></a>";
    }
}else{
    $appRJ->response['result'].= "нет файлов для этой категории";
}
$appRJ->response['result'].= "</div>";

if($selectSubCat_count>0){
    $appRJ->response['result'].= "<div class='subCat-frame'>".
        "<h3>Еще в этой категории: <span class='qty'>(".$selectSubCat_count.")</span></h3>";
    while ($selectSubCat_row = $selectSubCat_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].= "<a href='/downloads/".$selectSubCat_row['catAlias']."' class='cat-line'>";
        $appRJ->response['result'].= "<div class='cat-line-img'>";
        if($selectSubCat_row['catImg']){
            $appRJ->response['result'].= "<img src='".DWL_CATEG_IMG_PAPH.$selectSubCat_row['dwlCat_id']."/preview/".$selectSubCat_row['catImg']."'>";
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div><div class='cat-line-text'><div class='cat-line-name'>".
            $selectSubCat_row['catName']."</div><div class='cat-line-descr'>";
        if($selectSubCat_row['catDescr']){
            $appRJ->response['result'].= $selectSubCat_row['catDescr'];
        }else{
            $appRJ->response['result'].= "-";
        }
        $appRJ->response['result'].= "</div></div></a>";
    }
    $appRJ->response['result'].= "</div>";
}
$appRJ->response['result'].= "</div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";
