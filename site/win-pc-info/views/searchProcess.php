<?php
$hwProcess_qry="select * from wdProcList_dt WHERE pName LIKE '%".$_GET['searchArg']."%' ORDER BY pName";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h3>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h3>Список процессов ( ";
}
if($hwProcess_res=$DB->doQuery($hwProcess_qry)){
    if(mysql_num_rows($hwProcess_res)>0){
        $appRJ->response['result'].=mysql_num_rows($hwProcess_res)." )</h3><ul>";
        while ($hwProcess_row=$DB->doFetchRow($hwProcess_res)){
            $appRJ->response['result'].="<li>";
            if($hwProcess_row['pImg']){
                $appRJ->response['result'].="<img src='".WD_PROC_IMG.$hwProcess_row['pImg']."'>";
            }else{
                $appRJ->response['result'].="<img src='/data/default-img.png'>";
            }
            if($hwProcess_row['pDescr']){
                $appRJ->response['result'].="<a href='/win-pc-info/process/".$hwProcess_row['pName'].
                    "' title='подробнее'>".$hwProcess_row['pName']."</a>";
            }else{
                $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                    $hwProcess_row['pName']."</a>";
            }
            if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                $appRJ->response['result'].="<a href='/win-pc-info/wiMan/process/".$hwProcess_row['pName']."' class='editP'>" .
                    "<img src='/source/img/edit-icon.png'> - Edit</a>";
            }
            $appRJ->response['result'].="</li>";
        }
    }else{
        $appRJ->response['result'].="0 )</h3>";
        $appRJ->response['result'] .= "</ul><div class='pageErr'>procList with pName like %" . utf8_decode($_GET['searchArg']) . "% not found</div>";
    }
}else{
    $appRJ->response['result'].="- )</h3>";
    $appRJ->errors['request']['description']="select from wdProcList_dt error";
}