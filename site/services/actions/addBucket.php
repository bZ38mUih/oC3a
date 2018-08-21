<?php
$appRJ->response['format']='ajax';
$addBucket=new recordDefault("srvCards_dt", "card_id");
$addBucket->result['card_id']=$_GET['addBucket'];
if($addBucket->copyOne()){
    $_SESSION['bucket']['prod'][$addBucket->result['card_id']]=$addBucket->result['cardPrice'];
}
$_SESSION["bucket"]["total"]=0;
foreach ($_SESSION['bucket']['prod'] as $key=>$val){
    $_SESSION["bucket"]["total"]+=$val;
}
$appRJ->response["result"]=$_SESSION["bucket"]["total"];