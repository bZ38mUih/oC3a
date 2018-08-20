<?php
$appRJ->response['format']='ajax';
$addBucket=new recordDefault("srvCards_dt", "card_id");
$addBucket->result['card_id']=$_GET['addBucket'];
if($addBucket->copyOne()){
    if(isset($_SESSION['bucket']['prod'][$addBucket->result['card_id']]) and
        $_SESSION['bucket']['prod'][$addBucket->result['card_id']]==$addBucket->result['cardPrice']
    ){

    }else{

    }
}else{
    //$appRJ->response['result']="неп"
}