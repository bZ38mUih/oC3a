<?php
$cmpRight=3;
$cmpLeft=4;
$cmpEnv=false;
$cmpOS=false;
$cmpHw=false;
$cmpProc=false;
$cmpProcPath=false;
$cmpSrv=false;
$cmpSrvPath=false;
$cmpErr=false;
if($_GET['wdCmp']){
    $appRJ->response['format']='ajax';
    $cmpLeft=$_GET['cmpLeft'];
    $cmpRight=$_GET['cmpRight'];
    if($_GET['opt-envir']){
        $cmpEnv=true;
    }
    if($_GET['opt-os']){
        $cmpOS=true;
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
    if($_GET['opt-srv']){
        $cmpSrv=true;
        if($_GET['opt-srv-path']){
            $cmpSrvPath=true;
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
    if($_COOKIE['opt-os']){
        $cmpOS=true;
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
    if($_COOKIE['opt-srv']){
        $cmpSrv=true;
        if($_COOKIE['opt-srv-path']){
            $cmpSrvPath=true;
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

    $cmpErr="wron cmpLeft";
}
if(mysql_num_rows($wdRightName_res)==1){
    $wdRightName_row=$DB->doFetchRow($wdRightName_res);
}else{
    $cmpErr="wron cmpRight";
}

if($_GET['wdCmp']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareResults.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareView.php");
}

