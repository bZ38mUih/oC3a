<?php
$wdList_qry="select * from wdList_dt WHERE wdTag LIKE '%".$_GET['searchArg']."%' order by diagDate DESC";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список диаг-файлов ( ";
}
if($wdList_res=$DB->doQuery($wdList_qry)){
    if(mysql_num_rows($wdList_res)>0){
        $appRJ->response['result'].=mysql_num_rows($wdList_res)." )</h3>";
        $appRJ->response['result'].="<div class='line caption'>".
            "<div class='td-48'>Tag</div><div class='td-48'>Date</div></div>";
        while ($wdList_row=$DB->doFetchRow($wdList_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-48'><a class='showRes' href='?wd_id=".$wdList_row['wd_id']."'>"
                .$wdList_row['wdTag']."</a></div><div class='td-48'>".$wdList_row['diagDate']."</div></div>";
        }
    }else{
        $appRJ->response['result'].="<div class='pageErr'>wdList with tag like %".$_GET['searchArg']."% not found</div>";
    }
}else{
    $appRJ->response['result']="- )</h3>";
    $appRJ->errors['request']['description']="select from wdList_dt error";
}
