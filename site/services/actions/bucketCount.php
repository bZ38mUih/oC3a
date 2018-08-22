<?php
$appRJ->response['format']='ajax';
$_SESSION["bucket"]["sum"]=0;
$_SESSION["bucket"]["discont"]=0;
$discFlag=false;
$cadr_cnt=0;
foreach ($_SESSION['bucket']['prod'] as $key=>$val){
    if($key=1){
        $discFlag=true;
    }
    $_SESSION["bucket"]["sum"]+=$val;
    $cadr_cnt++;
}
if($cadr_cnt>1 and $discFlag==true){
    $_SESSION["bucket"]["discont"]=$_SESSION['bucket']['prod'][1];
}
$_SESSION["bucket"]["total"]=$_SESSION["bucket"]["sum"]-$_SESSION["bucket"]["discont"];
$appRJ->response["result"]=$_SESSION["bucket"]["total"];