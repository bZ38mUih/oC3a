<?php
$appRJ->response['result'].= "<div class='subMenu'>";

$appRJ->response['result'].= "<a href='/personal-page/' ";
if(!$appRJ->server['reqUri_expl'][2]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Оповещения</a>";
$appRJ->response['result'].= "<a href='/personal-page/settings/' ";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'settings'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Настройки</a>";

$appRJ->response['result'].= "</div>";