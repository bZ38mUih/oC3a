<?php
$appRJ->response['result'].= "<h2>Состояние:</h2><div class='lineBlock'>";
if($connResult==true){
    $appRJ->response['result'].= "<span>Подключение к SQL - базе данных:</span><span class='statusOk'>OK</span>";
}else{
    $appRJ->response['result'].= "<span>Проблемы подключения к SQL - базе данных:</span><span class='statusFail'>FAIL</span>".
    "<p>Некоторая отладочная информация: <br>".$connErr."</p>";
}
$appRJ->response['result'].= "</div>";