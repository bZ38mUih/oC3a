<?php
$slUsr_qry="select account_id, accLogin, accAlias, regDate, netWork, photoLink, eMail, birthDay, socProf ".
    "from accounts_dt ".
    "where user_id=".$_SESSION['user_id'];
$slUsr_res=$DB->query($slUsr_qry);
if(mysql_num_rows($slUsr_res)==1){
    $slUsr_row = $slUsr_res->fetch(PDO::FETCH_ASSOC);
    $h1 ="Настройки аккаунта";
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta name='description' content='Настройки аккаунта' http-equiv='Content-Type' charset='charset=utf-8'>".
        "<meta name='robots' content='noindex'>".
        "<title>Личный кабинет</title>".
        "<link rel='SHORTCUT ICON' href='/site/personal-page/img/favicon.png' type='image/png'>".
        "<script src='/source/js/jquery-3.2.1.js'></script>".
        "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
        "<script src='/site/siteHeader/js/modalHeader.js'></script>".
        "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/css/manFrame.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/personal-page/css/usrSettings.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/css/manForm.css' type='text/css' media='screen, projection'/>".
        "<script type='text/javascript' src='/site/js/manForm.js'></script>".
        "<link rel='stylesheet' href='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css'/>".
        "<script src='/source/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js'></script>".
        "</head><body>";

    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

    $appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
        "<div class='contentBlock-wrap'>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/views/ppSubMenu.php");
    $appRJ->response['result'].="<form class='editImg'><div class='img-frame'>";
    $delImgBtn_text=null;
    if($slUsr_row['photoLink']){
        $appRJ->response['result'].= "<img src='".PP_USR_IMG_PAPH.$slUsr_row['account_id']."/preview/".
            $slUsr_row['photoLink']."' ";
        $appRJ->response['result'].=">";
        $delImgBtn_text= "class='active'";
    }else{
        $appRJ->response['result'].= "<img src='/data/default-img.png'>";
    }
    $appRJ->response['result'].= "</div><div class='control-frame'>";
    if($slUsr_row['netWork']=='site'){
        $appRJ->response['result'].=  "<div class='delImg-line'>".
            "<span onclick='delImg(".$slUsr_row['account_id'].", ".'"'."delAvatarImg".'"'.")' ".$delImgBtn_text.">".
            "<img src='/source/img/drop-icon.png'>Удалить картинку</span></div><div class='button-line'>".
            "<input type='file' onchange='loadFiles(".$slUsr_row['account_id'].", ".'"'."avatar_id".'"'.
            ")' accept='image/jpeg,image/png,image/gif'></div>".
            "<div class='results'></div>";
    }
    $appRJ->response['result'].= "</div></form>".
        "<form>".
        "<div class='accnt-pr'>".
        "<h4>Личные данные:</h4>".
        "<div class='accnt-pr-line'>".
        "<label>E-Mail: </label>".
        "<span>";
    if($slUsr_row['eMail']){
        $appRJ->response['result'].=$slUsr_row['eMail'];
    }else{
        $appRJ->response['result'].="н/д";
    }
    $appRJ->response['result'].="</span>".
        "</div>".
        "<div class='accnt-pr-line'>".
        "<label>Birthday: </label>".
        "<span>";
    if($slUsr_row['birthDay']){
        $appRJ->response['result'].=substr($slUsr_row['birthDay'], 0, 10);
    }else{
        $appRJ->response['result'].="н/д";
    }
    $appRJ->response['result'].="</span></div></div>".
        "<div class='accnt-info'>".
        "<h4>Дополнительные сведения:</h4>".
        "<div class='accnt-info-line'>".
        "<label>Метод: </label>".
        "<span>".$slUsr_row['netWork']."</span>".
        "</div>".
        "<div class='accnt-info-line'>".
        "<label>Соц. профиль.: </label>";
    if($slUsr_row['socProf']){
        $appRJ->response['result'].="<a href='".$slUsr_row['socProf'].
            "' target='_blank'>".substr($slUsr_row['socProf'], 0, 30)."</a>";
    }
    else{
        $appRJ->response['result'].="Right Joint";
    }
    $appRJ->response['result'].="</div>".
        "<div class='accnt-info-line'><label>account_id: </label><span>".$slUsr_row['account_id']."</span></div>".
        "<div class='accnt-info-line'><label>accLogin: </label><span>".$slUsr_row['accLogin']."</span></div>".
        "</div></div></form>".
        "</div></div></div>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
    $appRJ->response['result'].= "</body></html>";
}
else{
    $appRJ->errors['access']['description']="недопустимо с вашего аккаунта";;
}

