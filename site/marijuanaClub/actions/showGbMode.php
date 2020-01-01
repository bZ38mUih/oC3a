<?php
$btnNextImg_flag = false;
$btnPreImg_flag = false;

$gbSchedule = new recordDefault("mcGbSchedule_dt", "sch_id");
$gbSchedule_pre = new recordDefault("mcGbSchedule_dt", "sch_id");
$gbSchedule_next = new recordDefault("mcGbSchedule_dt", "sch_id");

$curGbSchedule_qry = "select * from mcGbSchedule_dt WHERE modeDate <= '".$dateFrom."' order by modeDate DESC LIMIT 2";
$curGbSchedule_res=$DB->doQuery($curGbSchedule_qry);

if(mysql_num_rows($curGbSchedule_res) > 0){
    $gbSchedule->result = $DB->doFetchRow($curGbSchedule_res);
    if(mysql_num_rows($curGbSchedule_res) == 2){
        $gbSchedule_pre->result = $DB->doFetchRow($curGbSchedule_res);
        $btnNextImg_flag = true;// "";
    }
}else{
    //
    //echo "nnn-".$curGbSchedule_qry;
}
$curGbScheduleNext_qry = "select * from mcGbSchedule_dt WHERE modeDate > '".$dateFrom."' order by modeDate DESC LIMIT 1";
$curGbScheduleNext_res=$DB->doQuery($curGbScheduleNext_qry);
if(mysql_num_rows($curGbScheduleNext_res) == 1){
    $gbSchedule_next->result = $DB->doFetchRow($curGbScheduleNext_res);
    $btnPreImg_flag = true;//"Forward-pre-deact.png";
}
$gbModeName = 'unknown';
if(date_format($appRJ->date['curDate'], 'Y-m-d') >= $gbSchedule->result['modeDate']){
    if(!$gbSchedule_next->result['modeDate'] or (date_format($appRJ->date['curDate'], 'Y-m-d') < $gbSchedule_next->result['modeDate'])){
        $gbModeName = "Текущий режим";
    }else{
        $gbModeName = "Предыдущий режим";
    }
}else{
    if(date_format($appRJ->date['curDate'], 'Y-m-d') < $gbSchedule_next->result['modeDate']){
        $gbModeName = "Будущий режим";
    }
}