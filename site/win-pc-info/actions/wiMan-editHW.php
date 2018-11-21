<?php
$appRJ->response['format']='json';
$hwEdit['data']=null;
$hwEdit['err']=null;

$paramName=null;
$paramVal=null;
$hwDescr=null;
$lastMod=null;

if(isset($_POST['pName']) and $_POST['pName']!=null){
    $paramName=$_POST['pName'];
}else{
    $hwEdit['err']="null pName; ";
}
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
    $slHw_qry="select * from wdHwList_dt WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
    $slHw_res=$DB->doQuery($slHw_qry);
    if(mysql_num_rows($slHw_res)===1){
        $slHw_row=$DB->doFetchRow($slHw_res);
        $udHw_qry="update wdHwList_dt set hwDescr='".$hwDescr."', lastMod='".$lastMod."' ".
            "WHERE paramVal='".$paramVal."' and paramName='".$paramName."'";
        if($DB->doQuery($udHw_qry)){
            $hwEdit['data']="WELL";
        }else{

        }
    }else{
        $hwEdit['err'].="invalid pName or pVal; ".$slHw_qry." rows=".mysql_num_rows($slHw_res);
    }
}
$appRJ->response['result']=$hwEdit;