<?php
$h1 ="Редактирование темы";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование темы'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Редактирование темы</title>".
    "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subjContentMenu.php");
$appRJ->response['result'].= "<form class='editImg'><div class='img-frame'>";
$delImgBtn_text=null;
if($Subj_rd['result']['sImg']){
    $appRJ->response['result'].= "<img src='".F_SUBJ_IMG.$_GET['fs_id']."/preview/".$Subj_rd['result']['sImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'><div class='delImg-line'>".
    "<span onclick='delImg(".$_GET['fs_id'].", ".'"'."delSubjImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
    "<input type='file' onchange='loadFiles(".$_GET['fs_id'].", ".'"'."forumS_id".'"'.
    ")' accept='image/jpeg,image/png,image/gif'></div>".
    "<div class='results'></div></div></form>".
    "<form method='post'>";
if(isset($subjErr['common']) and $subjErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($subjErr['common']) and $subjErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editSubj'>".
    "<div class='input-line'><label for='fs_id'>fs_id:</label>".
    "<input type='text' name='fs_id' value='".$Subj_rd['result']['fs_id']."' disabled></div>".
    "<div class='input-line'><label>Название:</label>".
    "<input type='text' name='sName' id='targetName' ";
if($Subj_rd['result']['sName']){
    $appRJ->response['result'].= "value='".$Subj_rd['result']['sName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($subjErr['sName'])){
    $appRJ->response['result'].= $subjErr['sName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Alias:</label>".
    "<input type='text' name='sAlias' id='targetAlias' ";
if($Subj_rd['result']['sAlias']){
    $appRJ->response['result'].= "value='".$Subj_rd['result']['sAlias']."'";
}
$appRJ->response['result'].= ">".
    "<input type='button' onclick='mkAlias()' value='mkAlbAlias'><div class='field-err'>";
if(isset($subjErr['sAlias'])){
    $appRJ->response['result'].= $subjErr['sAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Мета:</label><textarea name='metaDescr' rows='3' >";
if($Subj_rd['result']['metaDescr']){
    $appRJ->response['result'].= $Subj_rd['result']['metaDescr'];
}
$appRJ->response['result'].= "</textarea></div>".
    "<div class='input-line'><label>fm_id:</label><select name='fm_id'>";
/*select options-->*/
$categList_text="select fm_id, mName from forumMenu_dt".
    " ORDER BY mName ";
$categList_res=$DB->query($categList_text);
if($categList_res->rowCount() > 0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelectOptions.= "<option value='".$categList_row['fm_id']."' ";
        if($categList_row['fm_id'] == $Subj_rd['result']['fm_id']){
            $findSelected=true;
            $catSelectOptions.= " selected";
        }
        $catSelectOptions.= ">".$categList_row['mName']."</option>";
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
$appRJ->response['result'].= $catSelectOptions."</select></div>".
    "<div class='input-line'><label for='dateOfCr'>dateOfCr:</label>".
    "<input type='date' name='dateOfCr' value='".substr($Subj_rd['result']['dateOfCr'], 0, 10)."'>".
    "<div class='field-err'>";
if(isset($subjErr['dateOfCr'])){
    $appRJ->response['result'].= $subjErr['dateOfCr'];
}
$appRJ->response['result'].= "</div></div>";
    $appRJ->response['result'].="<div class='input-line'><label for='activeFlag'>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Subj_rd['result']['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><label>Индексировать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='robIndex' ";
if($Subj_rd['result']['robIndex']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='save'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";