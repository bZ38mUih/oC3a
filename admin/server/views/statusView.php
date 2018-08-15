<?php
$appRJ->response['result'].= "<h2>Состояние:</h2><div class='lineBlock'>";
if($DB->connectServer()===true){
    $appRJ->response['result'].= "<span>Подключение к серверу:</span><span class='statusOk'>OK</span>";
}else{
    $appRJ->response['result'].= "<span>Подключение к серверу:</span><span class='statusFail'>FAIL</span>";
}
$appRJ->response['result'].= "</div><div class='lineBlock'>";
if($DB->connect_db()===true){
    $appRJ->response['result'].= "<span>Подключение к базе данных:</span><span class='statusOk'>OK</span>";
}else{
    $appRJ->response['result'].= "<span>Подключение к базе данных:</span><span class='statusFail'>FAIL</span>";
}
$appRJ->response['result'].= "</div>";