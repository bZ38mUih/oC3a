<?php
$delImg['result'] = false;
$delImg['data'] = null;
$Card_rd = array("table" => "srvCards_dt", "field_id" => "card_id");
$Card_rd['result']['card_id']=$_GET['delCardImg'];
if($Card_rd = $DB->copyOne($Card_rd)){
    unlink ($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/".
        $Card_rd['result']['cardImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id'].
        "/preview/".$Card_rd['result']['card_id']);
    $Card_rd['result']['cardImg']=null;
    if($DB->updateOne($Card_rd)){
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