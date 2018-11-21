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
    $slSrv_res=$DB->doQuery($slSrv_qry);
    if(mysql_num_rows($slSrv_res)===1){
        $udSrv_qry="update wdSrvList_dt set sDescr='".$sDescr."', lastMod='".$lastMod."' ".
            "WHERE sName='".$paramVal."'";
        if($DB->doQuery($udSrv_qry)){
            $hwEdit['data']="WELL";
        }else{

        }
    }else{
        $hwEdit['err'].="invalid sName or pVal; ".$slSrv_qry." rows=".mysql_num_rows($slSrv_res);
    }
}
$appRJ->response['result']=$hwEdit;