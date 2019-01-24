<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Управление сайтом'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Tables</title>".
    "<link rel='SHORTCUT ICON' href='/admin/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/admin/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/admin/adminHeader/css/adminHeader.css' type='text/css' media='screen, projection'/>".
    "<script src='/admin/adminHeader/js/adminHeader.js'></script>".
    "<link rel='stylesheet' href='/admin/tables/css/tables.css' type='text/css' media='screen, projection'/>".
    "<script type='text/javascript' id='menu_script' src='/admin/tables/js/tables.js'></script>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminHeader/views/adminHeader.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='optionsPanel'><div class='uploadOptions'>".
    "<label for='prefixTag'>pefix</label><input type='text' name='prefixTag'>".
    "<label for='dateTag'>dateTag</label>".
    "<input type='checkbox' name='dateTag' checked>".
    "</div>".
    "<div class='btnPanel'>".
    "<input type='button' class='uploadAll' value='upLoadAll' onclick='upLoadAll()'>".
    "<input type='button' class='refresh' value='refresh' onclick='refreshTables()'>".
    "<input type='button' class='showLog' value='Log' onclick='showLog()'>".
    "</div></div>".
    "</div></div></div>".
    "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
    "<div class='tablesList'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/tables/views/tablesView.php");
$appRJ->response['result'].= $tables->result['log'];
$appRJ->response['result'].= "</div></div></div></div>".
    "<div class='modal'><div class='overlay'></div><div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='modal-right'><img src='/source/img/closeModal.png' title='закрыть'></div>".
    "<div class='logPanel'><h3>action log:</h3></div>".
    "</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/adminFooter/views/footerDefault.php");
$appRJ->response['result'].= "</body></html>";
