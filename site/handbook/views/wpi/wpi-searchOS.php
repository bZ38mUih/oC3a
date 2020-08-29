<?php
$os_qry="select * from wdOsList_dt WHERE osVal LIKE '%".$searchArg."%' ORDER BY osName";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список парам. системы ( ";
}
if($os_res=$DB->query($os_qry)){
    if($os_res->rowCount() > 0){
        $appRJ->response['result'].=$os_res->rowCount()." )</h3><div class='line caption'>".
            "<div class='td-20'>osName</div><div class='td-70'>osVal</div></div>";
        while ($os_row = $os_res->fetch(PDO::FETCH_ASSOC)){
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