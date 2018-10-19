<?php
$hwProcess_qry="select * from wdProcList_dt WHERE pName LIKE '%".$_GET['searchArg']."%' ORDER BY pName";
if($hwProcess_res=$DB->doQuery($hwProcess_qry)){
    if(mysql_num_rows($hwProcess_res)>0){
        $appRJ->response['result'].="<div class='line caption'>".
            "<div class='td-90'>pName</div></div>";
        while ($hwProcess_row=$DB->doFetchRow($hwProcess_res)){
            $appRJ->response['result'].="<div class='line'><div class='td-90'>";
            //.$hwSearch_row['pName']."</div>";
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
            $appRJ->response['result'].="</div></div>";
        }
    }else{
        $appRJ->response['result'] .= "<div class='pageErr'>hwList with varValue like %" . $_GET['searchArg'] . "% not found</div>";
    }
}else{
    $appRJ->errors['request']['description']="select from wdProcList_dt error";
}