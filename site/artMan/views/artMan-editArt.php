<?php
$h1 ="Правка статьи";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Правка статьи' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>artMan</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/artMan/css/refForm.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/artMan/js/loadPage.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "</head>";
$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subContentMenu.php");
$appRJ->response['result'].= "<form class='editImg'>";
$appRJ->response['result'].= "<div class='img-frame'>";
$delImgBtn_text=null;
if($Art_rd->result['artImg']){
    $appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH.$_GET['art_id']."/preview/".$Art_rd->result['artImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='control-frame'>";
$appRJ->response['result'].= "<div class='delImg-line'>";
$appRJ->response['result'].= "<span onclick='delImg(".$_GET['art_id'].", ".'"'."delArtImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='button-line'>";
$appRJ->response['result'].= "<input type='file' onchange='loadFiles(".$_GET['art_id'].", ".'"'."art_id".'"'.")' accept='image/jpeg,image/png,image/gif'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='results'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "<form method='post'>";
if(isset($artErr['common']) and $artErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($artErr['common']) and $artErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editArt'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label>art_id:</label>";
$appRJ->response['result'].= "<input type='text' name='art_id' value='".$Art_rd->result['art_id']."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label>Название:</label>";
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
$appRJ->response['result'].= "<label>Alias:</label>";
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
$appRJ->response['result'].= "<label>Описание:</label>";
$appRJ->response['result'].= "<textarea name='artMeta' rows='5'>";
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
$appRJ->response['result'].= "<label for='artCat_id'>artCat_id:</label>";
$appRJ->response['result'].= "<select name='artCat_id'>";
/*select options-->*/
$categList_text="select artCat_id, artCatPar_id, catName from artCat_dt ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelect.= "<option value='".$categList_row['artCat_id']."' ";
        if($categList_row['artCat_id'] == $Art_rd->result['artCat_id']){
            $findSelected=true;
            $catSelect.= " selected";
        }
        $catSelect.= ">".$categList_row['catName']."</option>";
    }
    if($findSelected){
        $catSelect="<option value='none' selected>---</option>".$catSelect;
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
$appRJ->response['result'].= "<label>pubDate:</label>";
$appRJ->response['result'].= "<input type='date' name='pubDate' value='".$Art_rd->result['pubDate']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label>refreshDate:</label>";
$appRJ->response['result'].= "<input type='date' name='refreshDate' value='".$Art_rd->result['refreshDate']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($artErr['dateErr'])){
    $appRJ->response['result'].= $artErr['dateErr'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Art_rd->result['activeFlag']){
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