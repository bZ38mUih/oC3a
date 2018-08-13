<?php

$appRJ->response['result'].= "<div class = 'ad-frame''>";

$appRJ->response['result'].= "<div class='ad-block'>";
$appRJ->response['result'].= "ad here";
$appRJ->response['result'].= "</div>";

if(!isset($_SESSION['user_id'])){
    $appRJ->response['result'].= "<a class='signIn-block' href='/signIn'>";

    $appRJ->response['result'].= "<div class='signIn-img'>";
    $appRJ->response['result'].= "<img src='/site/checkIn/img/logo.png'>";
    $appRJ->response['result'].= "</div>";

    $appRJ->response['result'].= "<div class='signIn-txt'>";
    $appRJ->response['result'].= "<strong>Авторизуйтесь</strong>";
    $appRJ->response['result'].= "Вам будут доступны дополнительные ресурсы этого сайта";
    $appRJ->response['result'].= "</div>";

    $appRJ->response['result'].= "</a>";

    $appRJ->response['result'].= "<div class='modal signIn'>";
    $appRJ->response['result'].= "<div class='overlay'></div>";
    $appRJ->response['result'].= "<div class='contentBlock-frame'>";
    $appRJ->response['result'].= "<div class='contentBlock-center'>";

    $appRJ->response['result'].= "<div class='modal-right'>";
    $appRJ->response['result'].= "<div class='modal-close'></div>";
    $appRJ->response['result'].= "</div>";

    $appRJ->response['result'].= "<div class='modal-left'>";

    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";


}
$appRJ->response['result'].= "</div>";

