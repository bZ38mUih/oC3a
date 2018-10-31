<?php
if(isset($_GET['sList_id']) and $_GET['sList_id']!=null){
    $wdInfo.="<div class='wi-block'>";
    $wdInfo_qry="select * from wdSrv_dt INNER JOIN wdSrvList_dt ON wdSrv_dt.sName=wdSrvList_dt.sName ".
        " WHERE wdSrv_dt.sList_id=".$_GET['sList_id'];
    $wdInfo_res=$DB->doQuery($wdInfo_qry);
    if(mysql_num_rows($wdInfo_res)==1){
        $wdInfo_row=$DB->doFetchRow($wdInfo_res);
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/servicesPrint.php");
    }else{
        $appRJ->errors['404']['description']="invalid sList_id";
    }
    $wdInfo.="</div></div>";
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
    $wdInfo.="<div class='wi-block'>";
    $pVal=urldecode($appRJ->server['reqUri_expl'][3]);
    $wdInfo_qry="select * from wdSrvList_dt WHERE sName='".$pVal."'";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/servicesPrint.php");
    $wdInfo.="</div>";
}
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/services.php");