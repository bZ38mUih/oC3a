<?php
$slOrders_qry="select * from ordersList_dt order by ordDate DESC";
$slOrders_res=$DB->doQuery($slOrders_qry);
$h1 ="Список платежей";
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta name='description' content='Список платежей' http-equiv='Content-Type' charset='charset=utf-8'>".
    "<meta name='robots' content='noindex'>".
    "<title>Оплата</title>".
    "<link rel='SHORTCUT ICON' href='/site/status/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/payments/css/ordersList.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'><div class='ordersList'>";
if(mysql_num_rows($slOrders_res)>0){
    $appRJ->response['result'].="<div class='ordersList-line caption'><div class='p-type'>type</div>".
        "<div class='p-sum'>sum</div><div class='p-comment'>comment</div><div class='p-amount'>amount</div>".
        "<div class='p-withdraw'>withdr</div><div class='p-hash'>hash</div>".
        "<div class='p-unaccepted'>unaccept</div></div>";
    while ($slOrders_row=$DB->doFetchRow($slOrders_res)){
        $appRJ->response['result'].="<div class='ordersList-line'><div class='p-type'>".
            "<a href='/payments/?searchPayment=".$slOrders_row['label']."'><img src='";
        if($slOrders_row['shortDest']=="Right Joint: пожертвование"){
            $appRJ->response['result'].="/site/donate/img/logo.png";
        }elseif($slOrders_row['shortDest']=="Right Joint - услуги"){
            $appRJ->response['result'].="/site/services/img/logo.png";
        }
        $appRJ->response['result'].="'></a></div>".
            "<div class='p-sum'>".$slOrders_row['orderSum']."</div>".
        "<div class='p-comment'>".mb_substr($slOrders_row['comment'],0, 10)."</div>";
        $slPayment_txt="select * from payments_dt where label='".$slOrders_row['$slOrders_row']."'";
        $slPayment_res=$DB->doQuery($slPayment_txt);
        $amount_txt="<div class='p-amount'>";
        $withdraw_txt="<div class='p-withdraw'>";
        $hash_txt="<div class='p-hash'>";
        $unaccepted_txt="<div class='p-unaccepted'>";
        if(mysql_num_rows($slPayment_res)==1){
            $slPayment_row=$DB->doFetchRow($slPayment_res);
            $amount_txt.=$slPayment_row["amount"];
            $withdraw_txt.=$slPayment_row["withdraw_amount"];
            if($slPayment_row['hashEqual']){
                $hash_txt.="yes";
            }else{
                $hash_txt.="no";
            }
            if($slPayment_row['unaccepted']){
                $unaccepted_txt.="fail";
            }else{
                $unaccepted_txt.="well";
            }
        }else{
            $amount_txt.="-";
            $withdraw_txt.="-";
            $hash_txt.="-";
            $unaccepted_txt.="-";
        }
        $amount_txt.="</div>";
        $withdraw_txt.="</div>";
        $hash_txt.="</div>";
        $unaccepted_txt.="</div>";
        $appRJ->response['result'].=$amount_txt.$withdraw_txt.$hash_txt.$unaccepted_txt."</div>";
    }
}else{
    $appRJ->response['result'].="there is no orders there";
}
$appRJ->response['result'].="</div></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";