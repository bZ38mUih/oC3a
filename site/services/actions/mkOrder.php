<?php
//$mrOrder_err=null;

if(isset($_GET['receiver']) and $_GET['receiver']!=null){
    $Order_rd->result['receiver']=$_GET['receiver'];
}else{
    $mkOrder_err.="недопустимое значение receiver;<br>";
}
if(isset($_GET['formcomment']) and $_GET['formcomment']!=null){
    $Order_rd->result['formcomment']=$_GET['formcomment'];
}else{
    $mkOrder_err.="недопустимое значение formcomment;<br>";
}
if(isset($_GET['short-dest']) and $_GET['short-dest']!=null){
    $Order_rd->result['shortDest']=$_GET['short-dest'];
}else{
    $mkOrder_err.="недопустимое значение shortDest;<br>";
}
if(isset($_GET['label']) and $_GET['label']!=null){
    $Order_rd->result['label']=$_GET['label'];
}else{
    $mkOrder_err.="недопустимое значение label;<br>";
}
if(isset($_GET['quickpay-form']) and $_GET['quickpay-form']!=null){
    $Order_rd->result['quickpayForm']=$_GET['quickpay-form'];
}else{
    $mkOrder_err.="недопустимое значение quickpayForm;<br>";
}
if(isset($_GET['targets']) and $_GET['targets']!=null){
    $Order_rd->result['targets']=$_GET['targets'];
}else{
    $mkOrder_err.="недопустимое значение targets;<br>";
}
if(isset($_GET['sum']) and $_GET['sum']!=null){
    $Order_rd->result['orderSum']=$_GET['sum'];
}else{
    $mkOrder_err.="недопустимое значение sum;<br>";
}
if($_SESSION['bucket']['total']!=$_GET['sum']){
    $mkOrder_err.="недопустимое значение sum-2;<br>";
}
if(isset($_GET['comment']) and $_GET['comment']!=null){
    $Order_rd->result['comment']=$_GET['comment'];
}
if(isset($_GET['need-fio']) and $_GET['need-fio']=='true'){
    $Order_rd->result['needFio']=true;
}else{
    $Order_rd->result['needFio']=false;
}
if(isset($_GET['need-email']) and $_GET['need-email']=='true'){
    $Order_rd->result['needEmai']=true;
}else{
    $Order_rd->result['needEmai']=false;
}
if(isset($_GET['need-phone']) and $_GET['need-phone']=='true'){
    $Order_rd->result['needPhone']=true;
}else{
    $Order_rd->result['needPhone']=false;
}
if(isset($_GET['need-address']) and $_GET['need-address']=='true'){
    $Order_rd->result['needAddress']=true;
}else{
    $Order_rd->result['needAddress']=false;
}
if(isset($_GET['paymentType']) and $_GET['paymentType']!=null){
    $Order_rd->result['paymentType']=$_GET['paymentType'];
}else{
    $mkOrder_err.="недопустимое значение paymentType;<br>";
}
$Order_rd->result['ordDate'].= date_format($appRJ->date['curDate'], 'Y-m-d H:i:s');
if($_SESSION['bucket']['discont']){
    $Order_rd->result['discont']=$_SESSION['bucket']['discont'];
}
if($_SESSION['user_id']){
    $Order_rd->result['user_id']=$_SESSION['user_id'];
}
if($mkOrder_err==null){
    if($Order_rd->result["order_id"]){
        $Order_rd->updateOne();
        $mkOrder_err="update order well";
    }else{
        $Order_rd->putOne();
        $_SESSION["bucket"]["order_id"]=$Order_rd->result['order_id'];
        $mkOrder_err="put order well";
    }
    $cards_cnt=0;
    foreach ($_SESSION['bucket']['prod'] as $key=>$val){
        $OrdBucket_rd=new recordDefault("ordersBucket_dt", "bucket_id");
        $OrdBucket_rd->result['order_id']=$Order_rd->result["order_id"];
        $OrdBucket_rd->result['card_id']=$key;
        $OrdBucket_rd->result['bucketPrice']=$val;
        $OrdBucket_rd->putOne();
        $cards_cnt++;
    }
    if($cards_cnt=0){
        $mkBucket="нет никаких заказов<br>";
        $OrdBucket_rd->removeOne();
        unset($_SESSION["bucket"]);
    }
}


