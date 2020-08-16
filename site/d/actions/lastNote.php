<?php
$h1 =$appRJ->server['reqUri_expl'][2]." - last note#";
/*diary-->*/
if($appRJ->server['reqUri_expl'][4]){
    $diary_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2].
        "' and diary_id=".$appRJ->server['reqUri_expl'][4];
}else{
    $diary_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2]."' ORDER BY noteDate DESC LIMIT 1";
}

$diary_res=$DB->query($diary_qry);
if($diary_res->rowCount() > 0){
    $diary_row=$diary_res->fetch(PDO::FETCH_ASSOC);
}else{
    $pageErr="no last diary";
}
$h1.=$diary_row['noteDate'];
/*diary--<*/

/*diaryNext-->*/
$diaryNext_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2].
    "' and noteDate > '".$diary_row['noteDate']."' ORDER BY noteDate ASC LIMIT 1";
$diaryNext_res=$DB->query($diaryNext_qry);
$diaryNext_row=$diaryNext_res->fetch(PDO::FETCH_ASSOC);
/*diaryNext--<*/
/*diaryPre-->*/
$diaryPre_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2].
    "' and noteDate < '".$diary_row['noteDate']."' ORDER BY noteDate DESC LIMIT 1";
$diaryPre_res=$DB->query($diaryPre_qry);
$diaryPre_row=$diaryPre_res->fetch(PDO::FETCH_ASSOC);
/*diaryPre--<*/
$note_qry="select * from diaryNotesContent_dt WHERE diary_id=".$diary_row['diary_id']."  ORDER BY curDate DESC, curTime DESC";

$notNotes_warning=false;

if($diary_row['diary_id']){
    $note_res=$DB->query($note_qry);
    if($note_res->rowCount() == 0){
        $notNotes_warning=true;
    }
}else{
    $notNotes_warning=true;
}
