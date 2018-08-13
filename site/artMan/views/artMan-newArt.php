<?php

$h1 ="Создание статьи";

$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Создание альбома в галерее' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>artMan</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";

require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subMenu.php");

$appRJ->response['result'].= "<form method='post'>";
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='newArt'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='artName'>Название:</label>";

$appRJ->response['result'].= "<input type='text' name='artName' id='targetName' ";
if($Art_rd->result['artName']){
    $appRJ->response['result'].= "value='".$Art_rd->result['artName']."'";
}
$appRJ->response['result'].= ">";

$appRJ->response['result'].= "<div class='field-err'>";
if(isset($artErr['artName'])){
    $appRJ->response['result'].= $artErr['artName'];
}

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='artAlias'>Alias:</label>";
$appRJ->response['result'].= "<input type='text' name='artAlias' id='targetAlias' ";
if($Art_rd->result['artAlias']){
    $appRJ->response['result'].= "value='".$Art_rd->result['artAlias']."'";
}
$appRJ->response['result'].= ">";

$appRJ->response['result'].= "<input type='button' onclick='mkAlias()' value='mkArtAlias'>";


$appRJ->response['result'].= "<div class='field-err'>";
if(isset($artErr['artAlias'])){
    $appRJ->response['result'].= $artErr['artAlias'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";

$appRJ->response['result'].= "<label>Мета:</label>";

$appRJ->response['result'].= "<textarea name='artMeta' rows='3' >";
if($Art_rd->result['artMeta']){
    $appRJ->response['result'].= $Art_rd->result['artMeta'];
}
$appRJ->response['result'].= "</textarea>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($artErr['artMeta'])){
    $appRJ->response['result'].= $artErr['artMeta'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";

$appRJ->response['result'].= "<label>artCat_id:</label>";

$appRJ->response['result'].= "<select name='artCat_id'>";

/*select options-->*/
$categList_text="select artCat_id, artCatPar_id, catName from artCat_dt ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelect.= "<option value='".$categList_row['artCat_id']."' ";
        if($categList_row['artCat_id'] == $Art_rd->result['art_id']){
            $findSelected=true;
            $catSelect.= " selected";
        }
        $catSelect.= ">".$categList_row['catName']."</option>";
    }
    if($findSelected){
        $catSelect="<option value='none'>---</option>".$catSelect;
    }else{
        $catSelect="<option value='none' selected>---</option>".$catSelect;
    }
}else{
    $catSelect="<option value='none' selected>---</option>";
}
/*<--select options*/
$appRJ->response['result'].= $catSelect;
$appRJ->response['result'].= "</select>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
//$appRJ->response['result'].= "<label for='activeFlag'>Показывать:</label>";
$appRJ->response['result'].= "<label>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Art_rd->result['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
//$appRJ->response['result'].= "<input type='checkbox'  checked>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<input type='submit' value='addNew'>";
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