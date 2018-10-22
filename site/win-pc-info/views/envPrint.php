<?php
$wdInfo_res=$DB->doQuery($wdInfo_qry);
if(mysql_num_rows($wdInfo_res)==1){
    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
    $wdInfo.="<h3><div class='line ta-left'><span class='fName'>".$wdInfo_row['vName'].": "."</span>".
        "<span class='fVal'>".$wdInfo_row['vVal']."</span>";
    $wdInfo.=    "<span class='fVal'>".$wdInfo_row['paramVal']."</span> </div></h3><div class='wi-descr'>";
    if($wdInfo_row['vDescr']){
        $wdInfo.=$wdInfo_row['vDescr'];
    }else{
        $wdInfo.="описание не задано";
    }
    $wdInfo.="</div>";
}else{
    $appRJ->errors['404']['description']="invalid varName or varVal";
}