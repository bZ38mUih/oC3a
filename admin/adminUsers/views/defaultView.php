<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Управление сайтом' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>".$adminModules[$adminModule]['aliasMenu']."</title>".
    "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/adminHeader/js/adminHeader.js'></script>".
    "<link rel='stylesheet' href='/admin/adminUsers/css/deafult.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/adminUsers/js/default.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminHeader/views/adminHeader.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='newUsr'><div class='newUsr-line'><label for='newUsrName'>newUsrName: </label>".
    "<input type='text' name='newUsrName'></div>".
    "<div class='newUsr-line'><label for='newUsrPass'>newUsrPass: </label>".
    "<input type='text' name='newUsrPass'></div>".
    "<div class='newUsr-line'><label></label>".
    "<input type='button' value='addNewUsr' onclick='addNewUser()'></div>".
    "<div class='newUsr-err'></div></div>";
$usersList_text = null;
$appRJ->response['result'].= "<div class='usersList'>";
require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/adminUsers/views/usersList.php");
$appRJ->response['result'].= "</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");
$appRJ->response['result'].= "</body></html>";