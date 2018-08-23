<?php
$slPayments_qry="select * from payments_dt";
$slPayments_res=$DB->doQuery($slPayments_qry);
$h1 ="Платежи";
$App['views']['social-block']=true;
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='проверить статус платежа' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<title>Оплата</title>".
    "<link rel='SHORTCUT ICON' href='/site/status/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/status/css/status.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<script src='/site/status/js/status.js'></script>";
if($App['views']['social-block']){
    $appRJ->response['result'].= "<script src='/site/js/social-block.js'></script>";
}
$appRJ->response['result'].= "</head>".
    "<body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
if(mysql_num_rows($slPayments_res)>0){
    while ($slPayments_row=$DB->doFetchRow($slPayments_res)){
        $pay_str=$slPayments_row["notification_type"]."&".
            $slPayments_row["operation_id"]."&".
            $slPayments_row["amount"]."&".
            $slPayments_row["currency"]."&".
            $slPayments_row["datetime"]."&".
            $slPayments_row["sender"]."&";
        if($slPayments_row['codepro']){
            $pay_str.="true";
        }else{
            $pay_str.='false';
        }
        $pay_str.="&".
            //toDo move valet secret to conf
            "nP79ETfWwaBJeyi/5IvBGeWY"."&".
            $slPayments_row["label"];
        $appRJ->response['result'].=$pay_str."<br><br>";
        $appRJ->response['result'].=$slPayments_row['sha1_hash']." - ".sha1($pay_str)."<br><hr>";
    }
}else{
    $appRJ->response['result'].="no payments in table";
}
$appRJ->response['result'].="</div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";