<?php
$appRJ->response['result'].= "<div class='contentMenu'><div class='contentMenu-links'>".
    "<a href='/gallery/glManager/editAlbum/?alb_id=".$_GET['alb_id']."'";
if(!$appRJ->server['reqUri_expl'][4]){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Карт.-Назв.</a>".
    "<a href='/gallery/glManager/editAlbum/photo?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='photo'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Фото</a>".
    "<a href='/gallery/glManager/editAlbum/video?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='video'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Видео</a>".
    "<a href='/gallery/glManager/editAlbum/access?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='access'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Доступы</a>".
    "<a href='/gallery/glManager/editAlbum/remove?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='remove'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Удаление</a></div><div class='contentMenu-img'>";
if($Alb_rd->result['albumImg']){
    $appRJ->response['result'].= "<img src='".GL_ALBUM_IMG_PAPH.$_GET['alb_id']."/preview/".$Alb_rd->result['albumImg']."' ";
    if($Alb_rd->result['transAlbImg']){
        $appRJ->response['result'].="style='transform: rotate(".$Alb_rd->result['transAlbImg']."deg)'";
    }
    $appRJ->response['result'].=">";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "<span>".$Alb_rd->result['albumName']."</span></div></div>";