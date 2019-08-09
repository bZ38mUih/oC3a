<?php
$authRefAnimate_txt=null;
//$authRefAnimate_val=""
$authRefAnimate_txt.= "<div class = 'auth-ref-wrap'><div class='auth-stat'>ad here</div>";
if(!isset($_SESSION['user_id'])){
    $authRefAnimate_txt.= "<div class='auth-ref-animate-wrap'>".
        "<div class='auth-ref-animate'>".
        "<a class='signIn' href='/signIn'>".
        "<span></span>
        <span></span>
        <span></span>
        <span></span>".
        "<div class='signIn-img'><img src='/site/checkIn/img/logo.png'></div><div class='signIn-txt'>
    <strong>Авторизуйтесь</strong>";
    if(!$authRefAnimate_val){
        $authRefAnimate_txt.="Вам будут доступны дополнительные ресурсы этого сайта";
    }else{
        $authRefAnimate_txt.=$authRefAnimate_val;
    }
    //"Вам будут доступны дополнительные ресурсы этого сайта".
    $authRefAnimate_txt.="</div></a></div></div>";
}
$authRefAnimate_txt.= "</div>";