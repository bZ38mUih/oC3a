<?php
$result=null;
foreach ($dType as $k=>$v){
    /*1 / daily
2 / quarterly
3 / yearly
4 / conception
5 / ZKH
    */

    $firstDailyNt_qry="select * from diaryNotes_dt  WHERE diaryType='".$v."' ORDER BY noteDate limit 1";
    $firstDailyNt_res=$DB->query($firstDailyNt_qry);
    $firstDailyNt_row=$firstDailyNt_res->fetch(PDO::FETCH_ASSOC);
    $result[$v]['noteDate']= $firstDailyNt_row['noteDate'];

    $countDailyDiary_qry="select COUNT(diary_id) as cnt from diaryNotes_dt WHERE diaryType='".$v."'";
    $countDailyDiary_res=$DB->query($countDailyDiary_qry);
    $countDailyDiary_row=$countDailyDiary_res->fetch(PDO::FETCH_ASSOC);
    $result[$v]['diaryCnt']= $countDailyDiary_row['cnt'];

    $countDailyNt_qry="select COUNT(diaryNotesContent_dt.note_id) as cnt from diaryNotes_dt INNER JOIN ".
        "diaryNotesContent_dt ON diaryNotesContent_dt.diary_id = diaryNotes_dt.diary_id WHERE diaryNotes_dt.diaryType='".$v."'";
    $countDailyNt_res=$DB->query($countDailyNt_qry);
    $countDailyNt_row=$countDailyNt_res->fetch(PDO::FETCH_ASSOC);
    $result[$v]['notesCnt']= $countDailyNt_row['cnt'];
}