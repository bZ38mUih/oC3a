<?php
$srv_qry="select * from wdSrvList_dt WHERE sName LIKE '%".$searchArg."%' ORDER BY sName";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список служб ( ";
}
if($srv_res=$DB->doQuery($srv_qry)){
    if(mysql_num_rows($srv_res)>0){
        //$appRJ->response['result'].=mysql_num_rows($srv_res)." )</h3>";
        //$appRJ->response['result'].=mysql_num_rows($hwProcess_res)." )</h3>";
        $appRJ->response['result'].=mysql_num_rows($srv_res)." )</h3><div class='line caption'>".
            "<div class='td-20'>sImg</div><div class='td-70'>sName</div></div>";
        while ($srv_row=$DB->doFetchRow($srv_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-20'>";
            if($srv_row['sImg']){
                $appRJ->response['result'].="<img src='".WD_SRV_IMG.$srv_row['sImg']."'>";
            }else{
                $appRJ->response['result'].="<img src='/data/default-img.png'>";
            }
            $appRJ->response['result'].="</div><div class='td-70'>";
            if($srv_row['sDescr']){
                $appRJ->response['result'].="<a href='/handbook/win-services/".urlencode($srv_row['sName']).
                    "' title='подробнее'>".$srv_row['sName']."</a>";
            }else{
                $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                    $srv_row['sName']."</a>";
            }
            if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                $appRJ->response['result'].="<a href='/win-pc-info/wiMan/services/".urlencode($srv_row['sName'])."' class='editP'>" .
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
    $appRJ->errors['request']['description']="select from wdSrvList_dt error";
}