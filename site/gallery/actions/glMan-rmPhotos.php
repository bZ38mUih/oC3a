<?php
$rmPhotos_qry="select * from galleryPhotos_dt WHERE album_id = ".$Alb_rd->result['album_id'];
$rmPhotos_res=$DB->doQuery($rmPhotos_qry);
$glPhoto = new recordDefault("galleryPhotos_dt", "photo_id");
while ($rmPhotos_row=$DB->doFetchRow($rmPhotos_res)){
    $glPhoto->result['photo_id']=$rmPhotos_row['photo_id'];
    $glPhoto->copyOne();
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto->result['album_id']."/photoAttach/".
        $glPhoto->result['photoLink']);
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto->result['album_id']."/photoAttach/preview/".
        $glPhoto->result['photoLink']);
    $glPhoto->result['photoLink']=null;
    $glPhoto->removeOne();
}
if(file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach/preview")){
    if (!rmdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach/preview")){
        $appRJ->response['result'].="folder ".$_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id'].
            "/photoAttach/preview"." is not empty<br>";
    }
}

if(file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach")){
    if (!rmdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/photoAttach")){
        $appRJ->response['result'].="folder ".$_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id'].
            "/photoAttach"." is not empty<br>";
    }
}
