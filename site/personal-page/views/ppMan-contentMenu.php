<?php
$appRJ->response['result'].= "<div class='contentMenu'>";
$appRJ->response['result'].= "<div class='contentMenu-links'>";
$appRJ->response['result'].= "<a href='/personal-page/ppManager/editUser/?user_id=".$_GET['user_id']."' ";
if(!$appRJ->server['reqUri_expl'][4]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Статистика</a>";
$appRJ->response['result'].= "<a href='/personal-page/ppManager/editUser/notification/?user_id=".$_GET['user_id']."' ";
if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] === 'notification'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Оповещения</a>";

$appRJ->response['result'].= "<a href='/personal-page/ppManager/editUser/accounts/?user_id=".$_GET['user_id']."' ";
if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] === 'accounts'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Аккаунты</a>";

$appRJ->response['result'].= "<a href='/personal-page/ppManager/editUser/groups/?user_id=".$_GET['user_id']."' ";
if(isset($appRJ->server['reqUri_expl'][4]) and $appRJ->server['reqUri_expl'][4] === 'groups'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Группы</a>";
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='contentMenu-img'>";
if($slUsr_row['photoLink']){
    if($slUsr_row['netWork']=='site'){
        $appRJ->response['result'].= "<img src='".PP_USR_IMG_PAPH.$slUsr_row['user_id']."/preview/".$slUsr_row['photoLink']."'>";
    }else{
        $appRJ->response['result'].= "<img src='".$slUsr_row['photoLink']."'>";
    }
}else{
    $appRJ->response['result'].= "<img src='/data/default-img.png'>";
}
$appRJ->response['result'].= "<span>".$slUsr_row['accAlias']."</span>";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";