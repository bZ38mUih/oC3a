<?php
$h1 ="Правка темы";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Редактирование темы' http-equiv='Content-Type' charset='charset=utf-8'>";
//$appRJ->response['result'].= "<meta name='yandex-verification' content='02913709ba09b678' />";
$appRJ->response['result'].= "<title>Правка темы</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";
//$appRJ->response['result'].= "<link rel='stylesheet' href='/site/forum/css/subjEditMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subjContentMenu.php");
$appRJ->response['result'].= "<form class='editImg'>";
$appRJ->response['result'].= "<div class='img-frame'>";
$delImgBtn_text=null;
if($Subj_rd->result['subjImg']){
    $appRJ->response['result'].= "<img src='".FORUM_SUBJ_IMG_PAPH.$_GET['subj_id']."/preview/".$Subj_rd->result['subjImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='control-frame'>";
$appRJ->response['result'].= "<div class='delImg-line'>";
$appRJ->response['result'].= "<span onclick='delImg(".$_GET['subj_id'].", ".'"'."delSubjImg".'"'.")' ".$delImgBtn_text.">".
    "<img src='/source/img/drop-icon.png'>Удалить картинку</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='button-line'>";
$appRJ->response['result'].= "<input type='file' onchange='loadFiles(".$_GET['subj_id'].", ".'"'."subj_id".'"'.")' accept='image/jpeg,image/png,image/gif'>";
$appRJ->response['result'].= "</div>";
//$appRJ->response['result'].= "<div class='err-line'>";
$appRJ->response['result'].= "<div class='results'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";
$appRJ->response['result'].= "<form method='post'>";
if(isset($subjErr['common']) and $subjErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($subjErr['common']) and $subjErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editSubject'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='subj_id'>subj_id:</label>";
$appRJ->response['result'].= "<input type='text' name='subj_id' value='".$Subj_rd->result['subject_id']."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catName'>Название:</label>";
$appRJ->response['result'].= "<input type='text' name='subjName' id='targetName' ";
if($Subj_rd->result['subjName']){
    $appRJ->response['result'].= "value='".$Subj_rd->result['subjName']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($subjErr['subjName'])){
    $appRJ->response['result'].= $subjErr['subjName'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catAlias'>Alias:</label>";
$appRJ->response['result'].= "<input type='text' name='subjAlias' id='targetAlias' ";
if($Subj_rd->result['subjAlias']){
    $appRJ->response['result'].= "value='".$Subj_rd->result['subjAlias']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "<input type='button' onclick='mkAlias()' value='mkCatAlias'>";
$appRJ->response['result'].= "<div class='field-err'>";
if(isset($subjErr['subjAlias'])){
    $appRJ->response['result'].= $subjErr['subjAlias'];
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='catDescr'>Мета:</label>";
$appRJ->response['result'].= "<input type='text' name='metaDescr' ";
if($Subj_rd->result['metaDescr']){
    $appRJ->response['result'].= "value='".$Subj_rd->result['metaDescr']."'";
}
$appRJ->response['result'].= ">";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='subjCat_id'>subjCat_id:</label>";

$appRJ->response['result'].= "<select name='subjCat_id'>";

/*select options-->*/
$categList_text="select subjCat_id, catName from subjectsMenu_dt".
    " ORDER BY catName ";
$categList_res=$DB->doQuery($categList_text);
if(mysql_num_rows($categList_res)>0){
    $findSelected=false;
    while ($categList_row=$DB->doFetchRow($categList_res)){
        $catSelectOptions.= "<option value='".$categList_row['subjCat_id']."' ";
        if($categList_row['subjCat_id'] == $Subj_rd->result['subjCat_id']){
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
$appRJ->response['result'].= $catSelectOptions;
$appRJ->response['result'].= "</select>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='dateOfCr'>dateOfCr:</label>";
$appRJ->response['result'].= "<input type='date' name='dateOfCr' value='".substr($Subj_rd->result['dateOfCr'], 0, 10)."'>";
//$appRJ->response['result'].= "<input type='date' name='dateOfCr' value='2018-05-02'>";

$appRJ->response['result'].= "<div class='field-err'>";
if(isset($subjErr['dateOfCr'])){
    $appRJ->response['result'].= $subjErr['dateOfCr'];
}
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='activeFlag'>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' name='activeFlag' ";
if($Subj_rd->result['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
//$appRJ->response['result'].= "<input type='checkbox'  checked>";
$appRJ->response['result'].= "</div>";


$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<input type='submit' value='save'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</form>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";