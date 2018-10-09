<?php
$appRJ->response['result']='process here<br>';
$test_id=2;
$difProc_qry="select wdProc_dt.pName as pName1, wdProcList_dt.pName as pName2 from wdProc_dt ".
    "LEFT JOIN wdProcList_dt ON wdProc_dt.pName=wdProcList_dt.pName ".
"WHERE wdProc_dt.wd_id=".$test_id;
if($difProc_res=$DB->doQuery($difProc_qry)){
    if(mysql_num_rows($difProc_res)>0){
        $appRJ->response['result'].="Записей: ".mysql_num_rows($difProc_res)."<br><br>";
        while($difProc_row=$DB->doFetchRow($difProc_res)){
            $appRJ->response['result'].="pName1=".$difProc_row['pName1']." | pName2=".$difProc_row['pName2']."<br>";
        }
    }else{
        $appRJ->response['result'].="now rows in query";
    }
}else{
    $appRJ->response['result'].="query fail";
}