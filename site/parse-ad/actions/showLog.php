<?php
$showLog_qry="select * from parseAdLog_dt order by logDate DESC LIMIT ".$_GET['logdepth'];
$showLog_res=$DB->doQuery($showLog_qry);
if(mysql_num_rows($showLog_res)>0){
    while ($showLog_row=$DB->doFetchRow($showLog_res)){
        $parseLog_arr=json_decode($showLog_row['logContent'], true);
        $appRJ->response['result'].="<div class='logRes'>".
            "<h3>Распарсил: ".$showLog_row['logDate']."</h3>";

        foreach($parseLog_arr as $key=>$value){
            $appRJ->response['result'].="<div class='logType'>";
            $appRJ->response['result'].="<span>".$key."</span>";
            foreach($value as $subKey=>$subVal){
                //$logRes.="<div class='log-type-res'>".$subKey."-".$subVal."</div>";
                $appRJ->response['result'].="<li>".$subKey."-".$subVal."</li>";
            }
            $appRJ->response['result'].="</div>";
        }
        $appRJ->response['result'].="</div>";
    }
}else{
    $appRJ->response['result']="отсутствуют записи в логе";
}