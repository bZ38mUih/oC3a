<?php
$h1 =$appRJ->server['reqUri_expl'][2]." - last note#";
/*diary-->*/
if($appRJ->server['reqUri_expl'][4]){
    $diary_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2].
        "' and diary_id=".$appRJ->server['reqUri_expl'][4];
}else{
    $diary_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2]."' ORDER BY noteDate DESC LIMIT 1";
}

$diary_res=$DB->doQuery($diary_qry);
if(mysql_num_rows($diary_res)>0){
    $diary_row=$DB->doFetchRow($diary_res);
}else{
    $pageErr="no last diary";
}
$h1.=$diary_row['noteDate'];
/*diary--<*/

/*diaryNext-->*/
$diaryNext_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2].
    "' and noteDate > '".$diary_row['noteDate']."' ORDER BY noteDate ASC LIMIT 1";
$diaryNext_res=$DB->doQuery($diaryNext_qry);
$diaryNext_row=$DB->doFetchRow($diaryNext_res);
/*diaryNext--<*/
/*diaryPre-->*/
$diaryPre_qry="select * from diaryNotes_dt WHERE diaryType='".$appRJ->server['reqUri_expl'][2].
    "' and noteDate < '".$diary_row['noteDate']."' ORDER BY noteDate DESC LIMIT 1";
$diaryPre_res=$DB->doQuery($diaryPre_qry);
$diaryPre_row=$DB->doFetchRow($diaryPre_res);
/*diaryPre--<*/
$note_qry="select * from diaryNotesContent_dt WHERE diary_id=".$diary_row['diary_id']."  ORDER BY curDate DESC, curTime DESC";

$notNotes_warning=false;
$note_res=$DB->doQuery($note_qry);
if(mysql_num_rows($note_res)==0){
    $notNotes_warning=true;
}