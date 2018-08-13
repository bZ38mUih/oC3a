<?php
$appRJ->response['result'].= "<div class='subMenu'>";


$appRJ->response['result'].= "<a href='/artMan/' ";
if(!$appRJ->server['reqUri_expl'][2]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Статьи</a>";

$appRJ->response['result'].= "<a href='/artMan/categories' ";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'categories'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Категории</a>";

$appRJ->response['result'].= "</div>";