<?php
$glPhoto = new recordDefault("galleryPhotos_dt", "photo_id");
$glPhoto->result['photo_id']=$_POST['photo_id'];
if($glPhoto->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto->result['album_id']."/photoAttach/".
        $glPhoto->result['photoLink']);
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$glPhoto->result['album_id']."/photoAttach/preview/".
        $glPhoto->result['photoLink']);
    if($glPhoto->removeOne()){
        $appRJ->response['result'].= "<div class='results success'>deleted SUCCESS</div>";
    }else{
        $appRJ->response['result'].= "<div class='results fail'>Updated FAIL</div>";
    }
}else{
    $appRJ->response['result'].= "<div class='results fail'>неправильные параметры запроса album_id</div>";
}