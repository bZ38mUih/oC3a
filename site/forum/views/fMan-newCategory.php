<?php
$h1 ="Создание категории";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Создание категории меню на форуме'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Создание категории</title>".
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
$appRJ->response['result'].= "<form class='newCateg' method='post'>".
    "<input type='hidden' name='flagField' value='newCat'>".
    "<div class='input-line'><label>Название:</label>".
    "<input type='text' name='mName' id='targetName' ";
if($Cat_rd['result']['mName']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['mName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($catErr['mName'])){
    $appRJ->response['result'].= $catErr['mName'];
}
$appRJ->response['result'].= "</div></div><div class='input-line'><label>Alias:</label>".
    "<input type='text' name='mAlias' id='targetAlias' ";
if($Cat_rd['result']['mAlias']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['mAlias']."'";
}
$appRJ->response['result'].= "><input type='button' onclick='mkAlias()' value='mkCatAlias'><div class='field-err'>";
if(isset($catErr['mAlias'])){
    $appRJ->response['result'].= $catErr['mAlias'];
}
$appRJ->response['result'].= "</div></div><div class='input-line'><label>Описание:</label>".
    "<input type='text' name='mDescr'><div class='field-err'>";
if(isset($catErr['mDescr'])){
    $appRJ->response['result'].= $catErr['mDescr'];
}
$appRJ->response['result'].= "</div></div><div class='input-line'><label>fm_pid:</label>".
    "<select name='fm_pid'>";
/*select options-->*/
$categList_text="select fm_id, fm_pid, mName from forumMenu_dt ORDER BY mName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelect.= "<option value='".$categList_row['fm_id']."' ";
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
$appRJ->response['result'].= $catSelect."</select></div><div class='input-line'>".
    "<label>Показывать:</label><input type='checkbox' name='mActive' ";
if($Cat_rd['result']['mActive']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'>".
    "<label>Индексировать:</label><input type='checkbox' name='robIndex' ";
if($Cat_rd['result']['robIndex']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='addNew'></div></form>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";