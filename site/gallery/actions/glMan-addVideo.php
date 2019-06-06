<?php

$editImg['result'] = false;
$editImg['data'] = null;
$Alb_rd = new recordDefault("galleryAlb_dt", "album_id");
$Alb_rd->result['album_id']=$_POST['fieldId'];
if($Alb_rd->copyOne()){
    $glVideo = new recordDefault("galleryVideo_dt", "video_id");
    //$path_parts = pathinfo(basename($file['name']));
    $glVideo->result['videoLink']=$_POST['videoName'];
    $glVideo->result['user_id']=$_SESSION['user_id'];
    $glVideo->result['uploadDate']=date_format($appRJ->date['curDate'], 'Y-m-d');
    $glVideo->result['album_id']=$Alb_rd->result['album_id'];
    if($glVideo->putOne()){
        $editImg['result'] = true;
        $editImg['data'][$glVideo->result['photo_id']]='добавлен';
    }else{
        $editImg['data'][$glVideo->result['photo_id']]='неудачно';
    }
}else{
    $editImg['data']['err'] = "неправильный album_id";
}
//$editImg['result'] = false;
//$editImg['data'] = 'xyi';
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-videoAttachForm.php");
