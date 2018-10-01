<?php
/*
$slComments="select * from galleryComments_dt where photo_id=".$photoPrint_row['photo_id']." ";
*/
$printComments=prtPhCm(null, $DB);
$photoCommentsTxt=$printComments['text'];
if($wrAccRes){
    //$photoCommentsTxt.="<Написать коммент";
}

