<?php
$appRJ->response['result'].= "<form class='wi-form'>";
if(!$appRJ->server['reqUri_expl'][2]) {
    $appRJ->response['result'] .= "<h3>Загрузите диагностический файл или воспользуйтсь поиском.</h3>";
}
$appRJ->response['result'].="<div class='input-line'>";
if(!$appRJ->server['reqUri_expl'][2]) {
    if($_SESSION['user_id']){
        $appRJ->response['result'].= "<label>Загрузите json-файл</label>".
            "<input type='file' onchange='loadDiagFile()' accept='application/JSON'>";
    }else{
        $appRJ->response['result'].= "<a href='/signIn' class='signIn'><img src='/site/signIn/img/logo.png'>Авторизуйтесь".
            " чтобы загрузить файл</a>";
    }
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='input-line'><label>";
if(!$appRJ->server['reqUri_expl'][2]){
    $appRJ->response['result'].="или воспользуйтесь поиском";
}elseif($appRJ->server['reqUri_expl'][2]=='process'){
    $appRJ->response['result'].="поиск процесса";
}elseif($appRJ->server['reqUri_expl'][2]=='environment'){
    $appRJ->response['result'].="поиск окружения";
}elseif($appRJ->server['reqUri_expl'][2]=='hardware'){
    $appRJ->response['result'].="поиск аппаратуры";
}elseif($appRJ->server['reqUri_expl'][2]=='services'){
    $appRJ->response['result'].="поиск служб";
}
$appRJ->response['result'].="</label><input type='text' name='tpSearch' value=''>".
    "<button onclick='wiSearch(".'"';
if(!$appRJ->server['reqUri_expl'][2]){
    $appRJ->response['result'].="wiFile";
}else{
    $appRJ->response['result'].=$appRJ->server['reqUri_expl'][2];
}
$appRJ->response['result'].='"'.")'><img src='/source/img/search-icon.png'></button></div>".
    "</form>";
