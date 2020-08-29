<?php
$h1 ="Правка категории";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Создание категории загрузок'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Правка категории</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subMenu.php");
$appRJ->response['result'].= "<form class='editImg'><div class='img-frame'>";
$delImgBtn_text=null;
if($Cat_rd['result']['catImg']){
    $appRJ->response['result'].= "<img src='".SRV_CAT_IMG_PAPH.$_GET['cat_id']."/preview/".$Cat_rd['result']['catImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'><div class='delImg-line'>".
    "<span onclick='delImg(".$_GET['cat_id'].", ".'"'."delCatImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div>".
    "<div class='button-line'>".
    "<input type='file' onchange='loadFiles(".$_GET['cat_id'].", ".'"'."cat_id".'"'.
    ")' accept='image/jpeg,image/png,image/gif'></div><div class='err-line'></div></div></form>".
    "<form class='newCateg' method='post'>";
if(isset($catErr['common']) and $catErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($catErr['common']) and $catErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editCat'>".
    "<div class='input-line'><label for='cat_id'>cat_id:</label>".
    "<input type='text' name='cat_id' value='".$Cat_rd['result']['srvCat_id']."' disabled></div>".
    "<div class='input-line'><label for='catName'>Название:</label>".
    "<input type='text' name='catName' id='targetName' ";
if($Cat_rd['result']['catName']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['catName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($catErr['catName'])){
    $appRJ->response['result'].= $catErr['catName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='catAlias'>Alias:</label>".
    "<input type='text' name='catAlias' id='targetAlias' ";
if($Cat_rd['result']['catAlias']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['catAlias']."'";
}
$appRJ->response['result'].= "><input type='button' onclick='mkAlias()' value='mkCatAlias'><div class='field-err'>";
if(isset($catErr['catAlias'])){
    $appRJ->response['result'].= $catErr['catAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label for='catDescr'>Описание:</label>".
    "<input type='text' name='catDescr' ";
if($Cat_rd['result']['catDescr']){
    $appRJ->response['result'].= "value='".$Cat_rd['result']['catDescr']."'";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><label>srvCatPar_id:</label><select name='srvCatPar_id'>";
/*select options-->*/
$categList_text="select srvCat_id, srvCatPar_id, catName from srvCat_dt WHERE srvCat_id<>".$Cat_rd['result']['srvCat_id'].
    " ORDER BY catName ";
$categList_res=$DB->query($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelectOptions.= "<option value='".$categList_row['srvCat_id']."' ";
        if($categList_row['srvCat_id'] == $Cat_rd['result']['srvCatPar_id']){
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
$appRJ->response['result'].= $catSelectOptions."</select></div>".
    "<div class='input-line'><label>Показывать:</label>".
    "<input type='checkbox' name='catActive' ";
if($Cat_rd['result']['catActive']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='save'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";