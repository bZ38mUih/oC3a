<?php
$scrOrder_qry="select * from ordersList_dt WHERE label='".$_GET['searchPayment']."'";
$scrOrder_res=$DB->doQuery($scrOrder_qry);
if(mysql_num_rows($scrOrder_res)!=1){
    $appRJ->errors["XXX"]["description"]="недопустимый параметр label";
}else{
    $scrOrder_row=$DB->doFetchRow($scrOrder_res);
    $srcPayment_qry="select * from payments_dt where label='".$_GET['searchPayment']."'";
    $srcPayment_res=$DB->doFetchRow($srcPayment_qry);
    $h1 ="Проверка платежа";
    $appRJ->response['result'].= "<!DOCTYPE html>".
        "<html lang='en-Us'>".
        "<head>".
        "<meta name='description' content='проверить статус платежа' http-equiv='Content-Type' charset='charset=utf-8'>".
        "<meta name='robots' content='noindex'>".
        "<title>Проверка платежа</title>".
        "<link rel='SHORTCUT ICON' href='/site/payments/img/favicon.png' type='image/png'>".
        "<script src='/source/js/jquery-3.2.1.js'></script>".
        "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
        "<link rel='stylesheet' href='/site/payments/css/searchPayment.css' type='text/css' media='screen, projection'/>".
        "<script src='/site/siteHeader/js/modalHeader.js'></script>".
        "<script src='/site/payments/js/searchPayments.js'></script>";
    //"<script src='/site/status/js/status.js'></script>";
    $appRJ->response['result'].= "</head><body>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
    $appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
        "<div class='contentBlock-wrap'>";
    $appRJ->response['result'].="<div class='update'>".
        "Обновлено: <span>менее минуты назад</span><a href='".$appRJ->server['reqUri']."'>обновить</a></div>";
    $appRJ->response['result'].="<div class='paidStat'>";
    if(mysql_num_rows($srcPayment_res)==1){
        $srcPayment_row=$DB->doFetchRow($srcPayment_res);
        $appRJ->response['result'].="<span class='paid'>платеж зачислен:</span>".
        "<div><span class='fldName'>сумма для перевода:</span><span class='fldVal'>".$scrOrder_row['orderSum']."</span></div>";
        "<div><span class='fldName'>зачислено:</span><span class='fldVal'>".$srcPayment_row['amount']."</span></div>";
        "<div><span class='fldName'>списано:</span><span class='fldVal'>".$srcPayment_row['withdraw_amount']."</span></div>";
    }else{
        $appRJ->response['result'].="<span class='not-paid'>платеж не зачислен, попробуйте обновить страницу позже</span>".
        "<div><span class='fldName'>вид платежа:</span><span class='fldVal'>";
        if($scrOrder_row['formcomment']=="Right Joint - услуги"){
            $appRJ->response['result'].="Услуги";
        }else{
            $appRJ->response['result'].="Пожертвования";
        }
        $appRJ->response['result'].="</span></div><div><span class='fldName'>сумма для перевода:</span><span class='fldVal'>".
            $scrOrder_row['orderSum']."</span></div>";
    }
    $appRJ->response['result'].="</div>";

    $appRJ->response['result'].="</div></div></div>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
    $appRJ->response['result'].= "</body></html>";
}