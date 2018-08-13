<?php
$appRJ->response['result'].= "<div class='signIn-frame'>";

$appRJ->response['result'].= "<div class='signIn-menu'>";

$appRJ->response['result'].= "<a href='/checkIn'>Регистрация</a>";
if($method === 'site'){
    $appRJ->response['result'].= "<a href='#social' id='social' onclick='showGate(this.id)'>Соц. сети</a>";
    $appRJ->response['result'].= "<a href='#site' class='active' id='site' onclick='showGate(this.id)'>Сайт</a>";
}else{
    $appRJ->response['result'].= "<a href='#social'  class='active' id='social' onclick='showGate(this.id)'>Соц. сети</a>";
    //$appRJ->response['result'].= "<a href='/checkIn'>Регистрация</a>";
    $appRJ->response['result'].= "<a href='#site' id='site' onclick='showGate(this.id)'>Сайт</a>";
}


$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='signIn-gate'>";

if($method === 'site'){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/signIn_form.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/socialView.php");
}


$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";