<?php
// nP79ETfWwaBJeyi/5IvBGeWY
$payment = new recordDefault("payments_dt", "label");
if(isset($_POST['label'])){

    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/temp/ym_redir.txt", json_encode($_SERVER, true));

    if(isset($_POST['notification_type'])){
        $payment->result['notification_type']=$_POST['notification_type'];
    }
    if(isset($_POST['operation_id'])){
        $payment->result['operation_id']=$_POST['operation_id'];
    }
    if(isset($_POST['amount'])){
        $payment->result['amount']=$_POST['amount'];
    }
    if(isset($_POST['withdraw_amount'])){
        $payment->result['withdraw_amount']=$_POST['withdraw_amount'];
    }
    if(isset($_POST['currency'])){
        $payment->result['currency']=$_POST['currency'];
    }
    if(isset($_POST['datetime'])){
        $payment->result['datetime']=$_POST['datetime'];
    }
    if(isset($_POST['sender'])){
        $payment->result['sender']=$_POST['sender'];
    }
    if(isset($_POST['codepro'])){
        $payment->result['codepro']=$_POST['codepro'];
    }
    //if(isset($_POST['codepro'])){
        $payment->result['label']=$_POST['label'];
    //}
    if(isset($_POST['sha1_hash'])){
        $payment->result['sha1_hash']=$_POST['sha1_hash'];
    }
    if(isset($_POST['unaccepted'])){
        $payment->result['unaccepted']=$_POST['unaccepted'];
    }
    if(isset($_POST['lastname'])){
        $payment->result['lastname']=$_POST['lastname'];
    }
    if(isset($_POST['firstname'])){
        $payment->result['firstname']=$_POST['firstname'];
    }
    if(isset($_POST['fathersname'])){
        $payment->result['fathersname']=$_POST['fathersname'];
    }
    if(isset($_POST['email'])){
        $payment->result['email']=$_POST['email'];
    }
    if(isset($_POST['phone'])){
        $payment->result['phone']=$_POST['phone'];
    }
    if(isset($_POST['city'])){
        $payment->result['city']=$_POST['city'];
    }
    if(isset($_POST['street'])){
        $payment->result['street']=$_POST['street'];
    }
    if(isset($_POST['building'])){
        $payment->result['building']=$_POST['building'];
    }
    if(isset($_POST['suite'])){
        $payment->result['suite']=$_POST['suite'];
    }
    if(isset($_POST['flat'])){
        $payment->result['flat']=$_POST['flat'];
    }
    if(isset($_POST['zip'])){
        $payment->result['zip']=$_POST['zip'];
    }
    $payment->putOne();
}elseif(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10){
    if(!$appRJ->server['reqUri_expl'][2]){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/payments/views/defaultView.php");
    }elseif (isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]=="search"){
        echo "zzz";
        exit;
    }
}