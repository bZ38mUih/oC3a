<?php
if(!$_SESSION['user_id']){
    $appRJ->errors['404']['description']="сервис временно на реконструкции";
}
if(isset($appRJ->errors)){
    $appRJ->throwErr();
}

define(WD_HW_IMG, "/data/win-pc-info/hardware/");
define(WD_PROC_IMG, "/data/win-pc-info/process/");
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
        /*
        if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

        }
        */
        $appRJ->errors['stab']['description']="сервис временно на реконструкции";
    }elseif ($appRJ->server['reqUri_expl'][2]==="compare"){
        $cmpRight=24;
        $cmpLeft=21;
        $cmpEnv=false;
        $cmpHw=false;
        $cmpProc=false;
        $cmpProcPath=false;
        if($_GET['wdCmp']){
            $appRJ->response['format']='ajax';
            $cmpLeft=$_GET['cmpLeft'];
            $cmpRight=$_GET['cmpRight'];
            if($_GET['opt-envir']){
                $cmpEnv=true;
            }
            if($_GET['opt-hardware']){
                $cmpHw=true;
            }
            if($_GET['opt-process']){
                $cmpProc=true;
                if($_GET['opt-pr-path']){
                    $cmpProcPath=true;
                }
            }
        }else{
            if($_COOKIE['cmpRight']){
                $cmpRight=$_COOKIE['cmpRight'];
            }
            if($_COOKIE['cmpLeft']){
                $cmpLeft=$_COOKIE['cmpLeft'];
            }
            if($_COOKIE['opt-envir']){
                $cmpEnv=true;
            }
            if($_COOKIE['opt-hardware']){
                $cmpHw=true;
            }
            if($_COOKIE['opt-process']){
                $cmpProc=true;
                if($_COOKIE['opt-pr-path']){
                    $cmpProcPath=true;
                }
            }
        }
        $wdLeftName_qry="select * from wdList_dt WHERE wd_id=".$cmpLeft;
        $wdRightName_qry="select * from wdList_dt WHERE wd_id=".$cmpRight;
        $wdLeftName_res=$DB->doQuery($wdLeftName_qry);
        $wdRightName_res=$DB->doQuery($wdRightName_qry);
        if(mysql_num_rows($wdLeftName_res)==1){
            $wdLeftName_row=$DB->doFetchRow($wdLeftName_res);
        }else{
            //throw err
        }
        if(mysql_num_rows($wdRightName_res)==1){
            $wdRightName_row=$DB->doFetchRow($wdRightName_res);
        }else{
            //throw err
        }

        if($_GET['wdCmp']){
            require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareResults.php");
        }else{
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareView.php");
        }
    }
    else{

    }
}


