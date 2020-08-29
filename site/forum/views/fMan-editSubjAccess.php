<?php
$h1 ="Доступы к теме";
$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Редактирование доступов к теме' http-equiv='Content-Type' charset='charset=utf-8'>";
//$appRJ->response['result'].= "<meta name='yandex-verification' content='02913709ba09b678' />";
$appRJ->response['result'].= "<title>Доступы к теме</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/downloads/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>";
//$appRJ->response['result'].= "<link rel='stylesheet' href='/site/forum/css/editSubjDescrForm.css' type='text/css' media='screen, projection'/>";
//$appRJ->response['result'].= "<link rel='stylesheet' href='/site/forum/css/subjEditMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script type='text/javascript' src='/site/js/manForm.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>";
$appRJ->response['result'].= "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "<script src='/source/js/tinymce/tinymce.min.js'></script>";
$appRJ->response['result'].= "<script src='/site/forum/js/main.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/forum/views/fMan-subjContentMenu.php");

$appRJ->response['result'].= "<form class='editSubjDescr' method='post'>";
if(isset($subjErr['common']) and $subjErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($subjErr['common']) and $subjErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editSubjDescr'>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='readRule'>Просмотр темы:</label>";
$appRJ->response['result'].= "<select name='readRule'>";
$appRJ->response['result'].= "<option value='off' ";
if($Subj_rd['result']['readRule']=='off'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">off</option>";
$appRJ->response['result'].= "<option value='all' ";
if($Subj_rd['result']['readRule']=='all'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">all</option>";
$appRJ->response['result'].= "<option value='users' ";
if($Subj_rd['result']['readRule']=='users'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">users</option>";


$groups_text = "select * from usersGroups_dt WHERE activeFlag is true ORDER BY group_id ";

$groups_res = $DB->doQuery($groups_text);
$writeRule=null;
if(mysql_num_rows($groups_res)>0){
    while ($groups_row=$DB->doFetchRow($groups_res)){
        $appRJ->response['result'].= "<option value='".$groups_row['group_id']."' ";
        if($Subj_rd['result']['readRule'] == $groups_row['group_id']){
            $appRJ->response['result'].= "selected";
        }
        $appRJ->response['result'].= ">".$groups_row['groupAlias']."</option>";

        $writeRule.= "<option value='".$groups_row['group_id']."' ";
        if($Subj_rd['result']['writeRule'] == $groups_row['group_id']){
            $appRJ->response['result'].= "selected";
        }
        $writeRule.= ">".$groups_row['groupAlias']."</option>";
    }
}

$appRJ->response['result'].= "</select>";
//$appRJ->response['result'].= "<input type='text' name='subj_id' value='".$Subj_rd['result']['subject_id']."' disabled>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'>";
$appRJ->response['result'].= "<label for='writeRule'>Написание комментов:</label>";
$appRJ->response['result'].= "<select name='writeRule'>";
$appRJ->response['result'].= "<option value='off' ";
if($Subj_rd['result']['readRule']=='off'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">off</option>";
$appRJ->response['result'].= "<option value='users' ";
if($Subj_rd['result']['readRule']=='users'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">users</option>";
$appRJ->response['result'].= $writeRule;
$appRJ->response['result'].= "</select>";
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