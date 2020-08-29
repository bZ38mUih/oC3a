<?php
$delImg['result'] = false;
$delImg['data'] = null;
$Card_rd = new recordDefault("srvCards_dt", "card_id");
$Card_rd['result']['card_id']=$_GET['delCardImg'];
if($Card_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/".
        $Card_rd['result']['cardImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id'].
        "/preview/".$Card_rd['result']['card_id']);
    $Card_rd['result']['cardImg']=null;
    if($Card_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса card_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;