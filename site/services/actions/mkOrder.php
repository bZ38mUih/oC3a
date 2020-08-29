<?php
if($_SESSION['bucket']['total']!=$_GET['sum']){
    $mkOrder_err.="недопустимое значение sum-2;";
}
if($_SESSION['bucket']['discont']){
    $Order_rd['result']['discont']=$_SESSION['bucket']['discont'];
}else{
    $Order_rd['result']['discont']=1000;
}
if($mkOrder_err==null) {
    if($_SESSION["bucket"]["order_id"]){
        $rmBucket_qry="delete from ordersBucket_dt WHERE order_id=".$_SESSION["bucket"]["order_id"];
        $DB->query($rmBucket_qry);
        $Order_rd ['result']['order_id']=$_SESSION["bucket"]["order_id"];
        $Order_rd->updateOne();
    }else{
        $Order_rd->putOne();
        $_SESSION["bucket"]["order_id"]=$Order_rd ['result']['order_id'];
    }
    $cards_cnt=0;
    foreach ($_SESSION['bucket']['prod'] as $key=>$val){
        $OrdBucket_rd = array("table" => "ordersBucket_dt", "field_id" => "bucket_id");
        $OrdBucket_rd['result']['order_id']=$Order_rd['result']["order_id"];
        $OrdBucket_rd['result']['card_id']=$key;
        $OrdBucket_rd['result']['bucketPrice']=$val;
        $OrdBucket_rd->putOne();
        $cards_cnt++;
    }
    if($cards_cnt=0){
        $mkBucket="нет никаких заказов<br>";
        $Order_rd->removeOne();
        unset($_SESSION["bucket"]);
        $appRJ->response['result']="Bucket err:".$mkBucket;
    }else{
        $appRJ->response['result']="yes";
    }
}else{
    $appRJ->response['result']="Order err:".$mkOrder_err;
}

