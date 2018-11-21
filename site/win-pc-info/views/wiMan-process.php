<?php
$h1 ="wdMan - editProcess";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование процесса'/>".
    "<meta name='robots' content='noindex'>".
    "<title>wdMan-editProcess</title>".
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
$appRJ->response['result'].= "<div class='info-line'><span class='fName'>processName:</span><span class='fVal'>".
    $slProcess_row['pName']."</span></div>";
$appRJ->response['result'].= "<form class='editImg'>".
    "<div class='img-frame'>";
$delImgBtn_text=null;
if($slProcess_row['pImg']){
    $appRJ->response['result'].= "<img src='".WD_PROC_IMG.$slProcess_row['pImg']."' ";
    $appRJ->response['result'].=">";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'>";
$appRJ->response['result'].=  "<div class='delImg-line'>".
    "<span onclick='delImg(".'"'.$slProcess_row['pName'].'", "process"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
    "<input type='file' onchange='loadFiles(".'"'.$slProcess_row['pName'].'"'.', "process"'.")' accept='image/jpeg,image/png,image/gif'></div>".
    "<div class='results'></div>";
$appRJ->response['result'].= "</div>".
    "</form>";
$appRJ->response['result'].= "<form class='wdEditParams'>".
    "<div class='field-err'></div>".
    "<div class='input-line'><label>lastMod</label><input type='date' name='lastMod' value='".$slProcess_row['lastMod']."'></div>".
    "<textarea name='hwDescr'>".$slProcess_row['pDescr']."</textarea>".
    "<input type='hidden' name='pEdit' value='yyy'>".
    "<input type='hidden' name='pVal' value='".$slProcess_row['pName']."'>".
    "<div class='input-line'><input type='button' value='Сохранить' onclick='editDescr()'></div>".
    "</form>";
$appRJ->response['result'].= "<form class='pPathList'>".
    "<div class='field-err'></div>";
$prPathList_qry="select * from wdProcPath_dt WHERE pName='".$slProcess_row['pName']."'";
$prPathList_res=$DB->doQuery($prPathList_qry);
if(mysql_num_rows($prPathList_res)>0){
    while ($prPathList_row=$DB->doFetchRow($prPathList_res)){
        $appRJ->response['result'].="<div class='line'>".$prPathList_row['pPath']."</div>";
    }
}else{

}
$appRJ->response['result'].="</form>";
$appRJ->response['result'].= "<form class='pPIDList'>".
    "<div class='field-err'></div>";
$prPIDList_qry="select * from wdProcPID_dt WHERE pName='".$slProcess_row['pName']."'";
$prPIDList_res=$DB->doQuery($prPIDList_qry);
if(mysql_num_rows($prPIDList_res)>0){
    while ($prPIDList_row=$DB->doFetchRow($prPIDList_res)){
        $appRJ->response['result'].="<div class='line ta-left'>".$prPIDList_row['PID']."</div>";
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