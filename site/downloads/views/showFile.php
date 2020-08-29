<?php
$selectFile_text = "select * from dwlFiles_dt WHERE dwlFileAliace='".$appRJ->server['reqUri_expl'][3]."'";
$selectFile_res = $DB->query($selectFile_text);
if(mysql_num_rows($selectFile_res)==1){
    $selectFile_row = $selectFile_res->fetch(PDO::FETCH_ASSOC);
    $h1 =$selectFile_row['dwlFileName'];
    $App['views']['social-block']=true;
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
        "<meta name='description' content='".$selectFile_row['dwlFileName'].": описание, ссылки на загрузку.'/>".
        "<title>Загрузки - Файл</title>".
        "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
        "<script src='/source/js/jquery-3.2.1.js'></script>".
        "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
        "<script src='/site/siteHeader/js/modalHeader.js'></script>".
        "<link rel='stylesheet' href='/site/downloads/css/showFile.css' type='text/css' media='screen, projection'/>";
    if($App['views']['social-block']){
        $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
    }
    $appRJ->response['result'].= "</head>".
        "<body>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
    $appRJ->response['result'].= "<div class='contentBlock-frame'>".
        "<div class='contentBlock-center'>".
        "<div class='contentBlock-wrap'>".
        "<div class='file-frame'>".
        "<div class='file-name'>".$selectFile_row['dwlFileName']."</div>".
        "<div class='left-block'>".
        "<div class='file-img'>";
    if($selectFile_row['fileImg']){
        $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$selectFile_row['dwlFile_id'].
            "/preview/".$selectFile_row['fileImg']."' id='shareImg'>";
    }else{
        $appRJ->response['result'].= "<img src='/data/default-img.png'>";
    }
    $appRJ->response['result'].= "</div><div class='file-version'><strong>Версия: </strong>";
    if($selectFile_row['fileVersion']){
        $appRJ->response['result'].= $selectFile_row['fileVersion'];
    }else{
        $appRJ->response['result'].= "-";
    }
    $appRJ->response['result'].= "</div><div class='file-licence'><strong>Лиценизия: </strong>";
    if($selectFile_row['fileLicence']){
        $appRJ->response['result'].= $selectFile_row['fileLicence'];
    }else{
        $appRJ->response['result'].= "-";
    }
    $appRJ->response['result'].= "</div></div>".
        "<div class='right-block'>".
        "<div class='file-descr'>";
    if($selectFile_row['dwlFileDescr']){
        $appRJ->response['result'].= $selectFile_row['dwlFileDescr'];
    }else{
        $appRJ->response['result'].= "-";
    }
    $appRJ->response['result'].= "</div></div>".
        "<div class='file-links'>";
    $selectLinks_text="select * from dwlLnk_dt WHERE dwlFile_id=".$selectFile_row['dwlFile_id'];
    $selectLinks_res=$DB->query($selectLinks_text);
    $selectLinks_count=mysql_num_rows($selectLinks_res);
    if($selectLinks_count>0){
        $appRJ->response['result'].= "<strong>Ссылки:</strong>";
        $appRJ->response['result'].= "<ol>";
        while ($selectLinks_row = $selectLinks_res->fetch(PDO::FETCH_ASSOC)){
            $appRJ->response['result'].= "<li>";
            $appRJ->response['result'].= "<a href='".$selectLinks_row['refLink']."' title='".$selectLinks_row['refLink']."' target='_blank'>".
                $selectLinks_row['refText']."</a>";
            $appRJ->response['result'].= "</li>";
        }
        $appRJ->response['result'].= "</ol>";
    }else{
        $appRJ->response['result'].= "there is no links fo this file";
    }
    $appRJ->response['result'].= "</div>".
        "</div></div></div></div>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
    $appRJ->response['result'].= "</body></html>";

}else{
    $appRJ->errors['404']['description']="Файл ".$appRJ->server['reqUri_expl'][3]." не найден";
}
