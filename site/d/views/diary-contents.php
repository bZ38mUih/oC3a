<?php
$appRJ->response['result'].="<div class='dairy-contents'>";
if(!$notNotes_warning) {
    while ($note_row = $DB->doFetchRow($note_res)) {
        $appRJ->response['result'] .= "<div class='note-content' id='".$note_row['note_id']."'>".
            "<div class='note-content-info'>".
            "<span class='note-date'>" . $note_row['curDate'] . "</span>".
            "<span class='note-time'>" . substr($note_row['curTime'], 0, strlen($note_row['curTime'])-3) . "</span>".
            "</div>".
            "<div class='note-content-text'>".
            dec_enc("decrypt", $note_row["content"], $note_row["curDate"]).
            "</div>".
            "<div class='note-content-btn'>".
            "<a href='/d/editNote/" . $note_row['note_id'] . "' class='edit'><img src='/source/img/edit-icon.png'><span>Edit</span></a>".
            "<a href='#' onclick='delNote(".$note_row['note_id'].")' class='delete'><img src='/source/img/drop-icon.png'><span>Delete</span></a>".
            "</div>".
            "</div>";
    }
}else{
    $appRJ->response['result'] .= "<div class='pageErr'>No notes in diary </div>";
}
$appRJ->response['result'].="</div>";