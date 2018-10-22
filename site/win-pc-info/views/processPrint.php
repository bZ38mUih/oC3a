<?php
$wdInfo_res=$DB->doQuery($wdInfo_qry);
if(mysql_num_rows($wdInfo_res)==1){
    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
    $wdInfo.="<h3><div class='line ta-left'><span class='fName'>";
    if($wdInfo_row['pImg']){
        $wdInfo.="<img src='".WD_PROC_IMG.$wdInfo_row['pImg']."'>";
    }
    $wdInfo.="</span>".
        "<span class='fVal'>".$wdInfo_row['pName']."</span></div></h3><div class='wi-descr'>";
    if($wdInfo_row['pDescr']){
        $wdInfo.=$wdInfo_row['pDescr'];
    }else{
        $wdInfo.="описание не задано";
    }
    $wdInfo.="</div>";
}else{
    $appRJ->errors['404']['description']="invalid pName";
}