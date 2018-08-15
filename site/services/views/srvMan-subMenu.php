<?php
$appRJ->response['result'].= "<div class='subMenu'>".
    "<a href='/services/srvMan/' ";
if(!$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Услуги</a>".
    "<a href='/services/srvMan/cats/' ";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] === 'cats'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Категории</a>".
    "</div>";