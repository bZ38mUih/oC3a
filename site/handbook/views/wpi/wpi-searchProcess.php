<?php
$hwProcess_qry="select * from wdProcList_dt WHERE pName LIKE '%".$searchArg."%' ORDER BY pName";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список процессов ( ";
}
if($hwProcess_res=$DB->doQuery($hwProcess_qry)){
    if(mysql_num_rows($hwProcess_res)>0){
        $appRJ->response['result'].=mysql_num_rows($hwProcess_res)." )</h3><div class='line caption'>".
            "<div class='td-20'>pImg</div><div class='td-70'>pName</div></div>";
        while ($hwProcess_row=$DB->doFetchRow($hwProcess_res)){

            $appRJ->response['result'].="<div class='line'><div class='td-20'>";
            if($hwProcess_row['pImg']){
                $appRJ->response['result'].="<img src='".WD_PROC_IMG.$hwProcess_row['pImg']."'>";
            }else{
                $appRJ->response['result'].="<img src='/data/default-img.png'>";
            }
            $appRJ->response['result'].="</div><div class='td-70'>";
            if($hwProcess_row['pDescr']){
                $appRJ->response['result'].="<a href='/handbook/win-process/".$hwProcess_row['pName'].
                    "' title='подробнее'>".$hwProcess_row['pName']."</a>";
            }else{
                $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                    $hwProcess_row['pName']."</a>";
            }
            if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                $appRJ->response['result'].="<a href='/win-pc-info/wiMan/process/".$hwProcess_row['pName']."' class='editP'>" .
                    "<img src='/source/img/edit-icon.png'> - Edit -</a>";
            }
            $appRJ->response['result'].="</div></div>";
        }
    }else{
        $appRJ->response['result'].="0 )</h3>";
        $appRJ->response['result'] .= "<div class='pageErr'>procList with pName like %" . utf8_decode($_GET['searchArg']) . "% not found</div>";
    }
}else{
    $appRJ->response['result'].="- )</h3>";
    $appRJ->errors['request']['description']="select from wdProcList_dt error";
}