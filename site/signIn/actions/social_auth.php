<?php

$socialAuth_err=false;

$RD_accounts = array("table" => "accounts_dt", "field_id" => "account_id");

$tokenArr=null;
$usrArr=null;

if (isset($_GET['state']) and $_GET['state']=='ok') {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/actions/ok_auth.php");

}else{
    if (strlen($_GET['code'])<300){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/actions/vk_auth.php");
    }else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/actions/fb_auth.php");
    }
}

if($socialAuth_err ===true){

    $query_text = "select * from accounts_dt where accLogin='".$RD_accounts['result']['accLogin'].
        "' and netWork='".$RD_accounts['result']['netWork']."'";

    $query_res = $DB->query($query_text);

    $addNtf_txt=null;

    if(mysql_num_rows($query_res)===1)
    {
        $query_row = $query_res->fetch(PDO::FETCH_ASSOC);
        $RD_accounts['result']['account_id']=$query_row['account_id'];
        $update_flag=false;
        foreach($query_row as $key=>$value){
            if(isset($RD_accounts['result'][$key]) and $RD_accounts['result'][$key]!=$value){
                $update_flag = true;
            }else{
                $RD_accounts['result'][$key]=$value;
            }
        }

        if($update_flag){
            $RD_accounts->updateOne();
        }

    }else{
        $RD_accounts['result']['regDate']=date_format($appRJ->date['curDate'], 'Y-m-d H:i:s');
        $RD_accounts['result']['validDate']=date_format($appRJ->date['curDate'], 'Y-m-d H:i:s');
        $RD_users = array("table" => "users_dt", "field_id" => "user_id");

        $RD_users['result']['blackList']=false;
        $RD_users->putOne();
        $RD_accounts['result']['user_id']=$RD_users['result']['user_id'];
        $RD_accounts['result']['pw_hash']=null;
        $RD_accounts['result']['eMail']=null;
        $RD_accounts['result']['accMain_flag']=true;
        $RD_accounts->putOne();
        $addNtf_txt="НОВЫЙ ";
    }

    $Ntf_rd['result']['ntfType']='group';
    $Ntf_rd['result']['ntfSubscr']=1;
    $Ntf_rd['result']['ntfDescr']=$addNtf_txt."Пользователь ".$RD_accounts['result']['accAlias']." вошел на сайт через ".$RD_accounts['result']['netWork'];
    $Ntf_rd['result']['ntfSubj']="Вход пользователя на сайт.";
    $Ntf_rd->putOne();

    $_SESSION['alias']=$RD_accounts['result']['accAlias'];
    $_SESSION['account_id'] = $RD_accounts['result']['account_id'];
    $_SESSION['user_id'] = $RD_accounts['result']['user_id'];
    $_SESSION['photoLink'] = $RD_accounts['result']['photoLink'];

    $usrGroups_text="select * from usersGroups_dt INNER JOIN usersToGroups_dt ON usersGroups_dt.group_id = ".
        "usersToGroups_dt.group_id WHERE usersToGroups_dt.user_id = ".$RD_accounts['result']['user_id'];
    $usrGroups_res = $DB->query($usrGroups_text);

    if(@mysql_num_rows($usrGroups_res)>0){
        while ($usrGroups_row = $usrGroups_res->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['groups'][$usrGroups_row['group_id']] = $usrGroups_row['rules'];
        }
    }

    $queryLog_text="insert into inLog_dt (account_id, comeDate, uAgent, rmAddr, rmPort) values".
        " ('".$RD_accounts['result']['account_id']."', '".date_format($appRJ->date['curDate'], 'Y-m-d H:i:s')."', ".
        "'".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REMOTE_PORT']."')";
    $DB->query($queryLog_text);

    if($_SESSION['redirLoc']){
        header("Location: ".$_SESSION['redirLoc']);
    }else{
        header("Location: /");
    }

}else{
    session_destroy();

    $validErr="<strong>Ошибка авторизации. Некоторая отладочная информация:</strong><br>".$validErr;
}