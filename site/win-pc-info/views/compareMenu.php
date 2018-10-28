<?php
$appRJ->response['result'].="<form class='wdCmp'>".
"<input type='hidden' name='wdCmp' value=true>";
$slDFiles_qry="select * from wdList_dt ORDER by diagDate DESC";
$slDFiles_res=$DB->doQuery($slDFiles_qry);

$selTxtLeft="<select name='cmpLeft'>";
//$selTxtLeft=null;
$selTxtRight="<select name='cmpRight'>";

if(mysql_num_rows($slDFiles_res)>0){
    while ($slDFiles_row=$DB->doFetchRow($slDFiles_res)){
        $selTxtLeft.="<option value='".$slDFiles_row['wd_id']."'";
        $selTxtRight.="<option value='".$slDFiles_row['wd_id']."'";
        if($cmpLeft == $slDFiles_row['wd_id']){
            $selTxtLeft.=" selected";
        }
        if($cmpRight == $slDFiles_row['wd_id']){
            $selTxtRight.=" selected";
        }

        $selTxtLeft.=">".$slDFiles_row['wdTag']."</option>";
        $selTxtRight.=">".$slDFiles_row['wdTag']."</option>";
    }
}
$selTxtLeft.="</select>";
$selTxtRight.="</select>";
$appRJ->response['result'].="<div class='compare-menu'><div class='sl-left'>".
    $selTxtLeft.
    "</div>".
    "<div class='compare-btn'><button onclick='wiCompare()'><img src='/site/win-pc-info/img/compare.png'><span>Compare</span></button> </div><div class='sl-right'>".
    $selTxtRight."</div>".
    "<div class='option-panel ta-left'>".
    "<span class='option-pannel-caption'>Опции:</span>".
    "<div class='line'><span>Окружение</span><input type='checkbox' name='opt-envir' ";
if($_COOKIE['opt-envir']){
    $appRJ->response['result'].="checked";
}
$appRJ->response['result'].="></div>".
    "<div class='line'><span>Аппаратура</span><input type='checkbox' name='opt-hardware' ";
if($_COOKIE['opt-hardware']){
    $appRJ->response['result'].="checked";
}
$appRJ->response['result'].="></div>".
    "<div class='line'><span>Процесс</span><input type='checkbox' name='opt-process' ";
$prPathEnbl=null;
if($_COOKIE['opt-process']){
    $appRJ->response['result'].="checked";
}else{
    $prPathEnbl=" disabled";
}
$appRJ->response['result'].=
    "><span>Путь</span><input type='checkbox' name='opt-pr-path' ";
if($_COOKIE['opt-pr-path']){
    $appRJ->response['result'].="checked".$prPathEnbl;
}
$appRJ->response['result'].="></div>".
    "<div class='line'><span>Службы</span><input type='checkbox' name='opt-srv' ";
$prSrvEnbl=null;
if($_COOKIE['opt-srv']){
    $appRJ->response['result'].="checked";
}else{
    $prSrvEnbl=" disabled";
}
$appRJ->response['result'].=">".
    "<span>Путь</span><input type='checkbox' name='opt-srv-path' ";
if($_COOKIE['opt-srv-path']){
    $appRJ->response['result'].="checked".$prSrvEnbl;
}
$appRJ->response['result'].="></div>".
    "</div>".


    "</div></form>";


/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 23.10.2018
 * Time: 10:10
 */