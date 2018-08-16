<?php
$h1 ="Правка файла";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Правка файла загрузок' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление загрузками</title>".
    "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/downloads/css/filesRef.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/dwlMan-subMenu.php");
$appRJ->response['result'].= "<form class='editImg'><div class='img-frame'>";
$delImgBtn_text=null;
if($File_rd->result['fileImg']){
    $appRJ->response['result'].= "<img src='".DWL_FILES_IMG_PAPH.$_GET['file_id']."/preview/".$File_rd->result['fileImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'><div class='delImg-line'>".
    "<span onclick='delImg(".$_GET['file_id'].", ".'"'."delFileImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
    "<input type='file' onchange='loadFiles(".$_GET['file_id'].", ".'"'."file_id".'"'.
    ")' accept='image/jpeg,image/png,image/gif'></div><div class='results'></div></div></form>".
    "<form class='newFile' method='post'>";
if(isset($fileErr['common']) and $fileErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($fileErr['common']) and $fileErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editFile'>".
    "<div class='input-line'><label for='dwlFile_id'>dwlFile_id:</label>".
    "<input type='text' name='dwlFile_id' value='".$File_rd->result['dwlFile_id']."' disabled></div>".
    "<div class='input-line'><label for='dwlFileName'>Название:</label>".
    "<input type='text' name='dwlFileName' id='targetName' ";
if($File_rd->result['dwlFileName']){
    $appRJ->response['result'].= "value='".$File_rd->result['dwlFileName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($fileErr['catName'])){
    $appRJ->response['result'].= $fileErr['catName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='catAlias'>Alias:</label>".
    "<input type='text' name='dwlFileAliace' id='targetAlias' ";
if($File_rd->result['dwlFileAliace']){
    $appRJ->response['result'].= "value='".$File_rd->result['dwlFileAliace']."'";
}
$appRJ->response['result'].= "><input type='button' onclick='mkAlias()' value='mkCatAlias'>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($fileErr['catAlias'])){
    $appRJ->response['result'].= $fileErr['catAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='dwlFileDescr'>Описание:</label>".
    "<textarea name='dwlFileDescr' rows='5'>";
if($File_rd->result['dwlFileDescr']){
    $appRJ->response['result'].= $File_rd->result['dwlFileDescr'];
}
$appRJ->response['result'].= "</textarea></div>".
    "<div class='input-line'><label for='fileVersion'>Версия:</label>".
    "<input type='text' name='fileVersion' ";
if($File_rd->result['fileVersion']){
    $appRJ->response['result'].= "value='".$File_rd->result['fileVersion']."'";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><label for='fileLicence'>Лицензия:</label>";
$appRJ->response['result'].= "<input type='text' name='fileLicence' ";
if($File_rd->result['fileLicence']){
    $appRJ->response['result'].= "value='".$File_rd->result['fileLicence']."'";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><label for='dwlCat_id'>cat_id:</label>".
    "<select name='dwlCat_id'>";
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
$appRJ->response['result'].= $catSelect."</select></div>".
    "<div class='input-line'><label for='fileActive_flag'>Показывать:</label>".
    "<input type='checkbox' name='fileActive_flag' ";
if($File_rd->result['fileActive_flag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='save'></div></form>".
    "<form class='addRef'><div class='ref-list'>";
require_once($_SERVER['DOCUMENT_ROOT']."/site/downloads/views/refList.php");
$appRJ->response['result'].= "</div>".
    "<div class='ref-control'><div class='ref-control-left'><div class='ref-control-left-input'>".
    "<label for='refLnk'>Link:</label><input type='text' name='refLnk'></div>".
    "<div class='ref-control-left-input'><label for='refTxt'>Text:</label><input type='text' name='refTxt'>".
    "</div></div>".
    "<div class='ref-control-right'><input type='button' onclick='addNewLink()'></div></div></form>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";