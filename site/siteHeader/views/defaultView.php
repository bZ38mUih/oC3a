<?php
$appRJ->response['result'].= "<header><div class='headerCenter'>".
    "<div class='menuBtn'><img src='/site/siteHeader/img/menu-icon.png'><span>МЕНЮ</span></div>".
    "<div class='logo'><div class='imgBlock'>";
if(isset($appRJ->server['reqUri_expl'][1]) and file_exists($_SERVER['DOCUMENT_ROOT']."/site/".$appRJ->server['reqUri_expl'][1]."/img/logo.png")){
    $appRJ->response['result'].= "<img src='/site/".$appRJ->server['reqUri_expl'][1]."/img/logo.png'>";
}else{
    $appRJ->response['result'].= "<img src='/site/siteHeader/img/site-logo.png'>";
}
$appRJ->response['result'].= "</div>"."<div class='textBlock'><span class='firmName'>ПРАВИЛЬНЫЙ КОНТАКТ</span>".
    "<h1>".$h1."</h1></div></div><div class='orderBtn'><span>ЗАКАЗ</span>".
    "<img src='/site/siteHeader/img/order.png'></div></div></header>";
