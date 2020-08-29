<?php
$h1 ="wdMan - editService";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование службы'/>".
    "<meta name='robots' content='noindex'>".
    "<title>wdMan-editService</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<script type='text/javascript' src='/site/win-pc-info/js/wiMan-edit.js'></script>" .
    "<link rel='stylesheet' href='/site/win-pc-info/css/wdEdit.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
$appRJ->response['result'].="<div class='wdEdit'>";
$appRJ->response['result'].= "<div class='info-line'><span class='fName'>serviceName:</span><span class='fVal'>".
    $slSrv_row['sName']."</span></div>";
/*
    "<div class='info-line'><span class='fName'>paramVal:</span><span class='fVal'>".
    $slHw_row['paramVal']."</span></div>";
*/
$appRJ->response['result'].= "<form class='editImg'>".
    "<div class='img-frame'>";
$delImgBtn_text=null;
if($slSrv_row['sImg']){
    $appRJ->response['result'].= "<img src='".WD_SRV_IMG.$slSrv_row['sImg']."' ";
    $appRJ->response['result'].=">";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'>";
$appRJ->response['result'].=  "<div class='delImg-line'>".
    "<span onclick='delImg(".'"'.$slSrv_row['sName'].'", "service"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
    "<input type='file' onchange='loadFiles(".'"'.$slSrv_row['sName'].'"'.', "service"'.")' accept='image/jpeg,image/png,image/gif'></div>".
    "<div class='results'></div>";
$appRJ->response['result'].= "</div>".
    "</form>";
$appRJ->response['result'].= "<form class='wdEditParams'>".
    "<div class='field-err'></div>".
    "<div class='input-line'><label>lastMod</label><input type='date' name='lastMod' value='".$slSrv_row['lastMod']."'></div>".
    "<textarea name='sDescr'>".$slSrv_row['sDescr']."</textarea>".
    "<input type='hidden' name='sEdit' value='yyy'>".
    "<input type='hidden' name='pVal' value='".$slSrv_row['sName']."'>".
    "<div class='input-line'><input type='button' value='Сохранить' onclick='editDescr()'></div>".
    "</form>";
$appRJ->response['result'].= "<form class='sPathList'>".
    "<div class='field-err'></div>";
$srvPathList_qry="select * from wdSrvPath_dt WHERE sName='".$slSrv_row['sName']."'";
$srvPathList_res=$DB->query($srvPathList_qry);
if(mysql_num_rows($srvPathList_res)>0){
    while ($srvPathList_row = $srvPathList_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].="<div class='line'>".$srvPathList_row['sPath']."</div>";
    }
}else{

}
$appRJ->response['result'].="</form>";
$appRJ->response['result'].= "<form class='pPIDList'>".
    "<div class='field-err'></div>";
$srvSTName_qry="select * from wdSrvSTName_dt WHERE sName='".$slSrv_row['sName']."'";
$srvSTName_res=$DB->query($srvSTName_qry);
if(mysql_num_rows($srvSTName_res)>0){
    while ($srvSTName_row = $srvSTName_res->fetch(PDO::FETCH_ASSOC)){
        $appRJ->response['result'].="<div class='line ta-left'>".$srvSTName_row['sSTName']."</div>";
    }
}else{

}
$appRJ->response['result'].="</form>";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].= "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";