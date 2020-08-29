<?php
$editImg['result'] = false;
$editImg['data'] = null;

$Art_rd = new recordDefault("art_dt", "art_id");
$Art_rd['result']['art_id']=$_POST['art_id'];
if($Art_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Art_rd['result']['artImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id']."/".$Art_rd['result']['artImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id']."/preview/".$Art_rd['result']['artImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Art_rd['result']['artImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.
                $Art_rd['result']['art_id']."/".$Art_rd['result']['artImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id']."/".$Art_rd['result']['artImg'],
                    $_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd['result']['art_id']."/preview/".$Art_rd['result']['artImg'], 300, 300);
                /*<--create preview*/
                if($Art_rd->updateOne()){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".ARTS_IMG_PAPH.$Art_rd['result']['art_id']."/preview/".$Art_rd['result']['artImg']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный art_id 2";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;