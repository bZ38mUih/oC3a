<?php

$h1 ="Правка группы";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Редактрование группы пользователей' http-equiv='Content-Type' charset='charset=utf-8'>";
//$appRJ->response['result'].= "<meta name='yandex-verification' content='02913709ba09b678' />";
$appRJ->response['result'].= "<title>Правка группы</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/personal-page/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/personal-page/views/ppMan-subMenu.php");
$appRJ->response['result'].= "<form class='editImg'>";
$appRJ->response['result'].= "<div class='img-frame'>";
$delImgBtn_text=null;
if($Gr_rd->result['img']){
    $appRJ->response['result'].= "<img src='".PP_USRGR_IMG_PAPH.$_GET['group_id']."/preview/".$Gr_rd->result['img']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='control-frame'>";
$appRJ->response['result'].= "<div class='delImg-line'>";
$appRJ->response['result'].= "<span onclick='delImg(".$_GET['group_id'].", ".'"'."delCatImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='button-line'>";
$appRJ->response['result'].= "<input type='file' onchange='loadFiles(".$_GET['group_id'].", ".'"'."group_id".'"'.")' accept='image/jpeg,image/png,image/gif'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='results'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "<form method='post'>";
if(isset($grErr['common']) and $grErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($grErr['common']) and $grErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editGroup'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='group_id'>group_id:</label>";
$appRJ->response['result'].= "<input type='text' name='group_id' value='".$Gr_rd->result['group_id']."' disabled>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catAlias'>Alias:</label>";
$appRJ->response['result'].= "<input type='text' name='groupAlias' ";
if($Gr_rd->result['groupAlias']){
    $appRJ->response['result'].= "value='".$Gr_rd->result['groupAlias']."'";
}
$appRJ->response['result'].= ">";

$appRJ->response['result'].= "<div class='field-err'>";
if(isset($grErr['groupAlias'])){
    $appRJ->response['result'].= $grErr['groupAlias'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='activeFlag'>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Gr_rd->result['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<input type='submit' value='save'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";