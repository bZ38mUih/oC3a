<?php
$photo_qry = "select COUNT(photo_id) as photoCnt from galleryPhotos_dt ".
    "WHERE album_id=".$Alb_rd->result['album_id'];
$photo_res = $DB->doQuery($photo_qry);
$photo_row = $DB->doFetchRow($photo_res);
$like_qry = "select COUNT(galleryLike_dt.photo_id) as likeCnt from galleryLike_dt INNER JOIN galleryPhotos_dt ".
    "ON galleryLike_dt.photo_id = galleryPhotos_dt.photo_id WHERE galleryPhotos_dt.album_id=".$Alb_rd->result['album_id'];
$like_res = $DB->doQuery($like_qry);
$like_row = $DB->doFetchRow($like_res);
$appRJ->response['result'].= "<div class='remove-alb'>";
if($photo_row['photoCnt']>0){
    $appRJ->response['result'].= "невозможно удалить альбом, удалите сначала все фотографии";
}else{
    $appRJ->response['result'].="<div class='rm-act'><a href='#' onclick='removeAlbum(".$Alb_rd->result['album_id'].
        ")'><img src='/source/img/drop-icon.png'>Удалить обложку и запись</a></div>";
}
$appRJ->response['result'].= "</div>".
    "<div class='remove-photo'><div class='rm-cnt'>Кол-во фотографий: <span>".$photo_row['photoCnt']."</span></div>".
    "<div class='rm-act'>";
if($like_row['likeCnt']>0){
    $appRJ->response['result'].= "невозможно удалить фотографии, удалите сначала все лайки";
}else{
    if($photo_row['photoCnt']>0){
        $appRJ->response['result'].= "<a href='#' onclick='removePhotos(".$Alb_rd->result['album_id'].")'><img src='/source/img/clear-icon.png'>Удалить</a>";
    }
}
$appRJ->response['result'].= "</div></div>".
    "<div class='remove-like'><div class='rm-cnt'>Кол-во лайков: <span>".$like_row['likeCnt']."</span></div>".
    "<div class='rm-act'>";
if($like_row['likeCnt']>0){
    $appRJ->response['result'].= "<a href='#' onclick='removeLikes(".$Alb_rd->result['album_id'].")'><img src='/source/img/clear-icon.png'>Удалить лайки</a>";
}else{

}
$appRJ->response['result'].= "</div></div>";