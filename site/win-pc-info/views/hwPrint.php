<?php
if(mysql_num_rows($wdInfo_res)==1){
    $wdInfo_row=$DB->doFetchRow($wdInfo_res);
    $wdInfo.="<h3><div class='line ta-left'><span class='fName'>";
    if($wdInfo_row['hwImg']){
        $wdInfo.="<img src='".WD_HW_IMG.$wdInfo_row['paramName']."/preview/".$wdInfo_row['hwImg']."'>";
    }
    $wdInfo.="</span>".
        "<span class='fVal'>".$wdInfo_row['paramVal']."</span> </div></h3>";
    if($wdInfo_row['hwDescr']){
        $wdInfo.=$wdInfo_row['hwDescr'];
    }else{
        $wdInfo.="описание не задано";
    }
}else{
    $appRJ->errors['404']['description']="invalid hwList_id";
}