<?php
$delImg['result'] = false;
$delImg['data'] = null;
$Alb_rd = new recordDefault("galleryAlb_dt", "album_id");
$Alb_rd->result['album_id']=$_GET['delAlbImg'];
if($Alb_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/".$Alb_rd->result['albumImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].GL_ALBUM_IMG_PAPH.$Alb_rd->result['album_id']."/preview/".$Alb_rd->result['albumImg']);
    $Alb_rd->result['albumImg']=null;
    if($Alb_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса album_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;