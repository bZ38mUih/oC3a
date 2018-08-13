<?php

$h1 ="Создание категории";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Создание категории меню справочника и статей' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Создание категории</title>";
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

$appRJ->response['result'].= "<form class='newCateg' method='post'>";
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='newCat'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catName'>Название:</label>";

$appRJ->response['result'].= "<input type='text' name='catName' id='targetName' ";
if($Cat_rd->result['catName']){
    $appRJ->response['result'].= "value='".$Cat_rd->result['catName']."'";
}
$appRJ->response['result'].= ">";

$appRJ->response['result'].= "<div class='field-err'>";
if(isset($catErr['catName'])){
    $appRJ->response['result'].= $catErr['catName'];
}

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catAlias'>Alias:</label>";
$appRJ->response['result'].= "<input type='text' name='catAlias' id='targetAlias' ";
if($Cat_rd->result['catAlias']){
    $appRJ->response['result'].= "value='".$Cat_rd->result['catAlias']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<input type='button' onclick='mkAlias()' value='mkCatAlias'>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($catErr['catAlias'])){
    $appRJ->response['result'].= $catErr['catAlias'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catDescr'>Описание:</label>";
$appRJ->response['result'].= "<textarea name='catDescr' rows='3'>";
if($Cat_rd->result['catDescr']){
    $appRJ->response['result'].= "value='".$Cat_rd->result['catDescr']."'";
}
$appRJ->response['result'].= "</textarea>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($catErr['catDescr'])){
    $appRJ->response['result'].= $catErr['catDescr'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='artCatPar_id'>artCatPar_id:</label>";

$appRJ->response['result'].= "<select name='artCatPar_id'>";

/*select options-->*/
$categList_text="select artCat_id, artCatPar_id, catName from artCat_dt ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelect.= "<option value='".$categList_row['artCat_id']."' ";
        if($categList_row['artCat_id'] == $Cat_rd->result['artCatPar_id']){
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
$appRJ->response['result'].= "<label>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Cat_rd->result['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
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