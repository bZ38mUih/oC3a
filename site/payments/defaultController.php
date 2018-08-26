<?php
$payment = new recordDefault("payments_dt", "payment_id");

if(isset($_POST['label'])){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/payments/actions/putPayment.php");
}elseif($_GET["searchPayment"] and $_GET["searchPayment"]!=null){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/payments/views/searchPayment.php");
    //$Order_rd=new recordDefault("ordersList_dt", "order_id");

    //$Order_rd->result["label"]
}
elseif(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10){
    if($appRJ->server['reqUri_expl'][3]){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/payments/views/defaultView.php");
    }
    elseif($_SESSION["bucket"]["order_id"]){
        $Order_rd = new recordDefault("ordersList_dt", "order_id");
        $Order_rd->result["order_id"]=$_SESSION["bucket"]["order_id"];
        //unset($_SESSION["bucket"]);
        if($Order_rd->copyOne()){
            header("Location: /payments/?searchPayment=".$Order_rd->result["label"]);
        }else{
            $appRJ->errors['XXX']['description']="Недопустимый id заказа - ".$_SESSION["bucket"]["order_id"];
        }
    }elseif($_SESSION["donate"]["order_id"]){
        $Order_rd = new recordDefault("ordersList_dt", "order_id");
        $Order_rd->result["order_id"]=$_SESSION["donate"]["order_id"];
        //unset($_SESSION["donate"]);
        if($Order_rd->copyOne()){
            header("Location: /payments/?searchPayment=".$Order_rd->result["label"]);
        }else{
            $appRJ->errors['XXX']['description']="Недопустимый id заказа - ".$_SESSION["donate"]["order_id"];
        }
    }
}