<?php


$test_id=13;
/*hwList-->
$difHw_qry="select wdHw_dt.paramName, wdHw_dt.paramVal from wdHw_dt ".
    "LEFT JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and wdHw_dt.paramVal=wdHwList_dt.paramVal ".
    "WHERE wdHw_dt.wd_id=".$test_id." and wdHwList_dt.paramName is null and wdHwList_dt.paramVal is null ".
    "order by wdHw_dt.paramName, wdHw_dt.paramVal";
if($difHw_res=$DB->doQuery($difHw_qry)){
    if(mysql_num_rows($difHw_res)>0){
        $appRJ->response['result'].="Записей: ".mysql_num_rows($difHw_res)."<br><br>";
        while($difHw_row=$DB->doFetchRow($difHw_res)){
            //$appRJ->response['result'].="pName1=".$difProc_row['pName']." | pName2=".$difProc_row['pName2']."<br>";
            $appRJ->response['result'].="newParamName=".$difHw_row['paramName']." | newParamVal=".$difHw_row['paramVal']."<br>";
        }
    }else{
        $appRJ->response['result'].="no new hardware";
    }
}else{
    $appRJ->response['result'].="query fail";
}

$appRJ->response['result'].="insersion in wdHwList_dt:<br>";
$insertHwList_qry="insert into wdHwList_dt(paramName, paramVal) ".$difHw_qry;
if($DB->doQuery($insertHwList_qry)){
    $appRJ->response['result'].="insertions WELL<br>";
}else{
    $appRJ->response['result'].="insertions FAIL-3<br>";
    $appRJ->response['result'].=$difHw_qry;
}

hwList--<*/



/*
print_r($_GET);
echo "<hr>";
if(isset($appRJ->server['reqUri_expl'][3])){
    echo "uri-3=".urldecode($appRJ->server['reqUri_expl'][3]);
}else{
    echo "uri-3 not set";
}
exit;
*/