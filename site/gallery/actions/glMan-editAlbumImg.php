<?php
$editImg['result'] = false;
$editImg['data'] = null;

$Alb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");
$Alb_rd['result']['album_id']=$_POST['alb_id'];
if($Alb_rd = $DB->copyOne($Alb_rd)){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id'])) {
        mkdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/preview", 0777, true);
    }
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($Alb_rd['result']['albumImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/".$Alb_rd['result']['albumImg']);
                unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/preview/".$Alb_rd['result']['albumImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            $Alb_rd['result']['albumImg']=uniqid().".".$path_parts['extension'];
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.
                $Alb_rd['result']['album_id']."/".$Alb_rd['result']['albumImg'])) {
                /*create preview-->*/
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/".$Alb_rd['result']['albumImg'],
                    $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/preview/".$Alb_rd['result']['albumImg'], 600, 600);
                /*<--create preview*/
                if($DB->updateOne($Alb_rd)){
                    $Alb_rd['result']['album_id'] = $DB->lastInsertId();
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/preview/".$Alb_rd['result']['albumImg']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "неправильный subject_id 2";
}

$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;