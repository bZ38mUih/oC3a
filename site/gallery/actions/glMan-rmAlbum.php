<?php
$rmPrev=false;
$rmAlb=false;
$rmRes=false;

if($Alb_rd->result['albumImg']){
    unlink($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.
        $Alb_rd->result['album_id']."/".$Alb_rd->result['albumImg']);

    unlink($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id'].
        "/preview/".$Alb_rd->result['albumImg']);
}

if(file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id'])){
    if(file_exists($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/preview")){
        if (!rmdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/preview")) {
            $appRJ->response['result'].="folder ".$_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/preview"." is not empty<br>";
        }
    }
    if (!rmdir($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id'])) {
        $appRJ->response['result'].="folder ".$_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']." is not empty<br>";
    }else{
        $rmRes=true;
    }
}else{
    $rmRes=true;
}



