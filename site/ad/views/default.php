<?php
$appRJ->response['result'].= "<div class = 'ad-frame''><div class='ad-block'>ad here</div>";
if(!isset($_SESSION['user_id'])){
    $appRJ->response['result'].= "<a class='signIn-block' href='/signIn'>".
        "<div class='signIn-img'><img src='/site/checkIn/img/logo.png'></div><div class='signIn-txt'>".
        "<strong>Авторизуйтесь</strong>Вам будут доступны дополнительные ресурсы этого сайта</div></a>".
        "<div class='modal signIn'><div class='overlay'></div><div class='contentBlock-frame'>".
        "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div></div>".
        "<div class='modal-left'></div></div></div></div>";
}
$appRJ->response['result'].= "</div>";