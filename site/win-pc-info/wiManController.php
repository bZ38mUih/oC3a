<?php
//define(WD_EN_IMG, "/data/win-diag/hardware/");
if($_POST){
    if(isset($_POST['hwEdit']) and $_POST['hwEdit']=='yyy'){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/actions/wiMan-editHW.php");
    }elseif(isset($_POST['envEdit']) and $_POST['envEdit']=='yyy'){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/win-pc-info/actions/wiMan-editEnv.php");
    }


    else{
        $paramName=null;
        $paramVal=null;
        if(isset($_POST['processor']) and $_POST['processor']!=null){
            $paramName="processor";
            $paramVal=$_POST['processor'];
        }elseif(isset($_POST['graphic']) and $_POST['graphic']!=null){
            $paramName="graphic";
            $paramVal=$_POST['graphic'];
        }
        if ($paramName!=null and  $paramVal!=null){
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/editHwImg.php");
        }
    }
}
elseif ($_GET){
    $paramName=null;
    $paramVal=null;
    if(isset($_GET['processor']) and $_GET['processor']!=null){
        $paramName="processor";
        $paramVal=$_GET['processor'];
    }elseif(isset($_GET['graphic']) and $_GET['graphic']!=null){

    }

    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/win-pc-info/actions/delHwImg.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="hardware"){
    if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4]!=null){
        $urlDec=urldecode($appRJ->server['reqUri_expl'][4]);
        $slHw_qry="select * from wdHwList_dt WHERE paramVal='".$urlDec."'";
        $slHw_res=$DB->doQuery($slHw_qry);
        if(mysql_num_rows($slHw_res)==1){
            $slHw_row=$DB->doFetchRow($slHw_res);
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMan-hardware.php");
        }else{
            $appRJ->errors['404']['description']="wrong paramName";
        }
    }
}elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="environment"){
    if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4]!=null){
        $urlDec=urldecode($appRJ->server['reqUri_expl'][4]);
        $slEnv_qry="select * from wdEnvList_dt WHERE vVal='".$urlDec."'";
        $slEnv_res=$DB->doQuery($slEnv_qry);
        if(mysql_num_rows($slEnv_res)==1){
            $slEnv_row=$DB->doFetchRow($slEnv_res);
            require_once($_SERVER["DOCUMENT_ROOT"] . "/site/win-pc-info/views/wiMan-environment.php");
        }else{
            $appRJ->errors['404']['description']="wrong paramName";
        }
    }

}