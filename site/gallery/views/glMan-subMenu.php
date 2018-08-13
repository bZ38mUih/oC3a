<?php
$appRJ->response['result'].= "<div class='subMenu'>";
$appRJ->response['result'].= "<a href='/gallery/glManager/' ";
if(!$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Категории</a>";
$appRJ->response['result'].= "<a href='/gallery/glManager/albums/' ";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] === 'albums'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Альбомы</a>";
$appRJ->response['result'].= "<a href='/gallery/glManager/upload/' ";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] === 'upload'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Выгрузка</a>";

$appRJ->response['result'].= "</div>";