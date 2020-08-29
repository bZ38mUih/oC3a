<?php
$env_qry="select * from wdEnvList_dt WHERE vVal LIKE '%".$searchArg."%' ORDER BY vName";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список окружения ( ";
}
if($env_res=$DB->query($env_qry)){
    if(mysql_num_rows($env_res)>0){
        $appRJ->response['result'].=mysql_num_rows($env_res)." )</h3><div class='line caption'>".
            "<div class='td-20'>envName</div><div class='td-70'>envVal</div></div>";
        while ($env_row = $env_res->fetch(PDO::FETCH_ASSOC)){
            $appRJ->response['result'].="<div class='line'><div class='td-20'>";
            $appRJ->response['result'].=$env_row['vName'];
            $appRJ->response['result'].="</div><div class='td-70'>";
            if($env_row['vDescr']){
                $appRJ->response['result'].="<a href='/handbook/win-environment/".$env_row['vName'].'/'.urlencode($env_row['vVal']).
                    "' title='подробнее'>".$env_row['vVal']."</a>";
            }else{
                $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                    $env_row['vVal']."</a>";
            }
            if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                $appRJ->response['result'].="<a href='/win-pc-info/wiMan/environment/".$env_row['vName']."/".urlencode($env_row['vVal'])."' class='editP'>" .
                    "<img src='/source/img/edit-icon.png'> - Edit -</a>";
            }
            $appRJ->response['result'].="</div></div>";
        }
    }else{
        $appRJ->response['result'].="0 )</h3>";
        $appRJ->response['result'] .= "<div class='pageErr'>srvList with sName like %" . $_GET['searchArg'] . "% not found</div>";
    }
}else{
    $appRJ->response['result'].="- )</h3>";
    $appRJ->errors['request']['description']="select from wdEnvList_dt error";
}