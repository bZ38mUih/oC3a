<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/source/_conf/ym.php");
$payment = array("table" => "payments_dt", "field_id" => "payment_id");
if(isset($_POST['label'])){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/payments/actions/putPayment.php");
}elseif($_GET["searchPayment"] and $_GET["searchPayment"]!=null){
    require_once($_SERVER["DOCUMENT_ROOT"]."/site/payments/views/searchPayment.php");
}elseif($_SESSION["bucket"]["order_id"]){
    $Order_rd = array("table" => "ordersList_dt", "field_id" => "order_id");
    $Order_rd['result']["order_id"]=$_SESSION["bucket"]["order_id"];
    if($Order_rd = $DB->copyOne($Order_rd)){
        unset($_SESSION["bucket"]);
        header("Location: /payments/?searchPayment=".$Order_rd['result']["label"]);
    }else{
        $appRJ->errors['XXX']['description']="Недопустимый id заказа - ".$_SESSION["bucket"]["order_id"];
        unset($_SESSION["bucket"]);
    }
}elseif($_SESSION["donate"]["order_id"]){
    $Order_rd = array("table" => "ordersList_dt", "field_id" => "order_id");
    $Order_rd['result']["order_id"]=$_SESSION["donate"]["order_id"];
    if($Order_rd = $DB->copyOne($Order_rd)){
        unset($_SESSION["donate"]);
        header("Location: /payments/?searchPayment=".$Order_rd['result']["label"]);
    }else{
        $appRJ->errors['XXX']['description']="Недопустимый id заказа - ".$_SESSION["donate"]["order_id"];
        unset($_SESSION["donate"]);
    }
}
elseif(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10){
    if($appRJ->server['reqUri_expl'][2] and $appRJ->server['reqUri_expl'][2]=="list") {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/payments/views/defaultView.php");
    }
}else{
    $appRJ->errors['404']["description"]="страница не найдена";
}