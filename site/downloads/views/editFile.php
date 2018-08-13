<?php

$h1 ="Правка файла";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Правка файла загрузок' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Управление загрузками</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/downloads/css/filesRef.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";


$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/dwlMan-subMenu.php");
$appRJ->response['result'].= "<form class='editImg'>";
$appRJ->response['result'].= "<div class='img-frame'>";
$delImgBtn_text=null;
if($File_rd->result['fileImg']){
    $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$_GET['file_id']."/preview/".$File_rd->result['fileImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='control-frame'>";
$appRJ->response['result'].= "<div class='delImg-line'>";
$appRJ->response['result'].= "<span onclick='delImg(".$_GET['file_id'].", ".'"'."delFileImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='button-line'>";
$appRJ->response['result'].= "<input type='file' onchange='loadFiles(".$_GET['file_id'].", ".'"'."file_id".'"'.")' accept='image/jpeg,image/png,image/gif'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='results'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "<form class='newFile' method='post'>";
if(isset($fileErr['common']) and $fileErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($fileErr['common']) and $fileErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editFile'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='dwlFile_id'>dwlFile_id:</label>";
$appRJ->response['result'].= "<input type='text' name='dwlFile_id' value='".$File_rd->result['dwlFile_id']."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='dwlFileName'>Название:</label>";
$appRJ->response['result'].= "<input type='text' name='dwlFileName' id='targetName' ";
if($File_rd->result['dwlFileName']){
    $appRJ->response['result'].= "value='".$File_rd->result['dwlFileName']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($fileErr['catName'])){
    $appRJ->response['result'].= $fileErr['catName'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catAlias'>Alias:</label>";
$appRJ->response['result'].= "<input type='text' name='dwlFileAliace' id='targetAlias' ";
if($File_rd->result['dwlFileAliace']){
    $appRJ->response['result'].= "value='".$File_rd->result['dwlFileAliace']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<input type='button' onclick='mkAlias()' value='mkCatAlias'>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($fileErr['catAlias'])){
    $appRJ->response['result'].= $fileErr['catAlias'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='dwlFileDescr'>Описание:</label>";
$appRJ->response['result'].= "<textarea name='dwlFileDescr' rows='5'>";
if($File_rd->result['dwlFileDescr']){
    $appRJ->response['result'].= $File_rd->result['dwlFileDescr'];
}
$appRJ->response['result'].= "</textarea>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='fileVersion'>Версия:</label>";
$appRJ->response['result'].= "<input type='text' name='fileVersion' ";
if($File_rd->result['fileVersion']){
    $appRJ->response['result'].= "value='".$File_rd->result['fileVersion']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='fileLicence'>Лицензия:</label>";
$appRJ->response['result'].= "<input type='text' name='fileLicence' ";
if($File_rd->result['fileLicence']){
    $appRJ->response['result'].= "value='".$File_rd->result['fileLicence']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='dwlCat_id'>cat_id:</label>";

$appRJ->response['result'].= "<select name='dwlCat_id'>";

/*select options-->*/
$categList_text="select dwlCat_id, dwlCatPar_id, catName from dwlCat_dt ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelect.= "<option value='".$categList_row['dwlCat_id']."' ";
        if($categList_row['dwlCat_id'] == $File_rd->result['dwlCat_id']){
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
$appRJ->response['result'].= "<label for='fileActive_flag'>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='fileActive_flag' ";
if($File_rd->result['fileActive_flag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "</div>";


$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<input type='submit' value='save'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";

$appRJ->response['result'].= "<form class='addRef'>";
$appRJ->response['result'].= "<div class='ref-list'>";
require_once($_SERVER['DOCUMENT_ROOT']."/site/downloads/views/refList.php");
$appRJ->response['result'].= '</div>';
$appRJ->response['result'].= "<div class='ref-control'>";
$appRJ->response['result'].= "<div class='ref-control-left'>";
$appRJ->response['result'].= "<div class='ref-control-left-input'>";
$appRJ->response['result'].= "<label for='refLnk'>Link:</label><input type='text' name='refLnk'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='ref-control-left-input'>";
$appRJ->response['result'].= "<label for='refTxt'>Text:</label><input type='text' name='refTxt'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='ref-control-right'>";
$appRJ->response['result'].= "<input type='button' onclick='addNewLink()'>";
$appRJ->response['result'].= "</div>";
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