<?php
$wdList_qry="select * from wdList_dt WHERE wdTag LIKE '%".$_GET['searchArg']."%' order by diagDate DESC";
if($wdList_res=$DB->doQuery($wdList_qry)){
    if(mysql_num_rows($wdList_res)>0){
        $appRJ->response['result'].="<div class='line caption'>".
            "<div class='td-45'>Tag</div><div class='td-45'>Date</div></div>";
        while ($wdList_row=$DB->doFetchRow($wdList_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-45'><a class='showRes' href='?wd_id=".$wdList_row['wd_id']."'>"
                .$wdList_row['wdTag']."</a></div><div class='td-45'>".$wdList_row['diagDate']."</div></div>";
        }
    }else{
        $appRJ->response['result']="<div class='pageErr'>wdList with tag like %".$_GET['searchArg']."% not found</div>";
    }
}else{
    $appRJ->errors['request']['description']="select from wdList_dt error";
}