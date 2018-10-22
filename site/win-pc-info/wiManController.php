<?php
if($_POST){
    if(isset($_POST['hwEdit']) and $_POST['hwEdit']=='yyy'){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/actions/wiMan-editHW.php");
    }elseif(isset($_POST['envEdit']) and $_POST['envEdit']=='yyy'){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/actions/wiMan-editEnv.php");
    }elseif(isset($_POST['pEdit']) and $_POST['pEdit']=='yyy'){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/actions/wiMan-editProcess.php");
    }
    else{
        $paramName=null;
        $paramVal=null;
        if(isset($_POST['processor']) and $_POST['processor']!=null){
            $paramName="processor";
            $paramVal=$_POST['processor'];
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/editHwImg.php");
        }elseif(isset($_POST['graphic']) and $_POST['graphic']!=null){
            $paramName="graphic";
            $paramVal=$_POST['graphic'];
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/editHwImg.php");
        }elseif (isset($_POST['process'])){
            //$editImg['result'] = false;
            //$editImg['data'] = 'ddddd';
            //$appRJ->response['format']='json';
            //$appRJ->response['result'] = $editImg;

            $paramVal=$_POST['process'];
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/wiMan-editProcessImg.php");
        }
        /*
        if ($paramName!=null and  $paramVal!=null){

        }
        */
    }
}
elseif ($_GET){
    $paramName=null;
    $paramVal=null;
    if(isset($_GET['processor']) and $_GET['processor']!=null){
        $paramName="processor";
        $paramVal=$_GET['processor'];
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/delHwImg.php");
    }elseif(isset($_GET['graphic']) and $_GET['graphic']!=null){
        $paramName="graphic";
        $paramVal=$_GET['graphic'];
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/delHwImg.php");
    }elseif (isset($_GET['process']) and $_GET['process']!=null){
        $paramVal=$_GET['process'];
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/wiMan-delProcessImg.php");
/*
        $delImg['result'] = false;
        $delImg['data'] = "xyi";
        $appRJ->response['format']='json';
        $appRJ->response['result'] = $delImg;
*/

    }


}
elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="hardware"){
    if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4]!=null){
        if(isset($appRJ->server['reqUri_expl'][5]) and $appRJ->server['reqUri_expl'][5]!=null){
            $urlDec=urldecode($appRJ->server['reqUri_expl'][5]);
            $slHw_qry="select * from wdHwList_dt WHERE paramVal='".$urlDec."'";
            $slHw_res=$DB->doQuery($slHw_qry);
            if(mysql_num_rows($slHw_res)==1){
                $slHw_row=$DB->doFetchRow($slHw_res);
                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMan-hardware.php");
            }else{
                $appRJ->errors['404']['description']="invalid paramName or invalid";
            }
        }else{
            $appRJ->errors['404']['description']="invalid invalid";
        }
    }else{
        $appRJ->errors['404']['description']="invalid paramName";
    }
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="environment"){
    if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4]!=null){
        if(isset($appRJ->server['reqUri_expl'][5]) and $appRJ->server['reqUri_expl'][5]!=null){
            $urlDec=urldecode($appRJ->server['reqUri_expl'][5]);
            $slEnv_qry="select * from wdEnvList_dt WHERE vVal='".$urlDec."' and vName='".$appRJ->server['reqUri_expl'][4]."'";
            $slEnv_res=$DB->doQuery($slEnv_qry);
            if(mysql_num_rows($slEnv_res)==1){
                $slEnv_row=$DB->doFetchRow($slEnv_res);
                require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMan-environment.php");
            }else{
                $appRJ->errors['404']['description']="invalid vName or vVal";
            }
        }else{
            $appRJ->errors['404']['description']="invalid vVal";
        }
    }else{
        $appRJ->errors['404']['description']="invalid vName";
    }
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="process"){
    if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4]!=null){
        $slProcess_qry="select * from wdProcList_dt where pName='".$appRJ->server['reqUri_expl'][4]."'";
        $slProcess_res=$DB->doQuery($slProcess_qry);
        if(mysql_num_rows($slProcess_res)==1){
            $slProcess_row=$DB->doFetchRow($slProcess_res);
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMan-process.php");
        }
    }else{
        $appRJ->errors['404']['description']="invalid pName";
    }
}