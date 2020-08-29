<?php
$h1 ="Создание статьи";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Создание альбома в галерее'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Создание статьи</title>".
    "<link rel='SHORTCUT ICON' href='/site/artMan/img/favicon.png' type='image/png'>".
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/artMan/views/artMan-subMenu.php");
$appRJ->response['result'].= "<form method='post'>".
    "<input type='hidden' name='flagField' value='newArt'>".
    "<div class='input-line'>".
    "<label for='artName'>Название:</label>".
    "<input type='text' name='artName' id='targetName' ";
if($Art_rd['result']['artName']){
    $appRJ->response['result'].= "value='".$Art_rd['result']['artName']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($artErr['artName'])){
    $appRJ->response['result'].= $artErr['artName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='artAlias'>Alias:</label>".
    "<input type='text' name='artAlias' id='targetAlias' ";
if($Art_rd['result']['artAlias']){
    $appRJ->response['result'].= "value='".$Art_rd['result']['artAlias']."'";
}
$appRJ->response['result'].= "><input type='button' onclick='mkAlias()' value='mkArtAlias'>".
    "<div class='field-err'>";
if(isset($artErr['artAlias'])){
    $appRJ->response['result'].= $artErr['artAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Мета:</label>".
    "<textarea name='artMeta' rows='3' >";
if($Art_rd['result']['artMeta']){
    $appRJ->response['result'].= $Art_rd['result']['artMeta'];
}
$appRJ->response['result'].= "</textarea>".
    "<div class='field-err'>";
if(isset($artErr['artMeta'])){
    $appRJ->response['result'].= $artErr['artMeta'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>artCat_id:</label>".
    "<select name='artCat_id'>";
/*select options-->*/
$categList_text="select artCat_id, artCatPar_id, catName from artCat_dt ORDER BY catName ";
$categList_res=$DB->query($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelect.= "<option value='".$categList_row['artCat_id']."' ";
        if($categList_row['artCat_id'] == $Art_rd['result']['art_id']){
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
$appRJ->response['result'].= $catSelect;
$appRJ->response['result'].= "</select>".
    "</div>".
    "<div class='input-line'><label>Показывать:</label>".
    "<input type='checkbox' name='activeFlag' ";
if($Art_rd['result']['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>";
$appRJ->response['result'].= "<div class='input-line'><label>Комментировать:</label>".
    "<input type='checkbox' name='allowCm' ";
if($Art_rd['result']['allowCm']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='addNew'></div>".
    "</form>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";