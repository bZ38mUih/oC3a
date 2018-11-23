<?php
$appRJ->response['result'].= "<div class = 'ad-frame''><div class='ad-block'>ad here</div>";
if(!isset($_SESSION['user_id'])){
    $appRJ->response['result'].= "<a class='signIn' href='/signIn'>".
        "<div class='signIn-img'><img src='/site/checkIn/img/logo.png'></div><div class='signIn-txt'>".
        "<strong>Авторизуйтесь</strong>Вам будут доступны дополнительные ресурсы этого сайта</div></a>";
}
$appRJ->response['result'].= "</div>";