<?php
$h1="Edit diary"."#".$diary_rd->result['noteDate'];

$note_qry="select * from diaryNotesContent_dt WHERE diary_id=".$diary_rd->result['diary_id']."  ORDER BY curDate DESC";

$notNotes_warning=false;
$note_res=$DB->doQuery($note_qry);
if(mysql_num_rows($note_res)==0){
    $notNotes_warning=true;
}