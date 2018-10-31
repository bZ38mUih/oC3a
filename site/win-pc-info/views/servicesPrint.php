<?php
$wdInfo_res=$DB->doQuery($wdInfo_qry);
if(mysql_num_rows($wdInfo_res)==1){
    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
    $wdInfo.="<h3><div class='line ta-left'><span class='fName'>";
    if($wdInfo_row['sImg']){
        $wdInfo.="<img src='".WD_SRV_IMG.$wdInfo_row['sImg']."'>";
    }else{
        $wdInfo.="<img src='/data/default-img.png'>";
    }
    $wdInfo.="</span>".
        "<span class='fVal'>".$wdInfo_row['sName']."</span></div></h3><div class='wi-descr'>";
    if($wdInfo_row['sDescr']){
        $wdInfo.=$wdInfo_row['sDescr'];
    }else{
        $wdInfo.="описание не задано";
    }
    $wdInfo.="</div>";
}else{
    $appRJ->errors['404']['description']="invalid sName";
}