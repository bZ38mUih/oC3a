<?php
$delImg['result'] = false;
$delImg['data'] = null;

$Art_rd = new recordDefault("art_dt", "art_id");
$Art_rd->result['art_id']=$_GET['delArtImg'];
if($Art_rd->copyOne()){
    unlink ($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd->result['art_id']."/".$Art_rd->result['artImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].ARTS_IMG_PAPH.$Art_rd->result['art_id']."/preview/".$Art_rd->result['artImg']);
    $Art_rd->result['artImg']=null;
    if($Art_rd->updateOne()){
        $delImg['result'] = true;
        $delImg['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delImg['data'] = "обновление неудачно";
    }
}else{
    $delImg['data'] = "неправильные параметры запроса art_id";
}

$appRJ->response['format']='json';
$appRJ->response['result'] = $delImg;