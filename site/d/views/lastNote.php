<?php
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
    "<meta name='robots' content='noindex'>".
    "<title>".$appRJ->server['reqUri_expl'][2]."-lastNote</title>".
    "<link rel='SHORTCUT ICON' href='/site/d/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/d/css/diaryHeader.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/lastNote.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/d/css/dFooter.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/d/js/delNote.js'></script>".
    "<script src='/site/js/goTop.js'></script>".
    "<link rel='stylesheet' href='/site/css/goTop.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
    "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/diaryHeader.php");
if(!$pageErr) {
    $appRJ->response['result'] .= "<div class='note-wrap'>" .
        "<div class='note-header'>" .
        "<div class='note-btn'>";
    if ($diaryNext_row['diary_id']) {
        $appRJ->response['result'] .= "<a href='/d/" . $appRJ->server['reqUri_expl'][2] . "/lastNote/" . $diaryNext_row['diary_id'] . "'>" .
            "<img src='/site/d/img/Forward-next.png' title='Next note'>" .
            "</a>";
    } else {
        $appRJ->response['result'] .= "<a href='#' title='not available'>" .
            "<img src='/site/d/img/Forward-next-deact.png'>" .
            "</a>";
    }
    $appRJ->response['result'] .= "</div>" .
        "<div class='note-header-text ";
    if ($diary_row['diaryHeader']) {
        $appRJ->response['result'] .= "active'>" . $diary_row['diaryHeader'];
    } else {
        $appRJ->response['result'] .= "'>no-header";
    }
    $appRJ->response['result'] .= "</div>" .
        "<div class='note-btn'>";
    if ($diaryPre_row['diary_id']) {
        $appRJ->response['result'] .= "<a href='/d/" . $appRJ->server['reqUri_expl'][2] . "/lastNote/" . $diaryPre_row['diary_id'] . "'>" .
            "<img src='/site/d/img/Forward-pre.png' title='Prev note'>" .
            "</a>";
    } else {
        $appRJ->response['result'] .= "<a href='#' title='not available'>" .
            "<img src='/site/d/img/Forward-pre-deact.png'>" .
            "</a>";
    }
    $appRJ->response['result'] .=
        "</div>";
    $appRJ->response['result'] .= "</div>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/diary-contents.php");
    $appRJ->response['result'] .= "<div class='action-panel'>" .
        "<a href='/d/newNote/" . $diary_row['diary_id'] . "' class='edit'><img src='/source/img/create-icon.png'><span>Add note</span></a>" .
        "<a href='/d/editDiary/" . $diary_row['diary_id'] . "' class='edit'><img src='/source/img/edit-icon.png'><span>Edit header</span></a>" .
        "<a href='#' onclick='delDiary(" . $diary_row['diary_id'] . ")' class='delete'><img src='/source/img/drop-icon.png'><span>Delete diary</span></a>" .
        "</div>" .
        "</div>";
}else{
    $appRJ->response['result'] .="<div class='pageErr'>".$pageErr."</div>";
}
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dFooter.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/d/views/dMenu.php");
    $appRJ->response['result'] .= "</body>" .
        "</html>";
