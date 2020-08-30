<?php

$editImg['result'] = false;
$editImg['data'] = null;

$Alb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");
$Alb_rd['result']['album_id']=$_POST['fieldId'];
if($Alb_rd = $DB->copyOne($Alb_rd)){
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id'])."/photoAttach") {
        mkdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id'], 0777, true);
    }
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach/preview")) {
        mkdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach/preview", 0777, true);
    }

    require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");

    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            $glPhoto = array("table" => "galleryPhotos_dt", "field_id" => "photo_id");
            $path_parts = pathinfo(basename($file['name']));
            $glPhoto['result']['photoLink']=uniqid().".".$path_parts['extension'];
            $glPhoto['result']['user_id']=$_SESSION['user_id'];
            $glPhoto['result']['uploadDate']=date_format($appRJ->date['curDate'], 'Y-m-d');
            $glPhoto['result']['album_id']=$Alb_rd['result']['album_id'];
            $glPhoto['result']['photoName'] =  $path_parts['basename'];

            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.
                $Alb_rd['result']['album_id']."/photoAttach/".$glPhoto['result']['photoLink'])) {
                /*create preview-->*/
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach/".$glPhoto['result']['photoLink'],
                    $_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach/preview/".$glPhoto['result']['photoLink'], 600, 600);
                /*<--create preview*/
                if($DB->putOne($glPhoto)){
                    $glPhoto['result'] = $DB->lastInsertId();
                    $editImg['result'] = true;
                    $editImg['data'][$glPhoto['result']['photo_id']]='добавлен';
                }else{
                    $editImg['data'][$glPhoto['result']['photo_id']]='неудачно';
                }
            } else {
                $editImg['data']['err']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data']['err'] = "неправильный album_id";
}
