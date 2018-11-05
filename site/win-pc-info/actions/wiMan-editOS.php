<?php
$appRJ->response['format']='json';
$envEdit['data']=null;
$envEdit['err']=null;

$vName=null;
$vVal=null;
$vDescr=null;

if(isset($_POST['osName']) and $_POST['osName']!=null){
    $vName=$_POST['osName'];
}else{
    $envEdit['err']="null vName; ";
}
if(isset($_POST['osVal']) and $_POST['osVal']!=null){
    $vVal=$_POST['osVal'];
}else{
    $envEdit['err'].="null vVal; ";
}
if(isset($_POST['osDescr']) and  $_POST['osDescr']!=null){
    $vDescr=$_POST['osDescr'];
}
if(is_null($envEdit['err'])){
    $slEnv_qry="select * from wdOsList_dt WHERE osVal='".$vVal."' and osName='".$vName."'";
    $slEnv_res=$DB->doQuery($slEnv_qry);
    if(mysql_num_rows($slEnv_res)===1){
        $slEnv_row=$DB->doFetchRow($slEnv_res);
        $udEnv_qry="update wdOsList_dt set osDescr='".$vDescr."' ".
            "WHERE osVal='".$vVal."' and osName='".$vName."'";
        if($DB->doQuery($udEnv_qry)){
            $envEdit['data']="WELL";
        }else{

        }
    }else{
        $envEdit['err'].="invalid osName or osVal; ";
    }
}
$appRJ->response['result']=$envEdit;