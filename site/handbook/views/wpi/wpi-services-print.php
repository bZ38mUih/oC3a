<?php
$wdInfo_res=$DB->doQuery($wdInfo_qry);
if(mysql_num_rows($wdInfo_res)==1){
    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
    $wdInfo.="<div class='wi-descr'>";
    if($wdInfo_row['sDescr']){
        $wdInfo.=$wdInfo_row['sDescr'];
    }else{
        $wdInfo.="описание не задано";
    }
    $wdInfo.="</div>";
}else{
    $appRJ->errors['404']['description']="invalid sName";
    $appRJ->throwErr();
}
$h1 ="Описание службы Windows";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Описание службы ".$wdInfo_row['sName']."'/>".
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
    "<link rel='stylesheet' href='/site/handbook/css/wpi-styles.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
$appRJ->response['result'].= "<div class='art-header'><div class='art-header-descr'><h2>".$wdInfo_row['sName'].
    "</h2></div><div class='art-header-img'>";
if($wdInfo_row['sImg']){
    $appRJ->response['result'].="<img src='".WD_SRV_IMG.$wdInfo_row['sImg']."' id='shareImg'>";
}else{
    $appRJ->response['result'].="<img src='/data/default-img.png'>";
}
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].="<div class='art-content'>";
$appRJ->response['result'].= "<div class='wi-results ta-left'>";
$appRJ->response['result'].= $wdInfo."</div></div>";
$appRJ->response['result'].= "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";