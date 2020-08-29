<?php
$searchArg=null;
if (isset($_GET['wiSearch']) and $_GET['wiSearch']!=null){
    $appRJ->response['format']="ajax";
    $searchArg=$_GET['searchArg'];
    if($_GET['wiSearch']=="win-environment"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/handbook/views/wpi/wpi-searchEnv.php");
    }elseif($_GET['wiSearch']=="win-system-info"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/handbook/views/wpi/wpi-searchOS.php");
    }elseif($_GET['wiSearch']=="hardware"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/handbook/views/wpi/wpi-searchHw.php");
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
}else{
    $artByAlias_qry="select art_dt.art_id, art_dt.artName, art_dt.artMeta, art_dt.artImg, artCat_dt.catAlias, ".
        "artCat_dt.catName, art_dt.pubDate, art_dt.refreshDate from art_dt ".
        "INNER JOIN artCat_dt ON art_dt.artCat_id = artCat_dt.artCat_id ".
        "WHERE art_dt.artAlias='".$appRJ->server['reqUri_expl'][2]."'";
    $artByAlias_res=$DB->query($artByAlias_qry);
    $artByAlias_row = $artByAlias_res->fetch(PDO::FETCH_ASSOC);
    if($appRJ->server['reqUri_expl'][2]=="win-process"){
        if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
            $wdInfo.="<div class='wi-block'>";
            $pVal=urldecode($appRJ->server['reqUri_expl'][3]);
            $wdInfo_qry="select * from wdProcList_dt WHERE pName='".$pVal."'";
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/handbook/views/wpi/wpi-process-print.php");
            $wdInfo.="</div>";
        }else{
            $searchArg=$_COOKIE['win-process'];
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
            $searchArg=$_COOKIE['win-services'];
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
            $searchArg=$_COOKIE['win-environment'];
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-env-view.php");
        }

    }elseif($appRJ->server['reqUri_expl'][2]=="win-system-info"){
        if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]!=null){
            $wdInfo.="<div class='wi-block'>";
            $vName=urldecode($appRJ->server['reqUri_expl'][3]);
            $vVal=urldecode($appRJ->server['reqUri_expl'][4]);
            $wdInfo_qry="select * from wdOsList_dt WHERE osName='".$vName."' and osVal='".$vVal."'";
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-os-print.php");
            $wdInfo.="</div>";
        }else{
            $searchArg=$_COOKIE['win-system-info'];
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
            $searchArg=$_COOKIE['win-hardware'];
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/wpi/wpi-hw-view.php");
        }
    }
}


