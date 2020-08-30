<?php
$appRJ->response['result'].= "<form class='serverOptions'><h2>Настройки:</h2>".
    "<input type='hidden' name='saveFlag' value='y'>";
foreach ($DB->connSettings as $opt => $oVal){
    $appRJ->response['result'].= "<div class='lineBlock'>".
        "<label for='CONN_LOC'>".$opt.":</label>".
        "<input type='text' name='".$opt."' value='".$oVal."' ".$formInputEnbl."></div>";
}
$appRJ->response['result'].= "<div class='feedback'>";
if(isset($svContErr) and $svContErr!=null){
    foreach($svContErr as $key=>$value){
        $appRJ->response['result'].= $key." : ".$value."<br>";
    }
}
$appRJ->response['result'].= "</div><div class='lineBlock right'>";
if($formInputEnbl==null){
    $appRJ->response['result'].= "<input type='button' name='saveCon' class='active' value='Сохранить' onclick='saveConn()'>".
    "<input type='button' name='cancelConn' class='active' value='Отменить' onclick='cancel_Conn()'>".
        "<input type='button' name='editConn' value='Изменить' onclick='activateInputs()'>";
}else{
    $appRJ->response['result'].= "<input type='button' name='saveCon' value='Сохранить' onclick='saveConn()'>".
        "<input type='button' name='cancelConn' value='Отменить' onclick='cancel_Conn()'>".
        "<input type='button' class='active' name='editConn' value='Изменить' onclick='activateInputs()'>";
}
$appRJ->response['result'].= "</div>";

if(!$accessFile){
    $appRJ->response['result'].= "<div class='feedback'>Проблема с доступом к файлу настроек БД<br>".$pathToConn."</div>";
}

$appRJ->response['result'].= "</form>";