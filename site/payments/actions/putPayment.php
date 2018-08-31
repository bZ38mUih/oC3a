<?php
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
$payment->result['label']=$_POST['label'];
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
$payment->copyOne();
$pay_str=$payment->result["notification_type"]."&".
    $payment->result["operation_id"]."&".
    $payment->result["amount"]."&".
    $payment->result["currency"]."&".
    $payment->result["datetime"]."&".
    $payment->result["sender"]."&";
if($payment->result['codepro']){
    $pay_str.="true";
}else{
    $pay_str.='false';
}
$pay_str.="&".$ym['secret']."&".$payment->result["label"];

if(hash_equals(sha1($pay_str), $payment->result['sha1_hash'])){
    $payment->result["hashEqual"]=true;
}

/*notification-->*/
$Ntf_rd->result['ntfType']='group';
$Ntf_rd->result['ntfSubscr']=1;
$ntfSubj=null;
if($payment->result['unaccepted']){
    $Ntf_rd->result['ntfDescr']="Не зачислено (освободите место)";
    $ntfSubj="rightjoint.ru - платеж не зачислен (недостаточно места в кошельке)";

}else{
    $Ntf_rd->result['ntfDescr']="Зачислено";
    $ntfSubj="rightjoint.ru - платеж зачислен";
}
$Ntf_rd->result['ntfDescr'].=" сумма платежа: ".$payment->result['amount'];
$Ntf_rd->result['ntfSubj']="Оплата yandex money";
$Ntf_rd->putOne();
if($payment->result['email']){
    mail($payment->result['email'], $ntfSubj, "Получить дополнительную информацию ".
        "о платеже вы можете по ссылке https://rightjoint.ru/payments/?searchPayment=".$payment->result['label'], 'From: RightJoint');
}
$payment->updateOne();
/*<--notification*/