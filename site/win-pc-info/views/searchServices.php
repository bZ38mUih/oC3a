<?php
$srv_qry="select * from wdSrvList_dt WHERE sName LIKE '%".$_GET['searchArg']."%' ORDER BY sName";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список служб ( ";
}
if($srv_res=$DB->doQuery($srv_qry)){
    if(mysql_num_rows($srv_res)>0){
        $appRJ->response['result'].=mysql_num_rows($srv_res)." )</h3><ul>";
        while ($srv_row=$DB->doFetchRow($srv_res)){
            $appRJ->response['result'].="<li>";
            if($srv_row['sImg']){
                $appRJ->response['result'].="<img src='".WD_SRV_IMG.$srv_row['sImg']."'>";
            }else{
                $appRJ->response['result'].="<img src='/data/default-img.png'>";
            }
            if($srv_row['sDescr']){
                $appRJ->response['result'].="<a href='/win-pc-info/services/".urlencode($srv_row['sName']).
                    "' title='подробнее'>".$srv_row['sName']."</a>";
            }else{
                $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                    $srv_row['sName']."</a>";
            }
            if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                $appRJ->response['result'].="<a href='/win-pc-info/wiMan/services/".urlencode($srv_row['sName'])."' class='editP'>" .
                    "<img src='/source/img/edit-icon.png'> - Edit</a>";
            }
            $appRJ->response['result'].="</li>";
        }
    }else{
        $appRJ->response['result'].="0 )</h3>";
        $appRJ->response['result'] .= "</ul><div class='pageErr'>srvList with sName like %" . $_GET['searchArg'] . "% not found</div>";
    }
}else{
    $appRJ->response['result'].="- )</h3>";
    $appRJ->errors['request']['description']="select from wdSrvList_dt error";
}