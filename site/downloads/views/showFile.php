<?php
$selectFile_text = "select * from dwlFiles_dt WHERE dwlFileAliace='".$appRJ->server['reqUri_expl'][3]."'";
$selectFile_res = $DB->doQuery($selectFile_text);
if(mysql_num_rows($selectFile_res)==1){

    $selectFile_row=$DB->doFetchRow($selectFile_res);

    $h1 =$selectFile_row['dwlFileName'];

    $App['views']['social-block']=true;

    $appRJ->response['result'].= "<!DOCTYPE html>";
    $appRJ->response['result'].= "<html lang='en-Us'>";
    $appRJ->response['result'].= "<head>";
    $appRJ->response['result'].= "<meta name='description' content='".$selectFile_row['dwlFileName'].": описание, ссылки на загрузку.' http-equiv='Content-Type' charset='charset=utf-8'>";

    $appRJ->response['result'].= "<title>Загрузки - Файл</title>";
    $appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
    $appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";


    $appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/downloads/css/showFile.css' type='text/css' media='screen, projection'/>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}


    $appRJ->response['result'].= "</head>";

    $appRJ->response['result'].= "<body>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

    $appRJ->response['result'].= "<div class='contentBlock-frame'>";
    $appRJ->response['result'].= "<div class='contentBlock-center'>";
    $appRJ->response['result'].= "<div class='contentBlock-wrap'>";
    $appRJ->response['result'].= "<div class='file-frame'>";
    $appRJ->response['result'].= "<div class='file-name'>";
    $appRJ->response['result'].= $selectFile_row['dwlFileName'];
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='left-block'>";
    $appRJ->response['result'].= "<div class='file-img'>";
    if($selectFile_row['fileImg']){
        $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$selectFile_row['dwlFile_id'].
            "/preview/".$selectFile_row['fileImg']."' id='shareImg'>";
    }else{
        $appRJ->response['result'].= "<img src='/data/default-img.png'>";
    }
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='file-version'>";
    $appRJ->response['result'].= "<strong>Версия: </strong>";
    if($selectFile_row['fileVersion']){
        $appRJ->response['result'].= $selectFile_row['fileVersion'];
    }else{
        $appRJ->response['result'].= "-";
    }
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='file-licence'>";
    $appRJ->response['result'].= "<strong>Лиценизия: </strong>";
    if($selectFile_row['fileLicence']){
        $appRJ->response['result'].= $selectFile_row['fileLicence'];
    }else{
        $appRJ->response['result'].= "-";
    }
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";


    $appRJ->response['result'].= "<div class='right-block'>";

    $appRJ->response['result'].= "<div class='file-descr'>";
    if($selectFile_row['dwlFileDescr']){
        $appRJ->response['result'].= $selectFile_row['dwlFileDescr'];
    }else{
        $appRJ->response['result'].= "-";
    }
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";

    $appRJ->response['result'].= "<div class='file-links'>";
    $selectLinks_text="select * from dwlLnk_dt WHERE dwlFile_id=".$selectFile_row['dwlFile_id'];
    $selectLinks_res=$DB->doQuery($selectLinks_text);
    $selectLinks_count=mysql_num_rows($selectLinks_res);
    if($selectLinks_count>0){
        $appRJ->response['result'].= "<strong>Ссылки:</strong>";
        $appRJ->response['result'].= "<ol>";
        while ($selectLinks_row=$DB->doFetchRow($selectLinks_res)){
            $appRJ->response['result'].= "<li>";
            $appRJ->response['result'].= "<a href='".$selectLinks_row['refLink']."' title='".$selectLinks_row['refLink']."' target='_blank'>".
                $selectLinks_row['refText']."</a>";
            $appRJ->response['result'].= "</li>";
        }
        $appRJ->response['result'].= "</ol>";
    }else{
        $appRJ->response['result'].= "there is no links fo this file";
    }

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

}else{

}
