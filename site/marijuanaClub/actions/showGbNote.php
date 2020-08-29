<?php
$btnNextNote_flag = false;
$btnPreNote_flag = false;

$gbNote = new recordDefault("mcGbNotes_dt", "note_id");
$gbNote_pre = new recordDefault("mcGbNotes_dt", "note_id");
$gbNote_next = new recordDefault("mcGbNotes_dt", "note_id");

$curGbNote_qry = "select * from mcGbNotes_dt WHERE note_id = '".$note_id."'";
$curGbNote_res=$DB->doQuery($curGbNote_qry);

if(mysql_num_rows($curGbNote_res) > 0){
    $gbNote['result'] = $DB->doFetchRow($curGbNote_res);
    $preNote_qry = "select * from mcGbNotes_dt WHERE noteDate <= '".$gbNote['result']['noteDate']."' order by noteDate DESC, noteTime DESC";
    $preNote_res = $DB->doQuery($preNote_qry);
    while($preNote_row = $DB->doFetchRow($preNote_res)){
        if($preNote_row['noteDate'] < $gbNote['result']['noteDate']){
            $gbNote_pre['result'] = $preNote_row;
            $btnNextNote_flag = true;
            break;
        }else{
            if($preNote_row['noteTime'] < $gbNote['result']['noteTime']){
                $gbNote_pre['result'] = $preNote_row;
                $btnNextNote_flag = true;
                break;
            }
        }
    }
}else{
    //
    //echo "nnn-".$curGbSchedule_qry;
}
$curGbNoteNext_qry = "select * from mcGbNotes_dt WHERE noteDate >= '".$gbNote['result']['noteDate']."' order by noteDate, noteTime";
$curGbNoteNext_res=$DB->doQuery($curGbNoteNext_qry);
while($curGbNoteNext_row = $DB->doFetchRow($curGbNoteNext_res)){
   if($curGbNoteNext_row['noteDate'] > $gbNote['result']['noteDate']){
        $gbNote_next['result'] = $curGbNoteNext_row;
        $btnPreNote_flag = true;
        break;
    }else{
        if($curGbNoteNext_row['noteTime'] > $gbNote['result']['noteTime']){
            $gbNote_next['result'] = $curGbNoteNext_row;
            $btnPreNote_flag = true;
            break;
        }
    }
}
//if(mysql_num_rows($curGbNoteNext_res) == 1){
  //  $gbNote_next['result'] = $DB->doFetchRow($curGbNoteNext_res);

    //$btnPreNote_flag = true;//"Forward-pre-deact.png";
//}

$gbNoteName = 'unknown';
if(date_format($appRJ->date['curDate'], 'Y-m-d') >= $gbNote['result']['noteDate']){
    if(!$gbNote_next['result']['noteDate'] or (date_format($appRJ->date['noteDate'], 'Y-m-d') < $gbNote_next['result']['noteDate'])){
        $gbNoteName = "Последняя запись";
    }else{
        $gbNoteName = "Предыдущая запись";
    }
}else{
    if(date_format($appRJ->date['curDate'], 'Y-m-d') < $gbNote_next['result']['noteDate']){
        $gbNoteName = "Следующая запись";
    }
}
