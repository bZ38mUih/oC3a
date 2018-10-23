<?php
$appRJ->response['result'].= "<div class='wi-menu'><a href='/win-pc-info' ";
if(!$appRJ->server['reqUri_expl'][2]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/choice.jpg'>Выбор</a>".
    "<a href='/win-pc-info/environment' ";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'environment'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/env.png'>Окружение</a>".
    "<a href='/win-pc-info/hardware' ";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'hardware'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/hardware.png'>Аппаратура</a>".
"<a href='/win-pc-info/process'";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'process'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/process.png'>Процессы</a>".
"<a href='/win-pc-info/services'";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'services'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/services.png'>Службы</a>".
    "<a href='/win-pc-info/compare'";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'compare'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/compare.png'>Сравнить</a>".
"</div>";