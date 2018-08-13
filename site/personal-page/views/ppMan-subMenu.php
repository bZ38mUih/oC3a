<?php
$appRJ->response['result'].= "<div class='subMenu'>";
$appRJ->response['result'].= "<a href='/personal-page/ppManager/' ";
if(!$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Пользователи</a>";

$appRJ->response['result'].= "<a href='/personal-page/ppManager/groups/' ";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] === 'groups'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Группы</a>";
$appRJ->response['result'].= "<a href='/personal-page/ppManager/notifications/' ";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] === 'notifications'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Оповещения</a>";
$appRJ->response['result'].= "</div>";