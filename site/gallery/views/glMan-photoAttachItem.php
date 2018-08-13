<?php
$appRJ->response['result'].= "<div class='photo-item'>";
$appRJ->response['result'].= "<div class='results'>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='photo-img'>";
$appRJ->response['result'].= "<a href='".GL_ALBUM_IMG_PAPH.$itemsCount_row['album_id']."/photoAttach/".$itemsCount_row['photoLink']."' blank>";
$appRJ->response['result'].= "<img src='".GL_ALBUM_IMG_PAPH.$itemsCount_row['album_id']."/photoAttach/preview/".
    $itemsCount_row['photoLink']."' ";
if($itemsCount_row['transPhoto']){
    $appRJ->response['result'].= "style='transform: rotate(".$itemsCount_row['transPhoto']."deg)'";
}
$appRJ->response['result'].="'>";
$appRJ->response['result'].= "</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='photo-control'>";
//$appRJ->response['result'].= "<input type='hidden' value='".."'>";
$appRJ->response['result'].= "<span class='photoLink'>".$itemsCount_row['photoLink']."</span>";
$appRJ->response['result'].= "<label>Название:</label>";
$appRJ->response['result'].= "<input type='text' value = '".$itemsCount_row['photoName']."'>";
$appRJ->response['result'].= "<label>Описание:</label>";
$appRJ->response['result'].= "<input type='text' value = '".$itemsCount_row['photoDescr']."'>";
$appRJ->response['result'].= "<label>Дата:</label>";
$appRJ->response['result'].= "<input type='date' value = '".$itemsCount_row['uploadDate']."'>";
$appRJ->response['result'].= "<label>Поворот:</label>";
$appRJ->response['result'].= "<input type='number' min='-180' max='180' value = '".$itemsCount_row['transPhoto']."'>";
$appRJ->response['result'].= "<label>Показывать:</label>";
$appRJ->response['result'].= "<input type='checkbox' ";
if($itemsCount_row['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= ">";
//print_r($itemsCount_row);
$appRJ->response['result'].= "<div class='btn-line'>";
$appRJ->response['result'].= "<input type='button' value='update' class='update' onclick='updateAttach(".$itemsCount_row['photo_id'].", this)'>";
$appRJ->response['result'].= "<input type='button' value='delete' class='delete' onclick='deleteAttach(".$itemsCount_row['photo_id'].", this)'>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";