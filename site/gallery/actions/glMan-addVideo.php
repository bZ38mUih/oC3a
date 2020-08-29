<?php

$editImg['result'] = false;
$editImg['data'] = null;
$Alb_rd = array("table" => "galleryAlb_dt", "field_id" => "album_id");
$Alb_rd['result']['album_id']=$_POST['fieldId'];
if($Alb_rd = $DB->copyOne($Alb_rd)){
    $glVideo = array("table" => "galleryVideo_dt", "field_id" => "video_id");
    $glVideo['result']['videoLink']=$_POST['videoName'];
    $glVideo['result']['user_id']=$_SESSION['user_id'];
    $glVideo['result']['uploadDate']=date_format($appRJ->date['curDate'], 'Y-m-d');
    $glVideo['result']['album_id']=$Alb_rd['result']['album_id'];
    if($DB->putOne($glVideo)){
        $glVideo['result']['photo_id'] = $DB->lastInsertId();
        $editImg['result'] = true;
        $editImg['data'][$glVideo['result']['photo_id']]='добавлен';
    }else{
        $editImg['data'][$glVideo['result']['photo_id']]='неудачно';
    }
}else{
    $editImg['data']['err'] = "неправильный album_id";
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/site/gallery/views/glMan-videoAttachForm.php");
