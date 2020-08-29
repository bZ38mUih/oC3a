<?php
$appRJ->response['format']='json';
$hwEdit['data']=null;
$hwEdit['err']=null;

$paramVal=null;
$sDescr=null;
$lastMod=null;

if(isset($_POST['pVal']) and $_POST['pVal']!=null){
    $paramVal=$_POST['pVal'];
}else{
    $hwEdit['err'].="null pVal; ";
}
if(isset($_POST['sDescr']) and  $_POST['sDescr']!=null){
    $sDescr=$_POST['sDescr'];
}
if(isset($_POST['lastMod']) and $_POST['lastMod']!=null){
    $lastMod=$_POST['lastMod'];
}
if(is_null($hwEdit['err'])){
    $slSrv_qry="select * from wdSrvList_dt WHERE sName='".$paramVal."'";
    $slSrv_res=$DB->query($slSrv_qry);
    if($slSrv_res->rowCount() === 1){
        $udSrv_qry="update wdSrvList_dt set sDescr='".$sDescr."', lastMod='".$lastMod."' ".
            "WHERE sName='".$paramVal."'";
        if($DB->query($udSrv_qry)){
            $hwEdit['data']="WELL";
        }else{

        }
    }else{
        $hwEdit['err'].="invalid sName or pVal; ".$slSrv_qry." rows=".$slSrv_res->rowCount();
    }
}
$appRJ->response['result']=$hwEdit;