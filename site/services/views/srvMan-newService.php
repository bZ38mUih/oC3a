<?php
$h1 ="Создание услуги";
if(!$Card_rd['result']['cardCurr']){
    $Card_rd['result']['cardCurr']=643;
}
if(!$Card_rd['result']['cardPrice']){
    $Card_rd['result']['cardPrice']=1000;
}
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Создание услуги'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление услугами</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'>".
    "<div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subMenu.php");
$appRJ->response['result'].= "<form class='newFile' method='post'>".
    "<input type='hidden' name='flagField' value='newCard'>".
    "<div class='input-line'>".
    "<label>Название:</label>".
    "<input type='text' name='cardName' id='targetName' ";
if($Card_rd['result']['cardName']){
    $appRJ->response['result'].= "value='".$Card_rd['result']['cardName']."'";
}
$appRJ->response['result'].= ">".
    "<div class='field-err'>";
if(isset($cardErr['cardName'])){
    $appRJ->response['result'].= $cardErr['cardName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'>".
    "<label>Alias:</label>".
    "<input type='text' name='cardAlias' id='targetAlias' ";
if($Card_rd['result']['cardAlias']){
    $appRJ->response['result'].= "value='".$Card_rd['result']['cardAlias']."'";
}
$appRJ->response['result'].= ">".
    "<input type='button' onclick='mkAlias()' value='mkAlias'>".
    "<div class='field-err'>";
if(isset($cardErr['cardAlias'])){
    $appRJ->response['result'].= $cardErr['cardAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'>".
    "<label>Кр. описание:</label>".
    "<textarea name='shortDescr'>";
if($Card_rd['result']['shortDescr']){
    $appRJ->response['result'].= $Card_rd['result']['shortDescr'];
}
$appRJ->response['result'].= "</textarea>".
    "</div>".
    "<div class='input-line'>".
    "<label>Категория:</label>".
    "<select name='srvCat_id'>";
/*select options-->*/
$categList_text="select srvCat_id, srvCatPar_id, catName from srvCat_dt ORDER BY catName ";
$categList_res=$DB->query($categList_text);
if($categList_res->rowCount() > 0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelect.= "<option value='".$categList_row['srvCat_id']."' ";
        if($categList_row['srvCat_id'] == $Card_rd['result']['srvCat_id']){
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
    "<div class='input-line'><label>Расценка:</label>".
    "<input type='number' name='cardPrice' min='1000' max='99999' ";
if($Card_rd['result']['cardPrice']){
    $appRJ->response['result'].="value='".$Card_rd['result']['cardPrice']."'";;
}
$appRJ->response['result'].=">".
    "<div class='field-err'>";
if(isset($cardErr['cardPrice'])){
    $appRJ->response['result'].= $cardErr['cardPrice'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Валюта:</label>".
    "<input type='number' name='cardCurr' min='1' max='1000' ";
if($Card_rd['result']['cardCurr']){
    $appRJ->response['result'].="value='".$Card_rd['result']['cardCurr']."'";;
}
$appRJ->response['result'].=">".
    "<div class='field-err'>";
if(isset($cardErr['cardCurr'])){
    $appRJ->response['result'].= $cardErr['cardCurr'];
}
$appRJ->response['result'].= "</div></div>".
"<div class='input-line'><label>Показывать:</label>".
    "<input type='checkbox' name='cardActive' ";
if($Card_rd['result']['cardActive']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div><div class='input-line'><input type='submit' value='addNew'></div>".
    "</form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";