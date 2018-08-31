<?php
$scrOrder_qry="select * from ordersList_dt WHERE label='".$_GET['searchPayment']."'";
$scrOrder_res=$DB->doQuery($scrOrder_qry);
if(mysql_num_rows($scrOrder_res)!=1){
    $appRJ->errors["XXX"]["description"]="недопустимый параметр label";
}else{
    $scrOrder_row=$DB->doFetchRow($scrOrder_res);
    $srcPayment_qry="select * from payments_dt where label='".$_GET['searchPayment']."'";
    $srcPayment_res=$DB->doQuery($srcPayment_qry);
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
    $appRJ->response['result'].= "</head><body>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
    $appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
        "<div class='contentBlock-wrap'>";
    $appRJ->response['result'].="<div class='update'>".
        "Обновлено: <span>менее минуты назад</span><a href='".$_SERVER['REQUEST_URI']."'>обновить</a></div>";
    $paidStat_txt=null;
    $shortDest_txt="<div><span class='fldName'>вид платежа:</span><span class='fldVal'>";
    $sum_txt="<div><span class='fldName'>сумма:</span><span class='fldVal'>".$scrOrder_row['orderSum'].
    "</span><span class='fldName'>руб.</span></div>";
    $comment_txt=null;
    if($scrOrder_row['comment']){
        $comment_txt="<div><span class='fldName'>Коментарий:</span><span class='fldVal'>".$scrOrder_row['comment'].
        "</span></div>";
    }
    $withdAmount_txt=null;
    $amount_txt=null;
    $bucketInfo=null;
    $paidHash_txt=null;
    $unaccepted_txt=null;
    if($scrOrder_row['shortDest']=="Right Joint - услуги"){
        $bucketInfo.="<div class='bucketInfo'>";
        $shortDest_txt.="Услуги";
        $bucket_txt="select * from ordersBucket_dt where order_id=".$scrOrder_row['order_id'];
        $bucket_res=$DB->doQuery($bucket_txt);
        if(mysql_num_rows($bucket_res)>0){
            define(SRV_CAT_IMG_PAPH, "/data/services/categs/");
            define(SRV_CARD_IMG_PAPH, "/data/services/cards/");
            $bucketInfo.="<span class='yBacket'>Корзина:</span>";
            while ($bucket_row=$DB->doFetchRow($bucket_res)){
                $Card_rd=new recordDefault("srvCards_dt", "card_id");
                $Card_rd->result['card_id']=$bucket_row['card_id'];
                if($Card_rd->copyOne()){
                    $bucketInfo.="<div class='order-line'><div class='order-img'><img src='".
                        SRV_CARD_IMG_PAPH.$Card_rd->result['card_id']."/preview/".
                        $Card_rd->result['cardImg']."'></div>".
                        "<div class='order-nm'><a href='/services/detail/".$Card_rd->result['cardAlias']."'>".
                        $Card_rd->result['cardName']."</a></div><div class='order-price'> ".
                        $Card_rd->result['cardPrice']." руб.</div></div>";
                    $prod_lst.=$Card_rd->result['cardName']."; ";
                }
            }
        }else{
            $bucketInfo.="нет заказов в корзине!!!";
        }
        $bucketInfo.="</div>";
    }elseif ($scrOrder_row['shortDest']=="Right Joint: пожертвование"){
        $shortDest_txt.="Пожертвование";
    }
    $shortDest_txt.="</span></div>";
    $appRJ->response['result'].="<div class='paidStat'>";
    if(mysql_num_rows($srcPayment_res)==1){
        $paidStat_txt.="<span class='paid'>платеж зачислен.</span>";
        $srcPayment_row=$DB->doFetchRow($srcPayment_res);
        $amount_txt="<div><span class='fldName'>зачислено:</span><span class='fldVal'>".$srcPayment_row['amount'].
            "</span><span class='fldName'>руб.</span></div>";
        $withdAmount_txt="<div><span class='fldName'>списано:</span><span class='fldVal'>".
            $srcPayment_row['withdraw_amount']."</span><span class='fldName'>руб.</span></div>";
        if(!$srcPayment_row['hashEqual']){

            $pay_str=$srcPayment_row["notification_type"]."&".
                $srcPayment_row["operation_id"]."&".
                $srcPayment_row["amount"]."&".
                $srcPayment_row["currency"]."&".
                $srcPayment_row["datetime"]."&".
                $srcPayment_row["sender"]."&";
            if($srcPayment_row['codepro']){
                $pay_str.="true";
            }else{
                $pay_str.='false';
            }
            $pay_str.="&".$ym['secret']."&".$srcPayment_row["label"];
            $hashRes="-FUCK-";
            if(hash_equals(sha1($pay_str), $srcPayment_row['sha1_hash'])){
                $hashRes="-OK!!!-";
            }
            $paidHash_txt.="<div><span class='fldName'>hashEqual:</span><span class='fldVal'>FALSE".
                "<br>".$srcPayment_row['sha1_hash']." / ".sha1($pay_str).$hashRes.
                "</span></div>";
        }
        if($srcPayment_row["unaccepted"]){
            $unaccepted_txt="<div><span class='fldName'>unaccepted:</span><span class='fldVal'>не зачислен ".
                "(требуется освободить место в кошельке)</span></div>";
        }
    }else{
        $paidStat_txt.="<span class='not-paid'>платеж не зачислен, попробуйте обновить страницу позже.</span>";
    }
    $appRJ->response['result'].=$paidStat_txt.$shortDest_txt.$sum_txt.$amount_txt.$withdAmount_txt.
        $paidHash_txt.$unaccepted_txt.$comment_txt;
    $appRJ->response['result'].="</div>".$bucketInfo;
    $appRJ->response['result'].="</div></div></div>";
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
    $appRJ->response['result'].= "</body></html>";
}