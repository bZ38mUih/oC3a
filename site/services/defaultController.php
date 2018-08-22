<?php
define(SRV_CAT_IMG_PAPH, "/data/services/categs/");
define(SRV_CARD_IMG_PAPH, "/data/services/cards/");
if($_GET['addBucket']){
    $addBucket=new recordDefault("srvCards_dt", "card_id");
    $addBucket->result['card_id']=$_GET['addBucket'];
    if($addBucket->copyOne()){
        $_SESSION['bucket']['prod'][$addBucket->result['card_id']]=$addBucket->result['cardPrice'];
    }
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/bucketCount.php");
}elseif ($_GET['rmBucket']){
    unset($_SESSION['bucket']['prod'][$_GET['rmBucket']]);
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/bucketCount.php");
}elseif ($_GET['receiver']){
    $Order_rd = new recordDefault("ordersList_dt", "order_id");
    if($_SESSION["bucket"]["order_id"]){
        $rmBucket_qry="delete from ordersBucket_dt WHERE order_id=".$_SESSION["bucket"]["order_id"];
        $DB->doQuery($rmBucket_qry);
        $Order_rd ->result['order_id']=$_SESSION["bucket"]["order_id"];
    }
    $mkOrder_err=null;
    $mkBucket=null;
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/mkOrder.php");

    $appRJ->response['format']='ajax';
    $appRJ->response['result']="mkOrder=<br>".$mkOrder_err."mkBucket=<br>".$mkBucket;
}
elseif (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
    if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
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
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/views/defaultView.php");
    }
}else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}

