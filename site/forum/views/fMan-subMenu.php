<?php
$appRJ->response['result'].= "<div class='subMenu'><a href='/forum/forumManager/' ";
if(!$appRJ->server['reqUri_expl'][3]){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Меню</a>".
    "<a href='/forum/forumManager/subjects/' ";
if(isset($appRJ->server['reqUri_expl'][3]) and $appRJ->server['reqUri_expl'][3] === 'subjects'){
    $appRJ->response['result'].= "class='active'";
}
$appRJ->response['result'].= ">Темы</a></div>";