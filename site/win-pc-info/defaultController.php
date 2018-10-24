<?php
/*
if(!$_SESSION['user_id']){
    $appRJ->errors['404']['description']="сервис временно на реконструкции";
}
if(isset($appRJ->errors)){
    $appRJ->throwErr();
}
*/

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
    //$appRJ->response['result'].="<h4>Результаты поиска: </h4>";
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
}
/*
elseif (isset($_GET['sInfo'])){

    if(isset($_GET['pVal']) and $_GET['pVal']!=null){
        $appRJ->response['format']='json';
        $appRJ->response['result']['tInfo']=null;
        $appRJ->response['result']['content']=null;
        $appRJ->response['result']['err']=null;
        if($_GET['sInfo']=='hardware'){
            $srcHw_qry="select * from wdHwList_dt WHERE paramVal='".$_GET['pVal']."'";
            $srcHw_res=$DB->doQuery($srcHw_qry);
            if(mysql_num_rows($srcHw_res)>1){
                //$srcHw_row=$DB->doFetchRow($srcHw_res);
                $appRJ->response['result']['tInfo']='table';
                while ($srcHw_row=$DB->doFetchRow($srcHw_res)){
                    $appRJ->response['result']['content']="<div class='line'>".
                        "<div class='td-30'>".$srcHw_row['paramName']."</div>".
                        "<div class='td-60'>".$srcHw_row['paramVal']."</div>".

                        "</div>";
                    //$appRJ->response['result']['content']
                }
            }else{
                //not found
            }
        }
    }else{
        //null pVal
    }
}
*/
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
        if(isset($_GET['wd_id']) and $_GET['wd_id']!=null){

        }
    }elseif ($appRJ->server['reqUri_expl'][2]==="compare"){
        $cmpRight=24;
        $cmpLeft=21;

        if($_COOKIE['cmpRight']){
            $cmpRight=$_COOKIE['cmpRight'];
        }
        if($_COOKIE['cmpLeft']){
            $cmpLeft=$_COOKIE['cmpLeft'];
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


        require_once($_SERVER["DOCUMENT_ROOT"]."/site/win-pc-info/views/compareView.php");
    }
    else{

    }
}


