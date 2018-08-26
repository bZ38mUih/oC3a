<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/source/_conf/ym.php");
if ($_GET['receiver']){
    $Order_rd = new recordDefault("ordersList_dt", "order_id");
    $mkOrder_err=null;
    if($_SESSION["donate"]["order_id"]){
        $Order_rd->result['order_id']=$_SESSION["donate"]["order_id"];
    }
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/payments/actions/mkOrder.php");
    if($mkOrder_err==null) {
        $_SESSION["donate"]["order_id"] = $Order_rd->result['order_id'];
        $appRJ->response['result']="yes";
    }else{
        unset($_SESSION["donate"]);
        $appRJ->response['result']="Donate err:".$mkOrder_err;
    }
    $appRJ->response['format']='ajax';
}elseif (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/donate/views/defaultView.php");
}else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}


