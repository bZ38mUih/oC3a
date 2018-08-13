<?php

$appRJ->response['result'].= "<div class='subMenu'>";

$appRJ->response['result'].= "<a href='/downloads/dwlManager/' ";
if(!$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Категории</a>";
$appRJ->response['result'].= "<a href='/downloads/dwlManager/files/' ";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] === 'files'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Файлы</a>";

$appRJ->response['result'].= "</div>";