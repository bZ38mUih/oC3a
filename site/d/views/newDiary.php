<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
"<meta name='robots' content='noindex'>".
"<title>".$h1."</title>".
"<link rel='SHORTCUT ICON' href='/site/d/img/favicon.png' type='image/png'>".
"<script src='/source/js/jquery-3.2.1.js'></script>".
"<link rel='stylesheet' href='/site/d/css/diaryHeader.css' type='text/css' media='screen, projection'/>".
"<link rel='stylesheet' href='/site/d/css/dForm.css' type='text/css' media='screen, projection'/>".
"<link rel='stylesheet' href='/site/d/css/lastNote.css' type='text/css' media='screen, projection'/>".
"<link rel='stylesheet' href='/site/d/css/dFooter.css' type='text/css' media='screen, projection'/>".
"<script src='/site/siteHeader/js/modalHeader.js'></script>".
"<script src='/source/js/tinymce/js/tinymce/tinymce.min.js'></script>".
"<script src='/site/d/js/main.js'></script>".


$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/diaryHeader.php");
$appRJ->response['result'].="<div class='contentBlock-frame'><div class='contentBlock-center'><div class='diary-edit'>".
    "<form method='post'>".
    "<label>diary_id: <input type='text' value='".$diary_rd['result']['diary_id']."' disabled></label>".
    "<label>diaryType: <select name='diaryType'>";
foreach ($dType as $key=>$val){
    $appRJ->response['result'].="<option value='".$val."' ";
    if($diary_rd['result']['diaryType']==$val){
        $appRJ->response['result'].="selected ";
    }
    $appRJ->response['result'].=">".$val."</option>";
}
$appRJ->response['result'].="</select>".
    "<label>noteDate: <input type='date' name='noteDate' value='".$diary_rd['result']['noteDate']."'></label>".
    "<label>diaryHeader: <input type='text' name='diaryHeader' value='".$diary_rd['result']['diaryHeader']."'></label>";

//$appRJ->response['result'].="<div class='pageErr'>".$pageErr."</div>";

$appRJ->response['result'].="<label>note_id: <input type='text' value='".$note_rd['result']['note_id']."' disabled></label>";
$appRJ->response['result'].="<label>curDate: <input type='date' name='curDate' value='".$note_rd['result']['curDate']."'></label>";
$appRJ->response['result'].="<label>noteDate: <input type='time' name='curTime' value='".$note_rd['result']['curTime']."'></label>";
$appRJ->response['result'].="<div class='pageErr'>".$pageErr."</div>";
$appRJ->response['result'].="<div class='text-container'>";
$appRJ->response['result'].="<textarea name='content'>".dec_enc("decrypt", $note_rd['result']["content"], $note_rd['result']["curDate"])."</textarea>";
$appRJ->response['result'].="<div class='submt-panel'>".
    "<div class='ref-block'>".
    "</div>".
    "<div class='btn-block'><input type='submit' value='Save'></div>".
    "</div>";
$appRJ->response['result'].="</div>".
    "</form>".
    "</div>".
    "<div class='note-wrap'>";
//require_once($_SERVER["DOCUMENT_ROOT"]."/site/d/views/diary-contents.php");
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dFooter.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dMenu.php");
$appRJ->response['result'].= "</body>".
    "</html>";