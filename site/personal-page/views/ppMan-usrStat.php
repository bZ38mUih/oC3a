<?php

$appRJ->response['result'].= "<div class='statFrame'>";
$appRJ->response['result'].= "<div class='enterFrame'>";
$appRJ->response['result'].= "<h3>Вход на сайт:</h3>";
$selStat_query = "select * from inLog_dt INNER JOIN accounts_dt ON inLog_dt.account_id = accounts_dt.account_id ".
    "INNER JOIN users_dt ON accounts_dt.user_id = users_dt.user_id WHERE users_dt.user_id=".$_GET['user_id'].
" ORDER BY inLog_dt.comeDate DESC limit 5";

$selStat_res = $DB->doQuery($selStat_query);
if($DB->err){
    $appRJ->response['result'].= "some query problems";
}
if(mysql_num_rows($selStat_res)>0){
    $appRJ->response['result'].= "<div class='list-line caption'>";
    $appRJ->response['result'].= "<div class='list-line-avatar'>avatar</div>";
    $appRJ->response['result'].= "<div class='list-line-alias'>alias</div>";
    $appRJ->response['result'].= "<div class='list-line-nw'>netWork</div>";
    $appRJ->response['result'].= "<div class='list-line-rmAddr'>rmAddr</div>";
    $appRJ->response['result'].= "<div class='list-line-rmPort'>rmPort</div>";
    $appRJ->response['result'].= "<div class='list-line-uAgent'>uAgent</div>";
    $appRJ->response['result'].= "<div class='list-line-date'>date</div>";
    $appRJ->response['result'].= "</div>";

    while ($selStat_row=$DB->doFetchRow($selStat_res)){
        $appRJ->response['result'].= "<div class='list-line'>";
        $appRJ->response['result'].= "<div class='list-line-avatar'>";
        if($selStat_row['photoLink']){
            if($selStat_row['netWork']=='site'){
                $appRJ->response['result'].= "<img src='".PP_USR_IMG_PAPH.$selStat_row['user_id']."/preview/".$selStat_row['photoLink']."'>";
            }else{
                $appRJ->response['result'].= "<img src='".$selStat_row['photoLink']."'>";
            }
        }else{
            $appRJ->response['result'].= "<img src='/data/avatar-default.jpg'>";
        }

        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='list-line-alias'>";
        $appRJ->response['result'].= $selStat_row['accAlias'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='list-line-nw'>";
        $appRJ->response['result'].= $selStat_row['netWork'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='list-line-rmAddr'>";
        $appRJ->response['result'].= $selStat_row['rmAddr'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='list-line-rmPort'>";
        $appRJ->response['result'].= $selStat_row['rmPort'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='list-line-uAgent'>";
        $appRJ->response['result'].= $selStat_row['uAgent'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "<div class='list-line-date'>";
        $appRJ->response['result'].= $selStat_row['comeDate'];
        $appRJ->response['result'].= "</div>";
        $appRJ->response['result'].= "</div>";
    };

}else{
    $appRJ->response['result'].= "there is no statistic for this account ".$_GET['user_id']."<br>";
}
$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "<div class='blogFrame'>";

$appRJ->response['result'].= "<h3>Блог:</h3>";

$appRJ->response['result'].= "</div>";

$appRJ->response['result'].= "</div>";