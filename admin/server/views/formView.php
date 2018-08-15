<?php
$appRJ->response['result'].= "<form class='serverOptions'><h2>Настройки:</h2>".
    "<input type='hidden' name='saveFlag' value='y'><div class='lineBlock'>".
    "<label for='CONN_LOC'>CONN_LOC:</label>".
    "<input type='text' name='CONN_LOC' value='".$DB->connSettings['CONN_LOC']."' ".$formInputEnbl."></div>".
    "<div class='lineBlock'><label for='CONN_USER'>CONN_USER:</label>".
    "<input type='text' name='CONN_USER' value='".$DB->connSettings['CONN_USER']."' ".$formInputEnbl."></div>".
    "<div class='lineBlock'><label for='CONN_PW'>CONN_PW:</label>".
    "<input type='text' name='CONN_PW' value='".$DB->connSettings['CONN_PW']."' ".$formInputEnbl."></div>".
    "<div class='lineBlock'><label for='CONN_DB'>CONN_DB:</label>".
    "<input type='text' name='CONN_DB' value='".$DB->connSettings['CONN_DB']."' ".$formInputEnbl."></div>".
    "<div class='feedback'>";
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
$appRJ->response['result'].= "</div></form>";