<?php
$hwSearch_qry="select * from wdHwList_dt WHERE paramVal LIKE '%".$_GET['searchArg']."%' ORDER BY paramName, paramVal";
//$appRJ->response['result'].="<h4>Результаты поиска:</h4>";
if($_GET['searchArg']){
    $appRJ->response['result'].="<h4>Результаты поиска ( ";
}else{
    $appRJ->response['result'].="<h4>Список аппаратуры ( ";
}
if($hwSearch_res=$DB->doQuery($hwSearch_qry)){
    if(mysql_num_rows($hwSearch_res)>0){
        $appRJ->response['result'].=mysql_num_rows($hwSearch_res)." )</h4><ul>";
        $appRJ->response['result'].="<ul>";


        $lastParName=null;
        $cntPName=0;


        while ($hwSearch_row=$DB->doFetchRow($hwSearch_res)){
            if($hwSearch_row['paramName']!=$lastParName){
                /*
                if($cntPName>1){
                */
                    $appRJ->response['result'].="</li></ul>";
                    /*$cntPName=0;
                }
                */
                $appRJ->response['result'].="<li>".$hwSearch_row['paramName']."<ul>";

                //$cntPName++;
                //$addToList="</li></ul>";

                //$lastPName=$hwSearch_row['paramName'];

                $appRJ->response['result'].="<li>";
                if($hwSearch_row['hwImg']){
                    $appRJ->response['result'].="<img src='".WD_HW_IMG.$hwSearch_row['paramName']."/".$hwSearch_row['hwImg']."'>";
                }else{
                    $appRJ->response['result'].="<img src='/data/default-img.png'>";
                }
                if($hwSearch_row['hwDescr']){
                    $appRJ->response['result'].="<a href='/win-pc-info/hardware/".$hwSearch_row['paramName']."/".
                        urlencode($hwSearch_row['paramVal']).
                        "' title='подробнее'>".$hwSearch_row['paramVal']."</a>";
                }else{
                    $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                        $hwSearch_row['paramVal']."</a>";
                }
                if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                    $appRJ->response['result'].="<a href='/win-pc-info/wiMan/hardware/".$hwSearch_row['paramName']."/".
                        urlencode($hwSearch_row['paramVal']) . "' class='editP'>" .
                        "<img src='/source/img/edit-icon.png'> - Edit</a>";
                }
                $appRJ->response['result'].="</li>";
                /*
                if($hwSearch_row['paramName']!=$lastPName){
                    $appRJ->response['result'].="zzz-".$addToList;
                }
                */
                $lastParName=$hwSearch_row['paramName'];

            }else{
                $appRJ->response['result'].="<li>";
                if($hwSearch_row['hwImg']){
                    $appRJ->response['result'].="<img src='".WD_HW_IMG.$hwSearch_row['paramName']."/".$hwSearch_row['hwImg']."'>";
                }else{
                    $appRJ->response['result'].="<img src='/data/default-img.png'>";
                }
                if($hwSearch_row['hwDescr']){
                    $appRJ->response['result'].="<a href='/win-pc-info/hardware/".$hwSearch_row['paramName']."/".
                        urlencode($hwSearch_row['paramVal']).
                        "' title='подробнее'>".$hwSearch_row['paramVal']."</a>";
                }else{
                    $appRJ->response['result'].="<a href='#' onclick='return false' class='deactive' title='описание не задано'>".
                        $hwSearch_row['paramVal']."</a>";
                }
                if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10){
                    $appRJ->response['result'].="<a href='/win-pc-info/wiMan/hardware/".$hwSearch_row['paramName']."/".
                        urlencode($hwSearch_row['paramVal']) . "' class='editP'>" .
                        "<img src='/source/img/edit-icon.png'> - Edit</a>";
                }
                $appRJ->response['result'].="</li>";
            }


            /*
            $addToList=null;

            */
        }
    }else{
        $appRJ->response['result']="0 )</h4>";
        $appRJ->response['result'] .= "</ul><div class='pageErr'>hwList with varValue like %" . $_GET['searchArg'] . "% not found</div>";
    }
}else{
    $appRJ->response['result']="- )</h4>";
    $appRJ->errors['request']['description']="select from wdHwList_dt error";
}