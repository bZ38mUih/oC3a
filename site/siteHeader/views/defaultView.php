<?php
$appRJ->response['result'].= "<header>";
$appRJ->response['result'].= "<div class='headerCenter'>";
$appRJ->response['result'].= "<div class='menuBtn'><img src='/site/siteHeader/img/menu-icon.png'><span>МЕНЮ</span></div>";
$appRJ->response['result'].= "<div class='logo'><div class='imgBlock'>";
if(isset($appRJ->server['reqUri_expl'][1]) and file_exists($_SERVER['DOCUMENT_ROOT']."/site/".$appRJ->server['reqUri_expl'][1]."/img/logo.png")){
    $appRJ->response['result'].= "<img src='/site/".$appRJ->server['reqUri_expl'][1]."/img/logo.png'>";
}else{
    $appRJ->response['result'].= "<img src='/site/siteHeader/img/site-logo.png'>";
}
$appRJ->response['result'].= "</div>";
$appRJ->response['result'].= "<div class='textBlock'><span class='firmName'>ПРАВИЛЬНЫЙ КОНТАКТ</span>";
$appRJ->response['result'].= "<h1>".$h1."</h1>";
$appRJ->response['result'].= "</div></div><div class='orderBtn'><span>ЗАКАЗ</span>".
    "<img src='/site/siteHeader/img/order.png'></div>";
$appRJ->response['result'].= "</div></header>";
