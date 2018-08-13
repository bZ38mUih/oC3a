<?php
/**
 * Created by PhpStorm.
 * User: mrSmitch
 * Date: 08.07.2018
 * Time: 22:31
 */
//.$_SESSION['user_id']
$readNtfFlag=false;
$slUsrNtf_cnt=0;
$slUsrNtf_qry="select ntf_dt.ntfSubj, ntf_dt.ntfDate, ntfList_dt.ntfList_id, ntfList_dt.user_id, ".
    "ntf_dt.ntfType, ntf_dt.ntfSubscr, ntf_dt.ntfDescr, ntfList_dt.readDate from ntfList_dt INNER JOIN ntf_dt ".
    "ON ntfList_dt.ntf_id = ntf_dt.ntf_id WHERE ntfList_dt.ntfList_id = ".$_GET['ntfList_id'];
$slUsrNtf_res=$DB->doQuery($slUsrNtf_qry);
if(mysql_num_rows($slUsrNtf_res)>0){
    $slUsrNtf_cnt=mysql_num_rows($slUsrNtf_res);
}
if($slUsrNtf_cnt>0){
    $slUsrNtf_row=$DB->doFetchRow($slUsrNtf_res);
    if($slUsrNtf_row['user_id']==$_SESSION['user_id']){
        $readNtfFlag=true;
    }else{
        $appRJ->errors['access']['description']="доступ к сообщению запрещен";
        $appRJ->throwErr();
    }
}else{
    $appRJ->errors['404']['description']="доступ к сообщению невозможен";
}

if(!$readNtfFlag){
    $appRJ->throwErr();
}

$h1 ="Оповещения";



$appRJ->response['result'].= "<!DOCTYPE html>";
$appRJ->response['result'].= "<html lang='en-Us'>";
$appRJ->response['result'].= "<head>";
$appRJ->response['result'].= "<meta name='description' content='Оповещения' http-equiv='Content-Type' charset='charset=utf-8'>";
$appRJ->response['result'].= "<meta name='robots' content='noindex'>";
$appRJ->response['result'].= "<title>Личный кабинет</title>";
$appRJ->response['result'].= "<link rel='SHORTCUT ICON' href='/site/personal-page/img/favicon.png' type='image/png'>";
$appRJ->response['result'].= "<script src='/source/js/jquery-3.2.1.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<script src='/site/siteHeader/js/modalHeader.js'></script>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>";
$appRJ->response['result'].= "<link rel='stylesheet' href='/site/personal-page/css/ntfForm.css' type='text/css' media='screen, projection'/>";

$appRJ->response['result'].= "</head>";

$appRJ->response['result'].= "<body>";

require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");

$appRJ->response['result'].= "<div class='contentBlock-frame'>";
$appRJ->response['result'].= "<div class='contentBlock-center'>";
$appRJ->response['result'].= "<div class='contentBlock-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/views/ppSubMenu.php");
$appRJ->response['result'].="<form>";
$appRJ->response['result'].="<div class='ntf-line'>";
$appRJ->response['result'].="<div class='ntf-field'>";
$appRJ->response['result'].="Тип:";

$appRJ->response['result'].="</div>";
$appRJ->response['result'].="<div class='ntf-val'>";
$appRJ->response['result'].=$slUsrNtf_row['ntfType'];
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";

$appRJ->response['result'].="<div class='ntf-line'>";
$appRJ->response['result'].="<div class='ntf-field'>";
$appRJ->response['result'].="Подписчики:";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="<div class='ntf-val'>";
$appRJ->response['result'].=$slUsrNtf_row['ntfSubscr'];
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";

$appRJ->response['result'].="<div class='ntf-line'>";
$appRJ->response['result'].="<div class='ntf-field'>";
$appRJ->response['result'].="Тема:";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="<div class='ntf-val'>";
$appRJ->response['result'].=$slUsrNtf_row['ntfSubj'];
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";

$appRJ->response['result'].="<div class='ntf-line'>";
$appRJ->response['result'].="<div class='ntf-field'>";
$appRJ->response['result'].="Содержание:";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="<div class='ntf-val'>";
$appRJ->response['result'].=$slUsrNtf_row['ntfDescr'];
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";

$appRJ->response['result'].="<div class='ntf-line'>";
$appRJ->response['result'].="<div class='ntf-field'>";
$appRJ->response['result'].="Дата:";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="<div class='ntf-val'>";
$appRJ->response['result'].=$slUsrNtf_row['ntfDate'];
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="</div>";

$appRJ->response['result'].="<div class='ntf-line'>";
$appRJ->response['result'].="<div class='ntf-field'>";
$appRJ->response['result'].="Прочитано";
$appRJ->response['result'].="</div>";
$appRJ->response['result'].="<div class='ntf-val'>";
if(!$slUsrNtf_row['readDate']){
    $appRJ->response['result'].="just now";
    $ntfRd=new recordDefault("ntfList_dt", "ntfList_id");
    $ntfRd->result['ntfList_id']=$slUsrNtf_row['ntfList_id'];
    $ntfRd->result['readDate']=date_format($appRJ->date['curDate'], 'Y-m-d H.m.s');
    $ntfRd->updateOne();
}else{
    $appRJ->response['result'].=$slUsrNtf_row['readDate'];
}
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

