<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/source/_conf/ym.php");
$Order_rd = new recordDefault("ordersList_dt", "order_id");
if ($_GET['receiver']){
    $appRJ->response['format']='ajax';
    $mkOrder_err=null;
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/payments/actions/mkOrder.php");
    $Order_rd->result['discont']=0;
    if($mkOrder_err==null) {
        if ($_SESSION["donate"]["order_id"]) {
            $Order_rd->result['order_id'] = $_SESSION["donate"]["order_id"];
            $Order_rd->updateOne();
        } else {
            $Order_rd->putOne();
            $_SESSION["donate"]["order_id"]=$Order_rd->result['order_id'];
        }
        $appRJ->response['result']="yes";
    }else{
        unset($_SESSION["donate"]);
        $appRJ->response['result']="Donate err:".$mkOrder_err;
    }
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/donate/views/defaultView.php");
}


