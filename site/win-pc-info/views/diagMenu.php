<?php
$appRJ->response['result'].= "<div class='subMenu'><a href='/win-pc-info' ";
if(!$appRJ->server['reqUri_expl'][2]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Анализ</a>".
    "<a href='/win-pc-info/enviropment' ";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'enviropment'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">перОкруж</a>".
    "<a href='/win-pc-info/hardware' ";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'hardware'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Аппаратура</a>".
"<a href='/win-pc-info/process'";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'process'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Процессы</a>".
"<a href='/win-pc-info/services'";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'services'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Службы</a>".
"</div>";