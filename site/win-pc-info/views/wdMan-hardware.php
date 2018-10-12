<?php
$h1 ="wdMan - editHardware";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование аппаратуры'/>".
    "<meta name='robots' content='noindex'>".
    "<title>wdMan-editHardware</title>".
    "<link rel='SHORTCUT ICON' href='/site/win-pc-info/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    //"<script src='/site/win-diag/js/win-diag.js'></script>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<script type='text/javascript' src='/site/win-pc-info/js/win-diag.js'></script>".
    "<link rel='stylesheet' href='/site/win-pc-info/css/wdEdit.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
$appRJ->response['result'].="<div class='wdEdit'>";
$appRJ->response['result'].= "<div class='info-line'><span class='fName'>paramName:</span><span class='fVal'>".
    $slHw_row['paramName']."</span></div>".
    "<div class='info-line'><span class='fName'>paramVal:</span><span class='fVal'>".
    $slHw_row['paramVal']."</span></div>";
$appRJ->response['result'].= "<form class='editImg'>".
    "<div class='img-frame'>";
$delImgBtn_text=null;
if($slHw_row['hwImg']){
    $appRJ->response['result'].= "<img src='".WD_HW_IMG.$slHw_row['paramName']."/preview/".
        $slHw_row['hwImg']."' ";
    $appRJ->response['result'].=">";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'>";
$appRJ->response['result'].=  "<div class='delImg-line'>".
    "<span onclick='delImg(".'"'.$slHw_row['paramVal'].'"'.", ".'"'.$slHw_row['paramName'].'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
    "<input type='file' onchange='loadFiles(".'"'.$slHw_row['paramVal'].'"'.", ".'"'.$slHw_row['paramName'].'"'.")' accept='image/jpeg,image/png,image/gif'></div>".
    "<div class='results'></div>";
$appRJ->response['result'].= "</div>".
    "</form>";
$appRJ->response['result'].= "<form class='wdEditParams'>".
    "<div class='field-err'></div>".
    "<textarea name='hwDescr'>".$slHw_row['hwDescr']."</textarea>".
    "<input type='hidden' name='hwEdit' value='yyy'>".
    "<input type='hidden' name='pName' value='".$slHw_row['paramName']."'>".
    "<input type='hidden' name='pVal' value='".$slHw_row['paramVal']."'>".
    "<div class='input-line'><input type='button' value='Сохранить' onclick='editDescr()'></div>".
    "</form>";
$appRJ->response['result'].="</div>";
//require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-diag/views/diagMenu.php");
$appRJ->response['result'].= "</div></div></div>";




require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";