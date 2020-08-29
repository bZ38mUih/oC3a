<?php
$rmPhotos_res = $DB->query("select * from galleryPhotos_dt WHERE album_id = ".$Alb_rd['result']['album_id']);
$glPhoto = array("table" => "galleryPhotos_dt", "field_id" => "photo_id");
while ($rmPhotos_row = $rmPhotos_res->fetch(PDO::FETCH_ASSOC)){
    $glPhoto['result']['photo_id'] = $rmPhotos_row['photo_id'];
    $glPhoto = $DB->copyOne($glPhoto);
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto['result']['album_id']."/photoAttach/".
        $glPhoto['result']['photoLink']);
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto['result']['album_id']."/photoAttach/preview/".
        $glPhoto['result']['photoLink']);
    $glPhoto['result']['photoLink']=null;
    $DB->removeOne($glPhoto);
    //$glPhoto->removeOne();
}
if(file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach/preview")){
    if (!rmdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach/preview")){
        $appRJ->response['result'].="folder ".$_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id'].
            "/photoAttach/preview"." is not empty<br>";
    }
}

if(file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach")){
    if (!rmdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id']."/photoAttach")){
        $appRJ->response['result'].="folder ".$_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd['result']['album_id'].
            "/photoAttach"." is not empty<br>";
    }
}
