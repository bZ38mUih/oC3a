<?php
$appRJ->response['result'].= "<div class='contentMenu'>";
$appRJ->response['result'].= "<div class='contentMenu-links'>";
$appRJ->response['result'].= "<a href='/forum/forumManager/editSubject/?subj_id=".$_GET['subj_id']."'";
if(!$appRJ->server['reqUri_expl'][4]){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Карт.-Назв.</a>";
$appRJ->response['result'].= "<a href='/forum/forumManager/editSubject/descr?subj_id=".$_GET['subj_id']."' ";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='descr'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Описание</a>";

$appRJ->response['result'].= "<a href='/forum/forumManager/editSubject/images?subj_id=".$_GET['subj_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='images'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Картинки</a>";

$appRJ->response['result'].= "<a href='/forum/forumManager/editSubject/access?subj_id=".$_GET['subj_id']."'";
if(isset($appRJ->server['reqUri_expl'][4]) and strtolower($appRJ->server['reqUri_expl'][4])=='access'){
    $appRJ->response['result'].= " class='active'";
}
$appRJ->response['result'].= ">Доступы</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentMenu-img'>";
if($Subj_rd->result['subjImg']){
    $appRJ->response['result'].= "<img src='".FORUM_SUBJ_IMG_PAPH.$_GET['subj_id']."/preview/".$Subj_rd->result['subjImg']."'>";
    $delImgBtn_text= "class='active'";
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "<span>".$Subj_rd->result['subjName']."</span>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";