<?php
$varifMail = null;
if(requiredFields::checkLogin($_GET['login'])){
    $query_text="select account_id, validDate, vldCode from accounts_dt where accLogin='".htmlspecialchars($_GET['login'])."' and ".
        "netWork='site'";
    $query_res=$DB->doQuery($query_text);
    if(mysql_num_rows($query_res)==1){
        $query_row=$DB->doFetchRow($query_res);
        if($query_row['validDate']==null){
            if($query_row['vldCode'] === $_GET['vldCode']){
                $RD_update = new recordDefault('accounts_dt', "account_id");
                $RD_update['result']['account_id']=$query_row['account_id'];
                $RD_update->copyOne();
                $appRJ->date['curDate'] = @date_create();
                $RD_update['result']['validDate']=date_format($appRJ->date['curDate'], 'Y-m-d H:i:s');
                $RD_update->updateOne();
                $varifMail.= "<strong class='success'>Подтверждение eMail адреса успешно.</strong>";
            }else{
                $varifMail.= "<strong class='fail'>Неправильный код подтверждения!</strong>";
            }
        }else{
            $varifMail.= "<strong class='fail'>вы уже подтверждали eMail, не надо делать этого снова!</strong>";
        }
    }else{
        $varifMail.= "<strong class='fail'>неправильный логин</strong>";
    }
}else{
    $varifMail.= "<strong class='fail'>невозможный логин</strong>";
}
$h1 ="Подтверждение eMail";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
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
$appRJ->response['result'].= "<div class='contentBox'>".
    "<h2>Подтверждение eMail на ".$_SERVER["HTTP_HOST"]."</h2>".$varifMail."</div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";
?>