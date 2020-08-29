<?php
$editImg['result'] = false;
$editImg['data'] = null;
$Card_rd = array("table" => "srvCards_dt", "field_id" => "card_id");
$Card_rd['result']['card_id']=$_POST['card_id'];
if($Card_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.
            $Card_rd['result']['card_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Card_rd['result']['cardImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/".
                    $Card_rd['result']['cardImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/preview/".
                    $Card_rd['result']['cardImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Card_rd['result']['cardImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.
                $Card_rd['result']['card_id']."/".$Card_rd['result']['cardImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/".$Card_rd['result']['cardImg'],
                    $_SERVER["DOCUMENT_ROOT"].SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/preview/".
                    $Card_rd['result']['cardImg'], 300, 300);
                /*<--create preview*/
                if($Card_rd->updateOne()){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".SRV_CARD_IMG_PAPH.$Card_rd['result']['card_id']."/preview/".
                        $Card_rd['result']['cardImg']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный card_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;