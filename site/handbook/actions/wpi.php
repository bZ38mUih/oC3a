<?php
if (isset($_GET['wiSearch']) and $_GET['wiSearch']!=null){
    $appRJ->response['format']="ajax";
    if($_GET['wiSearch']=="win-environment"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/handbook/views/wpi/wpi-searchEnv.php");
    }elseif($_GET['wiSearch']=="win-system-info"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/handbook/views/wpi/wpi-searchOS.php");
    }elseif($_GET['wiSearch']=="hardware"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/views/searchHw.php");
    }elseif($_GET['wiSearch']=="win-process"){
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/handbook/views/wpi/wpi-searchProcess.php");
    }elseif($_GET['wiSearch']=="win-services"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/handbook/views/wpi/wpi-searchServices.php");
    }elseif($_GET['wiSearch']=="win-hardware"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/handbook/views/wpi/wpi-searchHw.php");
    }
    else{
        $appRJ->response['result'].="wrong search param";
    }
}elseif($appRJ->server['reqUri_expl'][2]=="win-process"){
    if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
        $wdInfo.="<div class='wi-block'>";
        $pVal=urldecode($appRJ->server['reqUri_expl'][3]);
        $wdInfo_qry="select * from wdProcList_dt WHERE pName='".$pVal."'";
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/handbook/views/wpi/wpi-process-print.php");
        $wdInfo.="</div>";
    }else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/handbook/views/wpi/wpi-process-view.php");
    }
}elseif($appRJ->server['reqUri_expl'][2]=="win-services"){
    if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
        $wdInfo.="<div class='wi-block'>";
        $pVal=urldecode($appRJ->server['reqUri_expl'][3]);
        $wdInfo_qry="select * from wdSrvList_dt WHERE sName='".$pVal."'";
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-services-print.php");
        $wdInfo.="</div>";
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-services-view.php");
    }

}elseif($appRJ->server['reqUri_expl'][2]=="win-environment"){
    if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
        $wdInfo.="<div class='wi-block'>";
        $vName=urldecode($appRJ->server['reqUri_expl'][3]);
        $vVal=urldecode($appRJ->server['reqUri_expl'][4]);
        $wdInfo_qry="select * from wdEnvList_dt WHERE vName='".$vName."' and vVal='".$vVal."'";
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-env-print.php");
        $wdInfo.="</div>";
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-env-view.php");
    }

}elseif($appRJ->server['reqUri_expl'][2]=="win-system-info"){
    if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
        $wdInfo.="<div class='wi-block'>";
        $vName=urldecode($appRJ->server['reqUri_expl'][3]);
        $vVal=urldecode($appRJ->server['reqUri_expl'][4]);
        $wdInfo_qry="select * from wdOsList_dt WHERE osName='".$vName."' and osVal='".urldecode($vVal)."'";
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-os-print.php");
        $wdInfo.="</div>";
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-os-view.php");
    }

}elseif($appRJ->server['reqUri_expl'][2]=="win-hardware"){
    if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
        $wdInfo.="<div class='wi-block'>";
        $vName=urldecode($appRJ->server['reqUri_expl'][3]);
        $vVal=urldecode($appRJ->server['reqUri_expl'][4]);
        $wdInfo_qry="select * from wdHwList_dt WHERE paramName='".$vName."' and paramVal='".$vVal."'";
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-hw-print.php");
        $wdInfo.="</div>";
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-hw-view.php");
    }

}
/*
elseif($appRJ->server['reqUri_expl'][2]=="win-services"){

}
*/