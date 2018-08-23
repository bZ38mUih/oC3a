<?php
//p2p-incoming&1234567&300.00&643&2011-07-01T09:00:00.000+04:00&41001XXXXXXXX&false&01234567890ABCDEF01234567890&YM.label.12345
//&false&01234567890ABCDEF01234567890&YM.label.12345
/*
$insr_qry="insert into payments_dt (notification_type, operation_id, amount, withdraw_amount, currency, ".
    "datetime, sender, codepro, label, sha1_hash, unaccepted, lastname, firstname, fathersname, email, phone, ".
    "city, street, building, suite, flat, zip) values ".
    "('p2p-incoming', '1234567', 300.00, null, '643', '2011-07-01 09:00:00', '41001XXXXXXXX', false, 'YM.label.12345', ".
    "'a2ee4a9195f4a90e893cff4f62eeba0b662321f9', null, null, null, null, null, null, null, null, null, null, null, null)";
if(!$DB->doQuery($insr_qry)){
    print_r($DB->err);
    echo "<hr>";
    echo $insr_qry;
};
exit;
*/
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
            //$slPayments_row["datetime"]."&".
              //substr($slPayments_row["datetime"], 0, 10)."T".
              //substr($slPayments_row["datetime"], 11, strlen($slPayments_row["datetime"])-11)."Z&".
            //"2018-08-22T12:49:06.000+04:00&".
              $slPayments_row["sender"]."&";
          if($slPayments_row['codepro']){
              $pay_str.="true";
          }else{
              $pay_str.='false';
          }
        $pay_str.="&".
              //"false&".
            "nP79ETfWwaBJeyi/5IvBGeWY"."&".
              $slPayments_row["label"];

//notification_type&operation_id&amount&currency&datetime&sender&codepro&notification_secret&label
/*
        $pay_str=$slPayments_row["notification_type"].
            $slPayments_row["operation_id"].
            $slPayments_row["amount"].
            $slPayments_row["currency"].
            //$slPayments_row["datetime"].
            "2018-08-22T12:49:06.000+04:00".
            $slPayments_row["sender"].
            $slPayments_row["codepro"].
            "nP79ETfWwaBJeyi/5IvBGeWY".
            $slPayments_row["label"];
*/
        //$pay_str="p2p-incoming&1234567&300.00&643&2011-07-01T09:00:00.000+04:00&41001XXXXXXXX&false&01234567890ABCDEF01234567890&YM.label.12345";
        //notification_type&operation_id&amount&currency&datetime&sender&codepro&notification_secret&label
        $appRJ->response['result'].=$pay_str."<br><br>";
        //$appRJ->response['result'].=$slPayments_row['sha1_hash']." - ".hex2bin(sha1($pay_str))."<br>";
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