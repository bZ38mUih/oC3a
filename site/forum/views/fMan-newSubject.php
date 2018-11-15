<?php
$h1 ="Создание темы";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Создание темы форума'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Создание темы</title>".
    "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subMenu.php");
$appRJ->response['result'].= "<form method='post'><input type='hidden' name='flagField' value='newSubject'>".
    "<div class='input-line'><label>Название:</label>".
    "<input type='text' name='sName' id='targetName' ";
if($Subj_rd->result['sName']){
    $appRJ->response['result'].= "value='".$Subj_rd->result['sName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($subjErr['sName'])){
    $appRJ->response['result'].= $subjErr['sName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Alias:</label>".
    "<input type='text' name='sAlias' id='targetAlias' ";
if($Subj_rd->result['sAlias']){
    $appRJ->response['result'].= "value='".$Subj_rd->result['sAlias']."'";
}
$appRJ->response['result'].= "><input type='button' onclick='mkAlias()' value='mkAlbAlias'><div class='field-err'>";
if(isset($subjErr['sAlias'])){
    $appRJ->response['result'].= $subjErr['sAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Мета:</label><textarea name='metaDescr' rows='3' >";
if($Subj_rd->result['metaDescr']){
    $appRJ->response['result'].= $Subj_rd->result['metaDescr'];
}
$appRJ->response['result'].= "</textarea><div class='field-err'>";
if(isset($subjErr['metaDescr'])){
    $appRJ->response['result'].= $subjErr['metaDescr'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>fm_id:</label><select name='fm_id'>";
/*select options-->*/
$categList_text="select fm_id, fm_pid, mName from forumMenu_dt ORDER BY mName";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelect.= "<option value='".$categList_row['fm_id']."' ";
        if($categList_row['fm_id'] == $Subj_rd->result['fm_id']){
            $findSelected=true;
            $catSelect.= " selected";
        }
        $catSelect.= ">".$categList_row['mName']."</option>";
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
$appRJ->response['result'].= $catSelect."</select></div>".
    "<div class='input-line'><label>Показывать:</label>".
    "<input type='checkbox' name='activeFlag' ";
if($Subj_rd->result['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><label>Индексировать:</label>".
    "<input type='checkbox' name='robIndex' ";
if($Subj_rd->result['robIndex']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='addNew'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";