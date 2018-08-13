<?php
//$testArr=null;
$payment = new recordDefault("payments_dt", "label");

if(isset($_POST['label'])){
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






}
/*
if(isset($_GET) and $_GET!=null){
    //echo "GET<br>";
    //print_r($_GET);
    //echo "<hr>";
    //$testArr=$_GET;
    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/site/payments/get_pay.txt", json_encode($_GET, true));

}

if(isset($_POST) and $_POST!=null){
    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/site/payments/post_pay.txt", json_encode($_POST, true));
}
*/

//exit;
//$appRJ->errors['stab']['description']='страница временно на реконструкции';
//$appRJ->response['result']=uniqid("", true);
/**
sw: nP79ETfWwaBJeyi/5IvBGeWY

 */
/*
Передаются по HTTP
notification_type	string	Для переводов из кошелька — p2p-incoming. Для переводов с произвольной карты — card-incoming.
operation_id	string	Идентификатор операции в истории счета получателя.
amount	amount	Сумма, которая зачислена на счет получателя.
withdraw_amount	amount	Сумма, которая списана со счета отправителя.
currency	string	Код валюты — всегда 643 (рубль РФ согласно ISO 4217).
datetime	datetime	Дата и время совершения перевода.
sender	string	Для переводов из кошелька — номер счета отправителя. Для переводов с произвольной карты — параметр содержит пустую строку.
codepro	boolean	Для переводов из кошелька — перевод защищен кодом протекции. Для переводов с произвольной карты — всегда false.
label	string	Метка платежа. Если ее нет, параметр содержит пустую строку.
sha1_hash	string	SHA-1 hash параметров уведомления.
unaccepted	boolean	Перевод еще не зачислен. Получателю нужно освободить место в кошельке или использовать код протекции (если codepro=true).
Передаются только по HTTPS
ФИО и контакты отправителя перевода (указывает отправитель, если не запрашивались, параметры содержат пустую строку)

lastname	string	Имя.
firstname	string	Фамилия.
fathersname	string	Отчество.
email	string	Адрес электронной почты отправителя перевода. Если email не запрашивался, параметр содержит пустую строку.
phone	string	Телефон отправителя перевода. Если телефон не запрашивался, параметр содержит пустую строку.
Адрес доставки (указывает отправитель, если адрес не запрашивался, параметры содержат пустую строку)

city	string	Город.
street	string	Улица.
building	string	Дом.
suite	string	Корпус.
flat	string	Квартира.
zip	string	Индекс.
*/