<?php
$h1 ="Категория форума";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Категория форума' http-equiv='Content-Type'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Категория форума</title>".
    "<link rel='SHORTCUT ICON' href='/site/forum/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subMenu.php");
$appRJ->response['result'].= "<form class='editImg'><div class='img-frame'>";
$delImgBtn_text=null;
if($Cat_rd['result']['mImg']){
    $appRJ->response['result'].= "<img src='".F_CAT_IMG.$_GET['fm_id']."/preview/".$Cat_rd['result']['mImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>".
    "<div class='control-frame'><div class='delImg-line'>".
    "<span onclick='delImg(".$_GET['fm_id'].", ".'"'."delCatImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div>".
    "<div class='button-line'><input type='file' onchange='loadFiles(".$_GET['fm_id'].", ".'"'."fm_id".
    '"'.")' accept='image/jpeg,image/png,image/gif'></div>".
    "<div class='err-line'></div></div></form>".
    "<form method='post'>";
if(isset($catErr['common']) and $catErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($catErr['common']) and $catErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
    print_r($catErr);
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editCat'>".
    "<div class='input-line'><label>fm_id:</label>".
    "<input type='text' name='fm_id' value='".$Cat_rd['result']['fm_id']."' disabled></div>".
    "<div class='input-line'><label>Название:</label>".
    "<input type='text' name='mName' id='targetName' ";
if($Cat_rd['result']['mName']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['mName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($catErr['mName'])){
    $appRJ->response['result'].= $catErr['mName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Alias:</label>".
    "<input type='text' name='mAlias' id='targetAlias' ";
if($Cat_rd['result']['mAlias']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['mAlias']."'";
}
$appRJ->response['result'].= "><input type='button' onclick='mkAlias()' value='mkCatAlias'>".
    "<div class='field-err'>";
if(isset($catErr['mAlias'])){
    $appRJ->response['result'].= $catErr['mAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Описание:</label>".
    "<input type='text' name='mDescr' ";
if($Cat_rd['result']['mDescr']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['mDescr']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($catErr['mDescr'])){
    $appRJ->response['result'].= $catErr['mDescr'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>fm_pid:</label><select name='fm_pid'>";
/*select options-->*/
$categList_text="select fm_id, fm_pid, mName from forumMenu_dt WHERE fm_id<>".$Cat_rd['result']['fm_id'].
    " ORDER BY mName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelectOptions.= "<option value='".$categList_row['fm_id']."' ";
        if($categList_row['fm_id'] == $Cat_rd['result']['fm_pid']){
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
    "<div class='input-line'><label>Показывать:</label><input type='checkbox' name='mActive' ";
if($Cat_rd['result']['mActive']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><label>Индексировать:</label><input type='checkbox' name='robIndex' ";
if($Cat_rd['result']['robIndex']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='save'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body></html>";