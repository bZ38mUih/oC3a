<?php
if(isset($_GET['envList_id']) and $_GET['envList_id']!=null){
    $wdInfo.="<div class='wi-block'>";
    $wdInfo_qry="select * from wdEnv_dt INNER JOIN wdEnvList_dt ON wdEnv_dt.vName=wdEnvList_dt.vName and ".
        "wdEnv_dt.vVal=wdEnvList_dt.vVal WHERE wdEnv_dt.envList_id='".$_GET['envList_id']."'";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/envPrint.php");
    /*
    $wdInfo_res=$DB->doQuery($wdInfo_qry);
    if(mysql_num_rows($wdInfo_res)==1){
        $wdInfo_row=$DB->doFetchRow($wdInfo_res);

        $wdInfo.="<div class='line ta-left'><span class='fName'>".$wdInfo_row['vName'].": "."</span>".
            "<span class='fVal'>".$wdInfo_row['vVal']."</span>";
        $wdInfo.=    "<span class='fVal'>".$wdInfo_row['paramVal']."</span> </div><div class='whDescr'>";
        if($wdInfo_row['vDescr']){
            $wdInfo.=$wdInfo_row['vDescr'];
        }else{
            $wdInfo.="описание не задано";
        }
    }else{
        $appRJ->errors['404']['description']="invalid vName";
    }
    */


    $wdInfo.="</div></div>";
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
    if(isset($appRJ->server['reqUri_expl'][4]) and  $appRJ->server['reqUri_expl'][4]!=null){
        $wdInfo.="<div class='wi-block'>";
        $vVal=urldecode($appRJ->server['reqUri_expl'][4]);
        $wdInfo_qry="select * from wdEnvList_dt WHERE vVal='".$vVal."' and vName='".
            $appRJ->server['reqUri_expl'][3]."'";
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/envPrint.php");
        $wdInfo.="</div>";
    }else{
        $appRJ->errors['404']['description']="invalid varName";
    }
}
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/environment.php");