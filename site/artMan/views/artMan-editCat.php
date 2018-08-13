<?php

$h1 ="Правка категории меню";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Создание категории меню блога' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Правка категории</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>";
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subMenu.php");
$appRJ->response['result'].= "<form class='editImg'>";
$appRJ->response['result'].= "<div class='img-frame'>";
$delImgBtn_text=null;
if($Cat_rd->result['catImg']){
    $appRJ->response['result'].= "<img src='".ART_CATEG_IMG_PAPH.$_GET['cat_id']."/preview/".$Cat_rd->result['catImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='control-frame'>";
$appRJ->response['result'].= "<div class='delImg-line'>";
$appRJ->response['result'].= "<span onclick='delImg(".$_GET['cat_id'].", ".'"'."delCatImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='button-line'>";
$appRJ->response['result'].= "<input type='file' onchange='loadFiles(".$_GET['cat_id'].", ".'"'."cat_id".'"'.
    ")' accept='image/jpeg,image/png,image/gif'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='err-line'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "<form class='newCateg' method='post'>";
if(isset($catErr['common']) and $catErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($catErr['common']) and $catErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editCat'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='cat_id'>cat_id:</label>";
$appRJ->response['result'].= "<input type='text' name='cat_id' value='".$Cat_rd->result['artCat_id']."' disabled>";
$appRJ->response['result'].= "</div>";
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
$appRJ->response['result'].= "<textarea name='catDescr'>";

if($Cat_rd->result['catDescr']){
    $appRJ->response['result'].= $Cat_rd->result['catDescr'];
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
$categList_text="select artCat_id, artCatPar_id, catName from artCat_dt WHERE artCat_id<>".$Cat_rd->result['artCat_id'].
    " ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelectOptions.= "<option value='".$categList_row['artCat_id']."' ";
        if($categList_row['artCat_id'] == $Cat_rd->result['artCatPar_id']){
            $findSelected=true;
            $catSelectOptions.= " selected";
        }
        $catSelectOptions.= ">".$categList_row['catName']."</option>";
    }
    if($findSelected){
        $catSelectOptions="<option value='none'>---</option>".$catSelectOptions;
    }else{
        $catSelectOptions="<option value='none' selected>---</option>".$catSelectOptions;
    }
}else{
    $catSelectOptions="<option value='none' selected>---</option>";
}
/*<--select options*/
$appRJ->response['result'].= $catSelectOptions;
$appRJ->response['result'].= "</select>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='artCat_active'>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Cat_rd->result['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
//$appRJ->response['result'].= "<input type='checkbox'  checked>";
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