<?php
$h1 ="Редактирование альбома";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Редактирование альбома' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Управление галереей</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>";
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-subContentMenu.php");
$appRJ->response['result'].= "<form class='editImg'>";
$appRJ->response['result'].= "<div class='img-frame'>";
$delImgBtn_text=null;
if($Alb_rd->result['albumImg']){
    $appRJ->response['result'].= "<img src='".GL_ALBUM_IMG_PAPH.$_GET['alb_id']."/preview/".$Alb_rd->result['albumImg']."' ";
    if($Alb_rd->result['transAlbImg']){
        $appRJ->response['result'].="style='transform: rotate(".$Alb_rd->result['transAlbImg']."deg)' ";
    }
    $appRJ->response['result'].=">";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='control-frame'>";
$appRJ->response['result'].= "<div class='delImg-line'>";
$appRJ->response['result'].= "<span onclick='delImg(".$_GET['alb_id'].", ".'"'."delAlbImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='button-line'>";
$appRJ->response['result'].= "<input type='file' onchange='loadFiles(".$_GET['alb_id'].", ".'"'."alb_id".'"'.")' accept='image/jpeg,image/png,image/gif'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='results'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "<form method='post'>";
if(isset($albErr['common']) and $albErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($albErr['common']) and $albErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editAlbum'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='album_id'>album_id:</label>";
$appRJ->response['result'].= "<input type='text' name='album_id' value='".$Alb_rd->result['album_id']."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='albumName'>Название:</label>";
$appRJ->response['result'].= "<input type='text' name='albumName' id='targetName' ";
if($Alb_rd->result['albumName']){
    $appRJ->response['result'].= "value='".$Alb_rd->result['albumName']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($albErr['albumName'])){
    $appRJ->response['result'].= $albErr['albumName'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='albumAlias'>Alias:</label>";
$appRJ->response['result'].= "<input type='text' name='albumAlias' id='targetAlias' ";
if($Alb_rd->result['albumAlias']){
    $appRJ->response['result'].= "value='".$Alb_rd->result['albumAlias']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<input type='button' onclick='mkAlias()' value='mkAlbAlias'>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($albErr['albumAlias'])){
    $appRJ->response['result'].= $albErr['albumAlias'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='metaDescr'>Мета:</label>";
$appRJ->response['result'].= "<textarea name='metaDescr' rows='3' >";
if($Alb_rd->result['metaDescr']){
    $appRJ->response['result'].= $Alb_rd->result['metaDescr'];
}
$appRJ->response['result'].= "</textarea>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='glCat_id'>glCat_id:</label>";

$appRJ->response['result'].= "<select name='glCat_id'>";

/*select options-->*/
$categList_text="select glCat_id, catName from galleryMenu_dt".
    " ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelectOptions.= "<option value='".$categList_row['glCat_id']."' ";
        if($categList_row['glCat_id'] == $Alb_rd->result['glCat_id']){
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
    $catSelect="<option value='none' selected>---</option>";
}
/*<--select options*/
$appRJ->response['result'].= $catSelectOptions;
$appRJ->response['result'].= "</select>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='dateOfCr'>dateOfCr:</label>";
$appRJ->response['result'].= "<input type='date' name='dateOfCr' value='".substr($Alb_rd->result['dateOfCr'], 0, 10)."'>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($albErr['dateOfCr'])){
    $appRJ->response['result'].= $albErr['dateOfCr'];
}
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='transAlbImg'>transAlbImg:</label>";
$appRJ->response['result'].= "<input type='number' name='transAlbImg' min='-180' max='180' value='".$Alb_rd->result['transAlbImg']."'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='activeFlag'>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Alb_rd->result['activeFlag']){
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