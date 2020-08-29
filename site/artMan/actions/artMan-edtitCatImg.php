<?php
$editImg['result'] = false;
$editImg['data'] = null;

$Cat_rd = new recordDefault("artCat_dt", "artCat_id");
$Cat_rd['result']['artCat_id']=$_POST['cat_id'];
if($Cat_rd->copyOne()){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Cat_rd['result']['catImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/".$Cat_rd['result']['catImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/preview/".$Cat_rd['result']['catImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Cat_rd['result']['catImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.
                $Cat_rd['result']['artCat_id']."/".$Cat_rd['result']['catImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/".$Cat_rd['result']['catImg'],
                    $_SERVER["DOCUMENT_ROOT"].ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/preview/".$Cat_rd['result']['catImg'], 600, 600);
                /*<--create preview*/
                if($Cat_rd->updateOne()){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".ART_CATEG_IMG_PAPH.$Cat_rd['result']['artCat_id']."/preview/".$Cat_rd['result']['catImg']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный cat_id 2";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;