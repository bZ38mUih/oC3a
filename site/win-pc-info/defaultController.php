<?php
define(WD_HW_IMG, "/data/win-pc-info/hardware/");
define(WD_PROC_IMG, "/data/win-pc-info/process/");
define(WD_SRV_IMG, "/data/win-pc-info/services/");
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]=="wiMan"){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/wiManController.php");
}elseif(isset($_FILES) and $_FILES!=null){
    $appRJ->response['format']='json';
    $diagRes['data']=null;
    $diagRes['err']=null;
    $bindFld=null;
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/actions/loadDiagFile.php");
    $appRJ->response['result']=$diagRes;
}
elseif (isset($_GET['wiSearch']) and $_GET['wiSearch']!=null){
    $appRJ->response['format']="ajax";
    if($_GET['wiSearch']=="wiFile"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/views/searchDFile.php");
    }elseif($_GET['wiSearch']=="environment"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/views/searchEnvir.php");
    }elseif($_GET['wiSearch']=="hardware"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/views/searchHw.php");
    }elseif($_GET['wiSearch']=="process"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/views/searchProcess.php");
    }elseif($_GET['wiSearch']=="services"){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/views/searchServices.php");
    }
    else{
        $appRJ->response['result'].="wrong search param";
    }
}elseif (isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=='allList'){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/allList-".$appRJ->server['reqUri_expl'][2].".php");
}
else{
    $wdInfo=null;
    $wdList_rd = new recordDefault("wdList_dt", "wd_id");
    if(!$appRJ->server['reqUri_expl'][2]){
        if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){
            $wdList_rd->result['wd_id']=$_GET['wd_id'];
        }
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/defaultView.php");
    }elseif ($appRJ->server['reqUri_expl'][2]==="environment"){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/actions/showEnvironment.php");
    }elseif ($appRJ->server['reqUri_expl'][2]==="hardware"){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/actions/showHardware.php");
    }elseif ($appRJ->server['reqUri_expl'][2]==="process"){
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/actions/showProcess.php");
    }elseif ($appRJ->server['reqUri_expl'][2]==="services"){
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/actions/showServices.php");
    }elseif ($appRJ->server['reqUri_expl'][2]==="compare"){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/actions/compareFiles.php");
    }
    else{

    }
}


