<?php
$appRJ->response['result'].= "<div class='contentMenu'><div class='contentMenu-links'>".
    "<a href='/services/srvMan/editCard/?card_id=".$_GET['card_id']."'";
if(!$appRJ->server['reqUri_expl'][4]){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Карт.-Назв.</a>".
    "<a href='/services/srvMan/editCard/longDescr?card_id=".$_GET['card_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='longDescr'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Дл. описание</a>".
    /*
    "<a href='/gallery/glManager/editAlbum/access?alb_id=".$_GET['alb_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='access'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Доступы</a>".*/
    "<a href='/services/srvMan/editCard/remove?card_id=".$_GET['cadr_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='remove'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Удаление</a></div><div class='contentMenu-img'>";
if($Card_rd->result['cardImg']){
    $appRJ->response['result'].= "<img src='".SRV_CARD_IMG_PAPH.$_GET['card_id']."/preview/".$Card_rd->result['cardImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "<span>".$Card_rd->result['cardName']."</span></div></div>";