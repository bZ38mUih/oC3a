<?php
$appRJ->response['result'].= "<div class='photo-item'><div class='results'></div><div class='photo-img'>".
    "<a href='".GL_ALBUM_IMG_PAPH.$itemsCount_row['album_id']."/photoAttach/".$itemsCount_row['photoLink']."' blank>".
    "<img src='".GL_ALBUM_IMG_PAPH.$itemsCount_row['album_id']."/photoAttach/preview/".$itemsCount_row['photoLink']."' ";
if($itemsCount_row['transPhoto']){
    $appRJ->response['result'].= "style='transform: rotate(".$itemsCount_row['transPhoto']."deg)'";
}
$appRJ->response['result'].="'></a></div><div class='photo-control'>".
    "<span class='photoLink'>".$itemsCount_row['photoLink']."</span><label>Название:</label>".
    "<input type='text' value = '".$itemsCount_row['photoName']."'><label>Описание:</label>".
    "<input type='text' value = '".$itemsCount_row['photoDescr']."'><label>Дата:</label>".
    "<input type='date' value = '".$itemsCount_row['uploadDate']."'><label>Поворот:</label>".
    "<input type='number' min='-180' max='180' value = '".$itemsCount_row['transPhoto']."'>".
    "<label>Показывать:</label><input type='checkbox' ";
if($itemsCount_row['activeFlag']){
    $appRJ->response['result'].= "checked";
}
$appRJ->response['result'].= "><div class='btn-line'>";
$appRJ->response['result'].= "<input type='button' value='update' class='update' onclick='updateAttach(".
    $itemsCount_row['photo_id'].", this)'>".
    "<input type='button' value='delete' class='delete' onclick='deleteAttach(".
    $itemsCount_row['photo_id'].", this)'>";
$appRJ->response['result'].= "</div>".
    "</div>".
    "<div class='photo-reAssignAlb'><select onchange='reAssignCateg(".$itemsCount_row['photo_id'].", this)'>".
    "<option value='void'>---</option>";
foreach ($categ_arr as $cat_id => $catName){
    $appRJ->response['result'].= "<option value='".$cat_id."'>".$catName."</option>";
}
$appRJ->response['result'].=    "</select>".
    "<select class='pick-reAssignAlb' diasbled><option></option></select>".
    "<div class='reAssignAlb-btn-line'>".
    "<div class='reAssignAlb-btn'>".
    "<a href='javaScript: void(0)' onclick='reAssignCancel(this)'>Cancel</a>".
    "</div>".
    "<div class='reAssignAlb-btn'>".
    "<a href='javaScript: void(0)' onclick='reAssignPhoto(".$itemsCount_row['photo_id'].", this)'>".
    "<img src='/source/img/sync-icon.png'>".
    " - reAssign</a>".
    "</div>".
    "</div>".
    "</div>".
    "</div>";