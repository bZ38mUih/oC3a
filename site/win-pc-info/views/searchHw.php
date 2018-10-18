<?php
$hwSearch_qry="select * from wdHwList_dt WHERE paramVal LIKE '%".$_GET['searchArg']."%' ORDER BY paramName, paramVal";
$hwSearch_res=$DB->doQuery($hwSearch_qry);
if(mysql_num_rows($hwSearch_res)>0){
    $appRJ->response['result'].="<div class='line caption'>".
        "<div class='td-45'>hwType</div><div class='td-45'>hwName</div></div>";
    while ($hwSearch_row=$DB->doFetchRow($hwSearch_res)){
        $appRJ->response['result'].="<div class='line'><div class='td-45'>".$hwSearch_row['paramName']."</div>".
            "<div class='td-45'>";
        if($hwSearch_row['hwDescr']){
            $appRJ->response['result'].="<a href='/win-pc-info/hardware/".$hwSearch_row['paramName']."/".
                urlencode($hwSearch_row['paramVal']).
            "' title='подробнее'>".$hwSearch_row['paramVal']."</a>";
        }else{
            $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                $hwSearch_row['paramVal']."</a>";
        }
        if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
            $appRJ->response['result'].=
                "<br><a href='/win-pc-info/wiMan/hardware/".$hwSearch_row['paramName']."/" .
                urlencode($hwSearch_row['paramVal']) . "' class='editP'>" .
                "<img src='/source/img/edit-icon.png'> - Edit</a></div>";
        }
        $appRJ->response['result'].="</div></div>";
    }
}else{
    $appRJ->response['result'] = "<div class='pageErr'>hwList with varValue like %" . $_GET['searchArg'] . "% not found</div>";
}