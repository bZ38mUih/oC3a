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
    $slHw_res=$DB->doQuery($slHw_qry);
    if(mysql_num_rows($slHw_res)===1){
        $slHw_row=$DB->doFetchRow($slHw_res);
        $udHw_qry="update wdProcList_dt set pDescr='".$hwDescr."', lastMod='".$lastMod."' ".
            "WHERE pName='".$paramVal."'";
        if($DB->doQuery($udHw_qry)){
            $hwEdit['data']="WELL";
        }else{

        }
    }else{
        $hwEdit['err'].="invalid pName or pVal; ".$slHw_qry." rows=".mysql_num_rows($slHw_res);
    }
}
$appRJ->response['result']=$hwEdit;