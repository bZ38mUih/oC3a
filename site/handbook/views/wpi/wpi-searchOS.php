<?php
$os_qry="select * from wdOsList_dt WHERE osVal LIKE '%".$_GET['searchArg']."%' ORDER BY osName";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список окружения ( ";
}
if($os_res=$DB->doQuery($os_qry)){
    if(mysql_num_rows($os_res)>0){
        $appRJ->response['result'].=mysql_num_rows($os_res)." )</h3><div class='line caption'>".
            "<div class='td-20'>envName</div><div class='td-70'>envVal</div></div>";
        while ($os_row=$DB->doFetchRow($os_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-20'>";
            $appRJ->response['result'].=$os_row['osName'];
            $appRJ->response['result'].="</div><div class='td-70'>";
            if($os_row['osDescr']){
                $appRJ->response['result'].="<a href='/handbook/win-system-info/".$os_row['osName'].'/'.urlencode($os_row['osVal']).
                    "' title='подробнее'>".$os_row['osVal']."</a>";
            }else{
                $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                    $os_row['osVal']."</a>";
            }
            if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                $appRJ->response['result'].="<a href='/win-pc-info/wiMan/system/".$os_row['osName']."/".urlencode($os_row['osVal'])."' class='editP'>" .
                    "<img src='/source/img/edit-icon.png'> - Edit -</a>";
            }
            $appRJ->response['result'].="</div></div>";
        }
    }else{
        $appRJ->response['result'].="0 )</h3>";
        $appRJ->response['result'] .= "<div class='pageErr'>osList with osVal like %" . $_GET['searchArg'] . "% not found</div>";
    }
}else{
    $appRJ->response['result'].="- )</h3>";
    $appRJ->errors['request']['description']="select from wdOsList_dt error";
}