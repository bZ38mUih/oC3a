<?php
$appRJ->response['result'].= "<div class='wi-menu'><a href='/win-pc-info' ";
if(!$appRJ->server['reqUri_expl'][2]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/choice.jpg'>Выбор</a>".
    "<a href='/win-pc-info/compare'";
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2] === 'compare'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= "><img src='/site/win-pc-info/img/compare.png'>Сравнить</a>".
"</div>";