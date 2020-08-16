<?php
$h1="Edit diary"."#".$diary_rd['result']['noteDate'];

$note_qry="select * from diaryNotesContent_dt WHERE diary_id=".$diary_rd['result']['diary_id']."  ORDER BY curDate DESC";
echo 111;
echo "<pre>";
print_r($diary_rd);

exit;
$notNotes_warning=false;
$note_res=$DB->query($note_qry);
if($note_res->rowCount() == 0){
    $notNotes_warning=true;
}