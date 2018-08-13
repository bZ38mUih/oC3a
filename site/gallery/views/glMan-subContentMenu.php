<?php
$appRJ->response['result'].= "<div class='contentMenu'>";
$appRJ->response['result'].= "<div class='contentMenu-links'>";
$appRJ->response['result'].= "<a href='/gallery/glManager/editAlbum/?alb_id=".$_GET['alb_id']."'";
if(!$appRJ->server['reqUri_expl'][4]){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Карт.-Назв.</a>";
/*
$appRJ->response['result'].= "<a href='/forum/forumManager/editSubject/descr?subj_id=".$_GET['subj_id']."' ";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='descr'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Описание</a>";
*/
$appRJ->response['result'].= "<a href='/gallery/glManager/editAlbum/photo?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='photo'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Фото</a>";

$appRJ->response['result'].= "<a href='/gallery/glManager/editAlbum/access?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='access'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Доступы</a>";

$appRJ->response['result'].= "<a href='/gallery/glManager/editAlbum/remove?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='remove'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Удаление</a>";

$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentMenu-img'>";
if($Alb_rd->result['albumImg']){
    $appRJ->response['result'].= "<img src='".GL_ALBUM_IMG_PAPH.$_GET['alb_id']."/preview/".$Alb_rd->result['albumImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "<span>".$Alb_rd->result['albumName']."</span>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";