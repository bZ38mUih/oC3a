<?php

$slUsr_qry="select account_id, accLogin, accAlias, regDate, netWork, photoLink, eMail, birthDay, socProf ".
    "from accounts_dt ".
    "where user_id=".$_SESSION['user_id'];
$slUsr_res=$DB->doQuery($slUsr_qry);
if(mysql_num_rows($slUsr_res)==1){
    $slUsr_row=$DB->doFetchRow($slUsr_res);
    $h1 ="Настройки аккаунта";



    $appRJ->response['result'].= "<!DOCTYPE html>";
    $appRJ->response['result'].= "<html lang='en-Us'>";
    $appRJ->response['result'].= "<head>";
    $appRJ->response['result'].= "<meta name='description' content='Настройки аккаунта' http-equiv='Content-Type' charset='charset=utf-8'>";
    $appRJ->response['result'].= "<meta name='robots' content='noindex'>";
    $appRJ->response['result'].= "<title>Личный кабинет</title>";
    $appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/personal-page/img/favicon.png' type='image/png'>";
    $appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
    $appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>";
    $appRJ->response['result'].= "<link rel='stylesheet' href='/site/personal-page/css/usrSettings.css' type='text/css' media='screen, projection'/>";

    $appRJ->response['result'].= "</head>";

    $appRJ->response['result'].= "<body>";

    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

    $appRJ->response['result'].= "<div class='contentBlock-frame'>";
    $appRJ->response['result'].= "<div class='contentBlock-center'>";
    $appRJ->response['result'].= "<div class='contentBlock-wrap'>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/views/ppSubMenu.php");
    $appRJ->response['result'].="<form>";
    $appRJ->response['result'].="<div class='accnt'>";

    $appRJ->response['result'].="<div class='accnt-title'>";
    $appRJ->response['result'].="<div class='accnt-title-avatar'>";
    $appRJ->response['result'].="<img src='";
    if($slUsr_row['photoLink']){
        $appRJ->response['result'].=$slUsr_row['photoLink'];
    }else{
        $appRJ->response['result'].="/data/avatar-default.jpg";
    }
    $appRJ->response['result'].="'>";
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="<div class='accnt-title-txt'>";
    $appRJ->response['result'].="<span>".$slUsr_row['accAlias']."</span>";
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="</div>";

    $appRJ->response['result'].="<div class='accnt-pr'>";
    $appRJ->response['result'].="<h4>Личные данные:</h4>";

    $appRJ->response['result'].="<div class='accnt-pr-line'>";
    $appRJ->response['result'].="<label>E-Mail: </label>";
    $appRJ->response['result'].="<span>";
    if($slUsr_row['eMail']){
        $appRJ->response['result'].=$slUsr_row['eMail'];
    }else{
        $appRJ->response['result'].="н/д";
    }
    $appRJ->response['result'].="</span>";
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="<div class='accnt-pr-line'>";
    $appRJ->response['result'].="<label>Birthday: </label>";
    $appRJ->response['result'].="<span>";
    if($slUsr_row['birthDay']){
        $appRJ->response['result'].=substr($slUsr_row['birthDay'], 0, 10);
    }else{
        $appRJ->response['result'].="н/д";
    }
    $appRJ->response['result'].="</span>";
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="</div>";

    $appRJ->response['result'].="<div class='accnt-info'>";
    $appRJ->response['result'].="<h4>Дополнительные сведения:</h4>";
    $appRJ->response['result'].="<div class='accnt-info-line'>";
    $appRJ->response['result'].="<label>Метод: </label>";
    $appRJ->response['result'].="<span>".$slUsr_row['netWork']."</span>";
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="<div class='accnt-info-line'>";
    $appRJ->response['result'].="<label>Соц. профиль.: </label>";
    if($slUsr_row['socProf']){
        $appRJ->response['result'].="<a href='".$slUsr_row['socProf'].
            "' target='_blank'>".substr($slUsr_row['socProf'], 0, 30)."</a>";
    }
    else{
        $appRJ->response['result'].="Right Joint";
    }
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="<div class='accnt-info-line'>";
    $appRJ->response['result'].="<label>account_id: </label>";
    $appRJ->response['result'].="<span>".$slUsr_row['account_id']."</span>";
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="<div class='accnt-info-line'>";
    $appRJ->response['result'].="<label>accLogin: </label>";
    $appRJ->response['result'].="<span>".$slUsr_row['accLogin']."</span>";
    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="</div>";

    $appRJ->response['result'].="</div>";
    $appRJ->response['result'].="</form>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "</div>";

    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");

    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");

    $appRJ->response['result'].= "</body>";
    $appRJ->response['result'].= "</html>";
}
else{
    $appRJ->errors['access']['description']="недопустимо с вашего аккаунта";;
}

