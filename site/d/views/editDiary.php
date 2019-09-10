<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
    "<meta name='robots' content='noindex'>".
    "<title>".$h1."</title>".
    "<link rel='SHORTCUT ICON' href='/site/d/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>". //????
    "<link rel='stylesheet' href='/site/d/css/diaryHeader.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/dForm.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/lastNote.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/dFooter.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/diaryHeader.php");
$appRJ->response['result'].="<div class='diary-edit'>".
    "<form method='post'>".
    "<label>diary_id: <input type='text' value='".$diary_rd->result['diary_id']."' disabled></label>".
    //"<label>diaryType: <input type='date' value='".$diary_rd->result['diaryType']."'></label>".
    "<label>diaryType: <select name='diaryType'>";
foreach ($dType as $key=>$val){
    $appRJ->response['result'].="<option value='".$val."' ";
    if($diary_rd->result['diaryType']==$val){
        $appRJ->response['result'].="selected ";
    }
    $appRJ->response['result'].=">".$val."</option>";
}

$appRJ->response['result'].="</select>".
    "<label>noteDate: <input type='date' name='noteDate' value='".$diary_rd->result['noteDate']."'></label>".
    "<label>diaryHeader: <input type='text' name='diaryHeader' value='".$diary_rd->result['diaryHeader']."'></label>";
$appRJ->response['result'].="<div class='submt-panel'>".
    "<div class='ref-block'>".
    "<a href='/d/".$diary_rd->result['diaryType']."/lastNote/".$diary_rd->result['diary_id']."'>lastNote#".
    $diary_rd->result['diary_id']."</a>".
    "</div>".
    "<div class='btn-block'><input type='submit' value='Save'>".
    "</div></div>";
/*
    "<a href='/d/".$diary_rd->result['diaryType']."/lastNote/".$diary_rd->result['diary_id']."'>lastNote#".
    $diary_rd->result['diary_id']."</a>".
    "<input type='submit' value='Save'>".*/
$appRJ->response['result'].="<div class='pageErr'>".$pageErr."</div>".
    "</form>".
    "</div>".
    "<div class='note-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"]."/site/d/views/diary-contents.php");
$appRJ->response['result'].="</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dFooter.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dMenu.php");
$appRJ->response['result'].= "</body>".
    "</html>";