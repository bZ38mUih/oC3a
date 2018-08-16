<?php
$h1 ="Доступы к альбому";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Редактирование доступов к альбому' ".
    "http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Управление галереей</title>".
    "<link rel='SHORTCUT ICON' href='/site/gallery/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/contentMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' src='/site/js/manForm.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-subMenu.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-subContentMenu.php");
$appRJ->response['result'].= "<form method='post'>";
if(isset($albErr['common']) and $albErr['common']===true){
    $appRJ->response['result'].= "<div class='results success'>Updated SUCCESS</div>";
}if(isset($albErr['common']) and $albErr['common']===false){
    $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
}
$appRJ->response['result'].= "<input type='hidden' name='flagField' value='editAlbumAccess'>".
    "<div class='input-line'><label for='readRule'>Просмотр альбома:</label><select name='readRule'>".
    "<option value='off' ";
if($Alb_rd->result['readRule']=='off'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">off</option>";
$appRJ->response['result'].= "<option value='all' ";
if($Alb_rd->result['readRule']=='all'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">all</option><option value='users' ";
if($Alb_rd->result['readRule']=='users'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">users</option>";
$groups_text = "select * from usersGroups_dt WHERE activeFlag is true ORDER BY group_id ";
$groups_res = $DB->doQuery($groups_text);
$writeRule=null;
if(mysql_num_rows($groups_res)>0){
    while ($groups_row=$DB->doFetchRow($groups_res)){
        $appRJ->response['result'].= "<option value='".$groups_row['group_id']."' ";
        if($Alb_rd->result['readRule'] == $groups_row['group_id']){
            $appRJ->response['result'].= "selected";
        }
        $appRJ->response['result'].= ">".$groups_row['groupAlias']."</option>";

        $writeRule.= "<option value='".$groups_row['group_id']."' ";
        if($Alb_rd->result['writeRule'] == $groups_row['group_id']){
            $writeRule.= "selected";
        }
        $writeRule.= ">".$groups_row['groupAlias']."</option>";
    }
}
$appRJ->response['result'].= "</select></div>".
    "<div class='input-line'><label for='writeRule'>Лайки и комменты:</label><select name='writeRule'>".
    "<option value='off' ";
if($Alb_rd->result['writeRule']=='off'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">off</option><option value='users' ";
if($Alb_rd->result['writeRule']=='users'){
    $appRJ->response['result'].= "selected";
}
$appRJ->response['result'].= ">users</option>".$writeRule."</select></div>".
    "<div class='input-line'><input type='submit' value='save'></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";