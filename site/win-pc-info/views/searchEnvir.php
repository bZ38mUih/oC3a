<?php
$envSearch_qry="select * from wdEnvList_dt  WHERE vVal LIKE '%".$_GET['searchArg']."%' order by vName, vVal";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список окружения ( ";
}
if($envSearch_res=$DB->doQuery($envSearch_qry)){
    if(mysql_num_rows($envSearch_res)>0){
        $appRJ->response['result'].=mysql_num_rows($envSearch_res)." )</h3>";
        $appRJ->response['result'].="<div class='line caption'>".
            "<div class='td-48'>varName</div><div class='td-48'>varValue</div></div>";
        while ($envSearch_row=$DB->doFetchRow($envSearch_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-48'>".$envSearch_row['vName']."</div>".
                "<div class='td-48'>";
            if($envSearch_row['vDescr']){
                $appRJ->response['result'].="<a href='/win-pc-info/environment/".$envSearch_row['vName']."/".
                    $envSearch_row['vVal']."' title='подробнее'>".$envSearch_row['vVal']."</a>";
            }else{
                $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                    $envSearch_row['vVal']."</a>";
            }
            if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                $appRJ->response['result'].="<a href='/win-pc-info/wiMan/environment/".$envSearch_row['vName']."/".
                    urlencode($envSearch_row['vVal']) . "' class='editP'>" .
                    "<img src='/source/img/edit-icon.png'> - Edit</a>";
            }
            $appRJ->response['result'].="</div></div>";
        }
    }else{
        $appRJ->response['result'].="<div class='pageErr'>envList with varValue like %".$_GET['searchArg']."% not found</div>";
    }
}else{
    $appRJ->response['result']="- )</h3>";
    $appRJ->errors['request']['description']="select from wdEnvList_dt error";
}
