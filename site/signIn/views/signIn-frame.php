<?php
$appRJ->response['result'].= "<div class='signIn-frame'><div class='signIn-menu'>".
    "<a href='/checkIn' title='Создать аккаунт на RJ'>Регистрация</a>".
    "<a href='#social' ".$signInActiveSocial." id='social' onclick='showGate(this.id)' title='Вход через соцсети'>Соц. сети</a>".
    "<a href='#site' ".$signInActiveSite." id='site' onclick='showGate(this.id)' title='Вход через аккаунт на RJ'>Сайт</a>".
    "</div><div class='signIn-gate'>";
if($signInActiveSite){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/signIn_form.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/socialView.php");
}
$appRJ->response['result'].= "</div></div>";