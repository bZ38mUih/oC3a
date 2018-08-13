<?php
$appRJ->response['result'].= "<div class='contentMenu'>";
$appRJ->response['result'].= "<div class='contentMenu-links'>";
$appRJ->response['result'].= "<a href='/artMan/editArt/?art_id=".$_GET['art_id']."'";
if(!$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Карт.-Назв.</a>";
$appRJ->response['result'].= "<a href='/artMan/editArt/content?art_id=".$_GET['art_id']."'";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=='content'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Содержание</a>";
$appRJ->response['result'].= "<a href='/artMan/editArt/ref?art_id=".$_GET['art_id']."'";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3]=='ref'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Ссылки</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentMenu-img'>";
if($Art_rd->result['artImg']){
    $appRJ->response['result'].= "<img src='".ARTS_IMG_PAPH.$_GET['art_id']."/preview/".$Art_rd->result['artImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "<span>".$Art_rd->result['artName']."</span>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "</div>";