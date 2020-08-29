<?php
$h1 ="Редактирование услуги";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Редактирование услуги'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление услугами</title>".
    "<link rel='SHORTCUT ICON' href='/site/services/img/favicon.png' type='image/png'>".
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
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-subContentMenu.php");
$appRJ->response['result'].= "<form class='editImg'><div class='img-frame'>";
$delImgBtn_text=null;
if($Card_rd['result']['cardImg']){
    $appRJ->response['result'].= "<img src='".SRV_CARD_IMG_PAPH.$_GET['card_id'].
        "/preview/".$Card_rd['result']['cardImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div><div class='control-frame'><div class='delImg-line'>".
    "<span onclick='delImg(".$_GET['card_id'].", ".'"'."delCardImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
    "<input type='file' onchange='loadFiles(".$_GET['card_id'].", ".'"'."card_id".'"'.
    ")' accept='image/jpeg,image/png,image/gif'></div>".
    "<div class='results'></div></div></form>".
    "<form method='post'>";
if(isset($cardErr['common']) and $cardErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($cardErr['common']) and $cardErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editCard'>".
    "<div class='input-line'><label>card_id:</label>".
    "<input type='text' name='card_id' value='".$Card_rd['result']['card_id']."' disabled></div>".
    "<div class='input-line'><label>Название:</label>".
    "<input type='text' name='cardName' id='targetName' ";
if($Card_rd['result']['cardName']){
    $appRJ->response['result'].= "value='".$Card_rd['result']['cardName']."'";
}
$appRJ->response['result'].= "><div class='field-err'>";
if(isset($cardErr['cardName'])){
    $appRJ->response['result'].= $cardErr['cardName'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Alias:</label>".
    "<input type='text' name='cardAlias' id='targetAlias' ";
if($Card_rd['result']['cardAlias']){
    $appRJ->response['result'].= "value='".$Card_rd['result']['cardAlias']."'";
}
$appRJ->response['result'].= ">".
    "<input type='button' onclick='mkAlias()' value='mkCardAlias'><div class='field-err'>";
if(isset($cardErr['cardAlias'])){
    $appRJ->response['result'].= $cardErr['cardAlias'];
}
$appRJ->response['result'].= "</div></div>".
    "<div class='input-line'><label>Кр. описание:</label><textarea name='shortDescr' rows='3' >";
if($Card_rd['result']['shortDescr']){
    $appRJ->response['result'].= $Card_rd['result']['shortDescr'];
}
$appRJ->response['result'].= "</textarea></div>".
    "<div class='input-line'><label>Категория:</label><select name='srvCat_id'>";
/*select options-->*/
$categList_text="select srvCat_id, catName from srvCat_dt".
    " ORDER BY catName ";
$categList_res=$DB->query($categList_text);
if($categList_res->rowCount() > 0){
    $findSelected=false;
    while ($categList_row = $categList_res->fetch(PDO::FETCH_ASSOC)){
        $catSelectOptions.= "<option value='".$categList_row['srvCat_id']."' ";
        if($categList_row['srvCat_id'] == $Card_rd['result']['srvCat_id']){
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
    "<div class='input-line'><label>Расценка:</label>".
    "<input type='number' name='cardPrice' min='50' max='99999' ";
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



    "<div class='input-line'><label>sortDate:</label>".
    "<input type='date' name='sortDate' value='".substr($Card_rd['result']['sortDate'], 0, 10)."'>".
    "<div class='field-err'>";
if(isset($cardErr['sortDate'])){
    $appRJ->response['result'].= $cardErr['sortDate'];
}
$appRJ->response['result'].= "</div></div>".
    /*"<div class='input-line'><label for='transAlbImg'>transAlbImg:</label>".
    "<input type='number' name='transAlbImg' min='-180' max='180' value='".$Alb_rd['result']['transAlbImg']."'></div>".*/
    "<div class='input-line'><label>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='cardActive' ";
if($Card_rd['result']['cardActive']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "></div>".
    "<div class='input-line'><input type='submit' value='save'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";