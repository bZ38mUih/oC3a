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
    $slCm_qry = "select * from refCom_dt ".
        "INNER JOIN accounts_dt ON accounts_dt.user_id=refCom_dt.user_id ".
        "WHERE refCom_dt.comPar_id IS NULL and refCom_dt.activeFlag is TRUE ".
        "ORDER BY refCom_dt.writeDate DESC limit 3";
    $slCm_res = $DB->query($slCm_qry);
    $tmpRes['text'].= "<ul>";
    while ($slCm_row = $slCm_res->fetch(PDO::FETCH_ASSOC)){
        $tmpCm=null;
        $tmpCm.="<li><div class='com-line'><div class='com-img'>";
        if($slCm_row['photoLink']){
            if($slCm_row['netWork']=='site'){
                $tmpCm.= "<img src='".PP_USR_IMG_PAPH.$slCm_row['account_id']."/preview/".
                    $slCm_row['photoLink']."'>";
            }else{
                $tmpCm.= "<img src='".$slCm_row['photoLink']."'>";
            }
        }else{
            $tmpCm.= "<img src='/data/avatar-default.jpg'>";
        }
        $tmpCm.="</div><div class='com-info'><div class='com-alias'>";
        if(isset($_SESSION['user_id'])){
            if($slCm_row['socProf']){
                $tmpCm.="<a href='".$slCm_row['socProf']."' target='_blank'>".$slCm_row['accAlias']."</a>";
            }else{
                $tmpCm.=$slCm_row['accAlias'];
            }
        }else{
            $tmpCm.=$slCm_row['accAlias'];
        }
        $tmpCm.="</div><div class='com-date'>".$slCm_row['writeDate']."</div>".
            "<div class='com-content-frame'><div class='com-content'>".$slCm_row['Content'].
            "</div></div><div class='com-lv'>";
        //if($_SESSION['user_id']){
        //    $tmpCm.="<span class='com-wrCm' id='com_".$slCm_row['com_id']."' onclick='newAnsw(".$slCm_row['com_id'].")'>Ответить</span>";
        //}
        $tmpCm.="</div></div></div>";
        $tmpRes['text'].=$tmpCm;
        $tmpRes['text'].="</li>";
    }
    $tmpRes['text'].= "</ul>";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/views/defaultView.php");
}
else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}

