<?php
$h1 ="Регистрация - Успешно";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=charset=utf-8'/>".
    "<meta name='description' content='регистрация на сайте: вам будут доступны дополнительные ресурсы этого сайта.'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Регистрация</title>".
    "<link rel='SHORTCUT ICON' href='/site/checkIn/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/checkIn/css/registrationSteps.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='checkIn-frame'>".
    "<h2>Регистрация аккаунта на ".$_SERVER["HTTP_HOST"]."</h2>".
    "<strong class='success' class='success'>успешно</strong>".
    "<p>Для завершения регистрации вам необходимо подтвердить ваш E-Mail адрес.
<span class='e_mail'>".substr($requiredFields['eMail']['val'],0,2)."***".substr($requiredFields['eMail']['val'],
        strlen($requiredFields['eMail']['val'])-4,4)."</span> переходом по ссылке в письме.<br></p>";
$sendMailMessage = "Для завершения регистрации подтвердите ваш E-mail адрес переходом по ссылке ".
    "http://".$_SERVER["HTTP_HOST"]."/checkIn/?vldCode=".$vldCode."&login=".
    $requiredFields['login']['val']. " Ваш логин: ".$requiredFields['login']['val'].
    " пароль: ".$requiredFields['password']['val'].". Если вы не регистрировались на ".$_SERVER["HTTP_HOST"]
    .",  то просто проигнорируйте письмо.";
if (!mail($requiredFields['eMail']['val'], 'Регистрация на '.$_SERVER["HTTP_HOST"], $sendMailMessage, 'From: RightJoint')){
    $appRJ->response['result'].= "<p>Ошибки: письмо не отправлено. Ссылка для подтверждения дана ниже<br>".
        "<a href='http://".$_SERVER["HTTP_HOST"]."/checkIn/?vldCode=".$vldCode."&login=".
        $requiredFields['login']['val']."'>ссылка для подтверждения</a></p>";
}
$appRJ->response['result'].= "<div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";
?>