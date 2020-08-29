<?php
//$h1.="#".$note_rd['result']['note_id'];

$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
    "<meta name='robots' content='noindex'>".
    "<title>".$h1."</title>".
    "<link rel='SHORTCUT ICON' href='/site/d/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    //"<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/diaryHeader.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/dForm.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/dFooter.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
    "<script src='/site/d/js/main.js'></script>".
    //"<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    //"<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>";
$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/diaryHeader.php");

$appRJ->response['result'].="<div class='contentBlock-frame'><div class='contentBlock-center'><div class='diary-edit'>";
$appRJ->response['result'].="<label>diary_id: <input type='text' value='".$diary_rd['result']['diary_id']."' disabled></label>";
$appRJ->response['result'].="<label>diaryType: <input type='text' value='".$diary_rd['result']['diaryType']."' disabled></label>";
$appRJ->response['result'].="<label>noteDate: <input type='date' value='".$diary_rd['result']['noteDate']."' disabled></label>";
$appRJ->response['result'].="<label>diaryHeader: <input type='text' value='".$diary_rd['result']['diaryHeader']."' disabled></label>";
/*toDo
noteDate must be date not text
*/
$appRJ->response['result'].="</div><hr>";

$appRJ->response['result'].="<div class='note-edit'>";
$appRJ->response['result'].="<form method='post'>";
$appRJ->response['result'].="<label>note_id: <input type='text' value='".$note_rd['result']['note_id']."' disabled></label>";
$appRJ->response['result'].="<label>curDate: <input type='date' name='curDate' value='".$note_rd['result']['curDate']."'></label>";
$appRJ->response['result'].="<label>noteDate: <input type='time' name='curTime' value='".$note_rd['result']['curTime']."'></label>";
$appRJ->response['result'].="<div class='pageErr'>".$pageErr."</div>";
$appRJ->response['result'].="<div class='text-container'>";
$appRJ->response['result'].="<textarea name='content'>".dec_enc("decrypt", $note_rd['result']["content"], $note_rd['result']["curDate"])."</textarea>";
$appRJ->response['result'].="<div class='submt-panel'>".
    "<div class='ref-block'>".
    "<a href='/d/".$diary_rd['result']['diaryType']."/lastNote/".$diary_rd['result']['diary_id']."'>lastNote#".
    $diary_rd['result']['diary_id']."</a>".
    "</div>".
    "<div class='btn-block'><input type='submit' value='Save'></div>".
    "</div>";
$appRJ->response['result'].="</form>";
$appRJ->response['result'].="</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dFooter.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dMenu.php");

$appRJ->response['result'].= "</body>";
$appRJ->response['result'].= "</html>";