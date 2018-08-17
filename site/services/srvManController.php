<?php
if (isset($_POST['flagField']) and $_POST['flagField'] == 'newCat') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-newCat.php");
} elseif (isset($_POST['flagField']) and $_POST['flagField'] == 'editCat') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-editCat.php");
}elseif (isset($_POST['cat_id']) and $_POST['cat_id'] !== null) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-editCatImg.php");
}elseif (isset($_GET['delCatImg']) and $_GET['delCatImg'] != null) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-delCatImg.php");
}
elseif(isset($_POST['flagField']) and $_POST['flagField']=='newCard'){
    require_once($_SERVER['DOCUMENT_ROOT']."/site/services/actions/srvMan-newCard.php");
}elseif(isset($_POST['card_id']) and $_POST['card_id']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-editCardImg.php");
}elseif (isset($_GET['delCardImg']) and $_GET['delCardImg'] != null) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/actions/srvMan-delCardImg.php");
}
elseif(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=="cards") {
    if (!$appRJ->server['reqUri_expl'][4]) {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-Cards.php");
    } else {
        $cardErr = null;
        $Card_rd = new recordDefault("srvCards_dt", "card_id");
        if ($appRJ->server['reqUri_expl'][4] and $appRJ->server['reqUri_expl'][4] == 'newService') {
            require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-newService.php");
        } elseif($appRJ->server['reqUri_expl'][4] and $appRJ->server['reqUri_expl'][4] == 'editCard') {
            if (isset($_GET['card_id']) and $_GET['card_id'] != null) {
                $Card_rd->result['card_id'] = $_GET['card_id'];
                if ($Card_rd->copyOne()) {
                    if(isset($_POST['flagField']) and $_POST['flagField']=='editCard'){
                        require_once($_SERVER['DOCUMENT_ROOT']."/site/services/actions/srvMan-editCard.php");
                    }else{
                        require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-editCard.php");
                    }
                }
            } else {
                $appRJ->errors['404']['description'] = 'неправильные параметры запроса card_id';
            }
        }else{
            $appRJ->errors['404']['description'] = 'неправильные параметры запроса card_id NULL';
        }
    }
}elseif(isset($appRJ->server['reqUri_expl'][3]) and strtolower($appRJ->server['reqUri_expl'][3])=="cats"){
    if(!$appRJ->server['reqUri_expl'][4]){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/services/views/srvMan-Cat.php");
    }elseif ($appRJ->server['reqUri_expl'][4]=='newCat'){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/services/views/srvMan-newCat.php");
    }elseif ($appRJ->server['reqUri_expl'][4]=='editCat'){
        $catErr=null;
        $catSelectOptions=null;
        if(isset($_GET['cat_id']) and $_GET['cat_id']!=null){
            $Cat_rd = new recordDefault("srvCat_dt", "srvCat_id");
            $Cat_rd->result['srvCat_id']=$_GET['cat_id'];
            if($Cat_rd->copyOne()){
                require_once ($_SERVER['DOCUMENT_ROOT']."/site/services/views/srvMan-editCat.php");
            }else{
                $appRJ->response['result'].= "неправильные параметры запроса cat_id";
            }
        }else{
            $appRJ->errors['404']['description']='неправильные параметры запроса cat_id NULL';
        }

    }
}else{
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/services/views/srvMan-defView.php");
}