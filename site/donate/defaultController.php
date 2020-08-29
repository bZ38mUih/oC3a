<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/source/_conf/ym.php");
$Order_rd = array("table" => "ordersList_dt", "field_id" => "order_id");
if ($_GET['receiver']){
    $appRJ->response['format']='ajax';
    $mkOrder_err=null;
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/payments/actions/mkOrder.php");
    $Order_rd['result']['discont']=0;
    if($mkOrder_err==null) {
        if ($_SESSION["donate"]["order_id"]) {
            $Order_rd['result']['order_id'] = $_SESSION["donate"]["order_id"];
            $DB->updateOne($Order_rd);
        } else {
            $DB->putOne($Order_rd);
            $_SESSION["donate"]["order_id"]=$DB->lastInsertId();
        }
        $appRJ->response['result']="yes";
    }else{
        unset($_SESSION["donate"]);
        $appRJ->response['result']="Donate err:".$mkOrder_err;
    }
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/donate/views/defaultView.php");
}


