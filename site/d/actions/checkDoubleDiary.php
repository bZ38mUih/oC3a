<?php
$checkDate_qry="select * from diaryNotes_dt where noteDate='".$diary_rd['result']['noteDate']."' and diaryType='".
    $diary_rd['result']['diaryType']."'";
$checkDate_res=$DB->query($checkDate_qry);
if($checkDate_res->rowCount() !== 0){
    $pageErr.="double noteDate in diary<br>";
}