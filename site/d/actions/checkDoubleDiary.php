<?php
$checkDate_qry="select * from diaryNotes_dt where noteDate='".$diary_rd->result['noteDate']."' and diaryType='".
    $diary_rd->result['diaryType']."'";
$checkDate_res=$DB->doQuery($checkDate_qry);
if(mysql_num_rows($checkDate_res)!==0){
    $pageErr.="double noteDate in diary<br>";
}