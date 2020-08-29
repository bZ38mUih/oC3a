<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/source/_conf/ym.php");
if($_GET['addBucket']){
    $addBucket = array("table" => "srvCards_dt", "field_id" => "card_id");
    $addBucket['result']['card_id']=$_GET['addBucket'];
    if($addBucket = $DB->copyOne($addBucket)){
        $_SESSION['bucket']['prod'][$addBucket['result']['card_id']]=$addBucket['result']['cardPrice'];
    }
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/bucketCount.php");
}elseif ($_GET['rmBucket']){
    unset($_SESSION['bucket']['prod'][$_GET['rmBucket']]);
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/bucketCount.php");
}elseif ($_GET['receiver']){
    $appRJ->response['format']='ajax';
    //$appRJ->response['result']="test";

    $Order_rd = array("table" => "ordersList_dt", "field_id" => "order_id");
    $mkOrder_err=null;
    $mkBucket=null;
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/payments/actions/mkOrder.php");
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/mkOrder.php");
}
elseif(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    if($appRJ->server['reqUri_expl'][2]=="detail"){
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/services/views/detailView.php");
    }
    elseif($appRJ->server['reqUri_expl'][2]=="mkOrder"){
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/services/views/mkOrder.php");
    }
    elseif($appRJ->server['reqUri_expl'][2]=="srvMan"){
        if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/services/srvManController.php");
        }else{
            $appRJ->errors['access']['description']="у вас нет прав доступа";
        }
    }
}
elseif(!$appRJ->server['reqUri_expl'][2]){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/views/defaultView.php");
}
else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}

