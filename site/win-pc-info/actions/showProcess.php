<?php
if(isset($_GET['pList_id']) and $_GET['pList_id']!=null){

    $wdInfo.="<div class='wi-block'>";
    $wdInfo_qry="select * from wdHw_dt INNER JOIN wdHwList_dt ON wdHw_dt.paramName=wdHwList_dt.paramName and ".
        "wdHw_dt.paramVal=wdHwList_dt.paramVal WHERE wdHw_dt.hwList_id=".$_GET['hwList_id'];
    $wdInfo_res=$DB->doQuery($wdInfo_qry);
    if(mysql_num_rows($wdInfo_res)==1){
        $wdInfo_row=$DB->doFetchRow($wdInfo_res);
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/hwPrint.php");
    }else{
        $appRJ->errors['404']['description']="invalid hwList_id";
    }
    $wdInfo.="</div></div>";
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
    if(isset($appRJ->server['reqUri_expl'][4]) and  $appRJ->server['reqUri_expl'][4]!=null){
        $wdInfo.="<div class='wi-results'><div class='wi-block ta-left'>";
        $pVal=urldecode($appRJ->server['reqUri_expl'][4]);
        $wdInfo_qry="select * from wdHwList_dt WHERE paramVal='".$pVal."' and paramName='".
            $appRJ->server['reqUri_expl'][3]."'";
        $wdInfo_res=$DB->doQuery($wdInfo_qry);
        if(mysql_num_rows($wdInfo_res)==1){
            $wdInfo_row=$DB->doFetchRow($wdInfo_res);
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/hwPrint.php");
        }else{
            $appRJ->errors['404']['description']="invalid hwType or hwName";
        }
        $wdInfo.="</div></div>";
    }else{
        $appRJ->errors['404']['description']="invalid hwType";
    }
}
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/process.php");