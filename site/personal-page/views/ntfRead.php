<?php
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
$appRJ->response['result'].= "<!DOCTYPE html>".
    "<html lang='en-Us'>".
    "<head>".
    "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
    "<meta name='description' content='Оповещения'/>".
    "<meta name='robots' content='noindex'>".
    "<title>Личный кабинет</title>".
    "<link rel='SHORTCUT ICON' href='/site/personal-page/img/favicon.png' type='image/png'>".
    "<script src='/source/js/jquery-3.2.1.js'></script>".
    "<link rel='stylesheet' href='/site/css/default.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/siteHeader/css/default.css' type='text/css' media='screen, projection'/>".
    "<script src='/site/siteHeader/js/modalHeader.js'></script>".
    "<link rel='stylesheet' href='/site/css/subMenu.css' type='text/css' media='screen, projection'/>".
    "<link rel='stylesheet' href='/site/personal-page/css/ntfForm.css' type='text/css' media='screen, projection'/>".
    "</head><body>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/defaultView.php");
$appRJ->response['result'].= "<div class='contentBlock-frame'><div class='contentBlock-center'>".
    "<div class='contentBlock-wrap'>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/personal-page/views/ppSubMenu.php");
$appRJ->response['result'].="<form><div class='ntf-line'>".
    "<div class='ntf-field'>Тип:</div>".
    "<div class='ntf-val'>".$slUsrNtf_row['ntfType']."</div></div>".
    "<div class='ntf-line'><div class='ntf-field'>Подписчики:</div><div class='ntf-val'>".
    $slUsrNtf_row['ntfSubscr']."</div></div>".
    "<div class='ntf-line'><div class='ntf-field'>Тема:</div><div class='ntf-val'>".$slUsrNtf_row['ntfSubj'].
    "</div></div>".
    "<div class='ntf-line'><div class='ntf-field'>Содержание:</div><div class='ntf-val'>".$slUsrNtf_row['ntfDescr'].
    "</div></div>".
    "<div class='ntf-line'><div class='ntf-field'>Дата:</div><div class='ntf-val'>". $slUsrNtf_row['ntfDate'].
    "</div></div>".
    "<div class='ntf-line'><div class='ntf-field'>Прочитано</div>".
    "<div class='ntf-val'>";
if(!$slUsrNtf_row['readDate']){
    $appRJ->response['result'].="just now";
    $ntfRd=new recordDefault("ntfList_dt", "ntfList_id");
    $ntfRd->result['ntfList_id']=$slUsrNtf_row['ntfList_id'];
    $ntfRd->result['readDate']=date_format($appRJ->date['curDate'], 'Y-m-d H.m.s');
    $ntfRd->updateOne();
}else{
    $appRJ->response['result'].=$slUsrNtf_row['readDate'];
}
$appRJ->response['result'].="</div></div></form></div></div></div>";
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteFooter/views/footerDefault.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalOrder.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/site/siteHeader/views/modalMenu.php");
$appRJ->response['result'].= "</body></html>";

