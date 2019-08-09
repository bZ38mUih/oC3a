<?php
$appRJ->response['result'].= "<div class = 'auth-ref-wrap'><div class='auth-stat'>ad here</div>";
if(!isset($_SESSION['user_id'])){
    $appRJ->response['result'].= "<div class='auth-ref-animate-wrap'>".
        "<div class='auth-ref-animate'>".
        "<a class='signIn' href='/signIn'>".
        "<span></span>
        <span></span>
        <span></span>
        <span></span>".
        "<div class='signIn-img'><img src='/site/checkIn/img/logo.png'></div><div class='signIn-txt'>
    <strong>Авторизуйтесь</strong>Вам будут доступны дополнительные ресурсы этого сайта</div>
    </a></div></div>";
}
$appRJ->response['result'].= "</div>";