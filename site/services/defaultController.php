<?php
define(SRV_CAT_IMG_PAPH, "/data/services/categs/");
define(SRV_CARD_IMG_PAPH, "/data/services/cards/");
if($_GET['addBucket']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/addBucket.php");
}elseif ($_GET['rmBucket']){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/actions/rmBucket.php");
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

