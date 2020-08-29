<?php
$appRJ->response['format']='json';
$envEdit['data']=null;
$envEdit['err']=null;

$vName=null;
$vVal=null;
$vDescr=null;
$lastMod=null;

if(isset($_POST['vName']) and $_POST['vName']!=null){
    $vName=$_POST['vName'];
}else{
    $envEdit['err']="null vName; ";
}
if(isset($_POST['vVal']) and $_POST['vVal']!=null){
    $vVal=$_POST['vVal'];
}else{
    $envEdit['err'].="null vVal; ";
}
if(isset($_POST['vDescr']) and  $_POST['vDescr']!=null){
    $vDescr=$_POST['vDescr'];
}
if(isset($_POST['lastMod']) and $_POST['lastMod']!=null){
    $lastMod=$_POST['lastMod'];
}

if(is_null($envEdit['err'])){
    $slEnv_qry="select * from wdEnvList_dt WHERE vVal='".$vVal."' and vName='".$vName."'";
    $slEnv_res=$DB->query($slEnv_qry);
    if(mysql_num_rows($slEnv_res)===1){
        $slEnv_row = $slEnv_res->fetch(PDO::FETCH_ASSOC);
        $udEnv_qry="update wdEnvList_dt set vDescr='".$vDescr."', lastMod='".$lastMod."' ".
            "WHERE vVal='".$vVal."' and vName='".$vName."'";
        if($DB->query($udEnv_qry)){
            $envEdit['data']="WELL";
        }else{

        }
    }else{
        $envEdit['err'].="invalid vName or vVal; ";
    }
}
$appRJ->response['result']=$envEdit;