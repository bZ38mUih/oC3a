<?php
$delImg['result'] = false;
$delImg['data'] = null;

$Acc_rd = new recordDefault("accounts_dt", "account_id");
$Acc_rd->result['account_id']=$_GET['delAvatarImg'];
if($Acc_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd->result['account_id']."/".$Acc_rd->result['photoLink']);
    unlink ($_SERVER["DOCUMENT_ROOT"].PP_USR_IMG_PAPH.$Acc_rd->result['account_id']."/preview/".$Acc_rd->result['photoLink']);
    $Acc_rd->result['photoLink']=null;
    if($Acc_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса account_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;