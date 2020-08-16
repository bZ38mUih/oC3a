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



/*
echo "<pre>";
print_r($result);
exit;
*/



/*
$firstQtNt_qry="select * from diaryNotes_dt  WHERE diaryType='quarterly' ORDER BY noteDate limit 1";
$firstQtNt_res=$DB->doQuery($firstQtNt_qry);
$firstQtNt_row=$DB->doFetchRow($firstQtNt_res);

$countQtDiary_qry="select COUNT(diary_id) as cnt from diaryNotes_dt WHERE diaryType='quarterly'";
$countQtDiary_res=$DB->doQuery($countQtDiary_qry);
$countQtDiary_row=$DB->doFetchRow($countQtDiary_res);

$countQtNt_qry="select COUNT(diaryNotesContent_dt.note_id) as cnt from diaryNotes_dt INNER JOIN ".
    "diaryNotesContent_dt ON diaryNotesContent_dt.diary_id = diaryNotes_dt.diary_id WHERE diaryNotes_dt.diaryType='quarterly'";
$countQtNt_res=$DB->doQuery($countQtNt_qry);
$countQtNt_row=$DB->doFetchRow($countQtNt_res);


$firstYrNt_qry="select * from diaryNotes_dt  WHERE diaryType='yearly' ORDER BY noteDate limit 1";
$firstYrNt_res=$DB->doQuery($firstYrNt_qry);
$firstYrNt_row=$DB->doFetchRow($firstYrNt_res);

$countYrDiary_qry="select COUNT(diary_id) as cnt from diaryNotes_dt WHERE diaryType='yearly'";
$countYrDiary_res=$DB->doQuery($countYrDiary_qry);
$countYrDiary_row=$DB->doFetchRow($countYrDiary_res);

$countYrNt_qry="select COUNT(diaryNotesContent_dt.note_id) as cnt from diaryNotes_dt INNER JOIN ".
    "diaryNotesContent_dt ON diaryNotesContent_dt.diary_id = diaryNotes_dt.diary_id WHERE diaryNotes_dt.diaryType='yearly'";
$countYrNt_res=$DB->doQuery($countYrNt_qry);
$countYrNt_row=$DB->doFetchRow($countYrNt_res);


$firstCnNt_qry="select * from diaryNotes_dt  WHERE diaryType='conception' ORDER BY noteDate limit 1";
$firstCnNt_res=$DB->doQuery($firstCnNt_qry);
$firstCnNt_row=$DB->doFetchRow($firstCnNt_res);

$countCnDiary_qry="select COUNT(diary_id) as cnt from diaryNotes_dt WHERE diaryType='conception'";
$countCnDiary_res=$DB->doQuery($countCnDiary_qry);
$countCnDiary_row=$DB->doFetchRow($countCnDiary_res);

$countCnNt_qry="select COUNT(diaryNotesContent_dt.note_id) as cnt from diaryNotes_dt INNER JOIN ".
    "diaryNotesContent_dt ON diaryNotesContent_dt.diary_id = diaryNotes_dt.diary_id WHERE diaryNotes_dt.diaryType='conception'";
$countCnNt_res=$DB->doQuery($countCnNt_qry);
$countCnNt_row=$DB->doFetchRow($countCnNt_res);
*/