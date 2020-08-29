<?php
$h1 ="Создание альбома";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Создание альбома в галерее'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление галереей</title>".
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-subMenu.php");
$appRJ->response['result'].= "<form method='post'><input type='hidden' name='flagField' value='newAlbum'>".
    "<div class='input-line'><label for='albumName'>Название:</label>".
    "<input type='text' name='albumName' id='targetName' ";
if($Alb_rd['result']['albumName']){
    $appRJ->response['result'].= "value='".$Alb_rd['result']['albumName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($albErr['albumName'])){
    $appRJ->response['result'].= $albErr['albumName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='albumAlias'>Alias:</label>".
    "<input type='text' name='albumAlias' id='targetAlias' ";
if($Alb_rd['result']['albumAlias']){
    $appRJ->response['result'].= "value='".$Alb_rd['result']['albumAlias']."'";
}
$appRJ->response['result'].= "><input type='button' onclick='mkAlias()' value='mkAlbAlias'><div class='field-err'>";
if(isset($albErr['albumAlias'])){
    $appRJ->response['result'].= $albErr['albumAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='metaDescr'>Мета:</label><textarea name='metaDescr' rows='3' >";
if($Alb_rd['result']['metaDescr']){
    $appRJ->response['result'].= $Alb_rd['result']['metaDescr'];
}
$appRJ->response['result'].= "</textarea></div>".
    "<div class='input-line'><label for='glCat_id'>glCat_id:</label><select name='glCat_id'>";
/*select options-->*/
$categList_text="select glCat_id, glCat_parId, catName from galleryMenu_dt ORDER BY catName ";
$categList_res = $DB->query($categList_text);
if($categList_res->rowCount() > 0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelect.= "<option value='".$categList_row['glCat_id']."' ";
        if($categList_row['glCat_id'] == $Alb_rd['result']['glCat_id']){
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
$appRJ->response['result'].= $catSelect."</select></div>".
    "<div class='input-line'><label for='activeFlag'>Показывать:</label>".
    "<input type='checkbox' name='activeFlag' ";
if($Alb_rd['result']['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='addNew'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";