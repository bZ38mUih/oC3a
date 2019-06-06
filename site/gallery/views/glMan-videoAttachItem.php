<?php
$appRJ->response['result'].= "<div class='photo-item'><div class='results'></div><div class='video-attach'>".
    "<video src='/data/gallery/video/".$itemsCount_row['videoLink']."' controls></video>";
    //"<a href='".GL_ALBUM_IMG_PAPH.$itemsCount_row['album_id']."/photoAttach/".$itemsCount_row['photoLink']."' blank>".
    //"<img src='".GL_ALBUM_IMG_PAPH.$itemsCount_row['album_id']."/photoAttach/preview/".$itemsCount_row['photoLink']."' ";
$appRJ->response['result'].="</div><div class='photo-control'>".
    "<span class='photoLink'>".$itemsCount_row['videoLink']."</span><label>Название:</label>".
    "<input type='text' value = '".$itemsCount_row['videoName']."'><label>Описание:</label>".
    "<input type='text' value = '".$itemsCount_row['videoDescr']."'><label>Дата:</label>".
    "<input type='date' value = '".$itemsCount_row['uploadDate']."'>".//"<label>Поворот:</label>".
    //"<input type='number' min='-180' max='180' value = '".$itemsCount_row['transPhoto']."'>".
    "<label>Показывать:</label><input type='checkbox' ";
if($itemsCount_row['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "><div class='btn-line'>";
$appRJ->response['result'].= "<input type='button' value='update' class='update' onclick='updVideoAttach(".
    $itemsCount_row['video_id'].", this)'>".
    "<input type='button' value='delete' class='delete' onclick='delVideoLink(".
    $itemsCount_row['video_id'].", this)'>";
$appRJ->response['result'].= "</div></div></div>";