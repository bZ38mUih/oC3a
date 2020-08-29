<?php
$h1 ="Создание категории";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Создание категории загрузок' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Создание категории</title>".
    "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>".
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/downloads/views/dwlMan-subMenu.php");
$appRJ->response['result'].= "<form class='newCateg' method='post'>".
    "<input type='hidden' name='flagField' value='newCat'>".
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
    "<div class='input-line'><label for='catDescr'>Описание:</label><input type='text' name='catDescr'></div>".
    "<div class='input-line'><label for='dwlCatPar_id'>dwlCatPar_id:</label><select name='dwlCatPar_id'>";
/*select options-->*/
$categList_text="select dwlCat_id, dwlCatPar_id, catName from dwlCat_dt ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelect.= "<option value='".$categList_row['dwlCat_id']."' ";
        if($categList_row['dwlCat_id'] == $Cat_rd['result']['dwlCatPar_id']){
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
    "<div class='input-line'><label for='dwlCat_active'>Показывать:</label>".
    "<input type='checkbox' name='dwlCat_active' ";
if($Cat_rd['result']['catActive_flag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='addNew'></div></form>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";