<?php
$appRJ->response['result'].= "<div class='contentMenu'><div class='contentMenu-links'>".
    "<a href='/forum/forummanager/editSubject/?fs_id=".$_GET['fs_id']."'";
if(!$appRJ->server['reqUri_expl'][4]){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Карт.-Назв.</a>".
    "<a href='/forum/forummanager/editSubject/description?fs_id=".$_GET['fs_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='description'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Описание</a>".
    "<a href='/forum/forummanager/editSubject/photo?fs_id=".$_GET['fs_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='photo'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Фото</a>".
    "<a href='/forum/forummanager/editSubject/loc?fs_id=".$_GET['fs_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='loc'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Местоположение</a>".
    "<a href='/forum/forummanager/editSubject/access?fs_id=".$_GET['fs_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='access'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Доступы</a>".
    "<a href='/forum/forummanager/editSubject/remove?fs_id=".$_GET['fs_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='remove'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Удаление</a></div><div class='contentMenu-img'>";
if($Subj_rd->result['sImg']){
    $appRJ->response['result'].= "<img src='".F_SUBJ_IMG.$_GET['fs_id']."/preview/".$Subj_rd->result['sImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "<span>".$Subj_rd->result['sName']."</span></div></div>";