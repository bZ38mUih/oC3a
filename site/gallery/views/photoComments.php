<?php
/*
$slComments="select * from galleryComments_dt where photo_id=".$photoPrint_row['photo_id']." ";
*/
$printComments=prtPhCm($photoPrint_row['photo_id'] ,null, $DB);
$photoCommentsTxt=$printComments['text'];
if($wrAccRes){
    //$photoCommentsTxt.="<Написать коммент";
}

