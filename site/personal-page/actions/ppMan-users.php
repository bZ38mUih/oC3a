<?php

$slUsr_qry = "select * from users_dt INNER JOIN accounts_dt ON users_dt.user_id = accounts_dt.user_id".
    " WHERE accMain_flag is TRUE ORDER BY users_dt.user_id DESC";

$slUsr_res=$DB->doQuery($slUsr_qry);

$usrCount=0;

if(mysql_num_rows($slUsr_res)>0){
    $usrCount=mysql_num_rows($slUsr_res);
}

$appRJ->response['result'].= "<div class='manFrame'>";
$appRJ->response['result'].= "<div class='manTopPanel'>";
$appRJ->response['result'].= "<div class='itemsCount'>";
$appRJ->response['result'].= "Всего: <span>".$usrCount."</span> записей";
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='newItem'>";

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";
if($usrCount>0){
    $appRJ->response['result'].= "<div class='item-line caption'>";
    $appRJ->response['result'].= "<div class='item-line-id'>";
    $appRJ->response['result'].= "usr_id";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-img'>";
    $appRJ->response['result'].= "avatar";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-login'>";
    $appRJ->response['result'].= "login";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-alias'>";
    $appRJ->response['result'].= "alias";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-flag'>";
    $appRJ->response['result'].= "blackList";
    $appRJ->response['result'].= "</div>";
    $appRJ->response['result'].= "<div class='item-line-nw'>";
    $appRJ->response['result'].= "mainAcc";
    $appRJ->response['result'].= "</div>";

    $appRJ->response['result'].= "</div>";
    while ($slUsr_row=$DB->doFetchRow($slUsr_res)){

        $appRJ->response['result'].= "<div class='item-line'>";
        $appRJ->response['result'].= "<div class='item-line-id'>";
        $appRJ->response['result'].= "<a href='/personal-page/ppManager/editUser/?user_id=".$slUsr_row['user_id']."'>".$slUsr_row['user_id']."</a>";
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "<div class='item-line-img'>";
        if($slUsr_row['photoLink']){
            if($slUsr_row['netWork']=='site'){
                $appRJ->response['result'].= "<img src='".PP_USR_IMG_PAPH.$slUsr_row['account_id']."/preview/".$slUsr_row['photoLink']."'>";
            }else{
                $appRJ->response['result'].= "<img src='".$slUsr_row['photoLink']."'>";
            }
        }else{
            $appRJ->response['result'].= "<img src='/data/default-img.png'>";
        }
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "<div class='item-line-login'>";
        $appRJ->response['result'].= $slUsr_row['accLogin'];
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "<div class='item-line-alias'>";
        $appRJ->response['result'].= $slUsr_row['accAlias'];
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "<div class='item-line-flag'>";
        $appRJ->response['result'].= "<input type='checkbox' ";
        if($slUsr_row['blackList']){
            $appRJ->response['result'].= "checked";
        }
        $appRJ->response['result'].= " disabled>";
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='item-line-nw'>";
        $appRJ->response['result'].= $slUsr_row['netWork'];
        $appRJ->response['result'].= "</div>";

        $appRJ->response['result'].= "</div>";
    }
}else{
    $appRJ->response['result'].= "there is no groups there<br>";
}
$appRJ->response['result'].= "</div>";