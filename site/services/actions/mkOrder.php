<?php
if($_SESSION['bucket']['total']!=$_GET['sum']){
    $mkOrder_err.="недопустимое значение sum-2;<br>";
}

if($mkOrder_err==null) {
    $_SESSION["bucket"]["order_id"] = $Order_rd->result['order_id'];
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
    $appRJ->response['result']="yes";
}else{
    unset($_SESSION["bucket"]);
    $appRJ->response['result']="Order err:".$mkOrder_err;
}

