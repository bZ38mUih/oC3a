<?php
$appRJ->response['format']='json';
$hwEdit['data']=null;
$hwEdit['err']=null;

$paramVal=null;
$hwDescr=null;
$lastMod=null;

if(isset($_POST['pVal']) and $_POST['pVal']!=null){
    $paramVal=$_POST['pVal'];
}else{
    $hwEdit['err'].="null pVal; ";
}
if(isset($_POST['hwDescr']) and  $_POST['hwDescr']!=null){
    $hwDescr=$_POST['hwDescr'];
}
if(isset($_POST['lastMod']) and $_POST['lastMod']!=null){
    $lastMod=$_POST['lastMod'];
}
if(is_null($hwEdit['err'])){
    $slHw_qry="select * from wdProcList_dt WHERE pName='".$paramVal."'";
    $slHw_res=$DB->query($slHw_qry);
    if($slHw_res->rowCount() === 1){
        $slHw_row = $slHw_res->fetch(PDO::FETCH_ASSOC);
        $udHw_qry="update wdProcList_dt set pDescr='".$hwDescr."', lastMod='".$lastMod."' ".
            "WHERE pName='".$paramVal."'";
        if($DB->query($udHw_qry)){
            $hwEdit['data']="WELL";
        }else{

        }
    }else{
        $hwEdit['err'].="invalid pName or pVal; ".$slHw_qry." rows=".$slHw_res->rowCount();
    }
}
$appRJ->response['result']=$hwEdit;