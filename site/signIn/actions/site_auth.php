<?php

require_once ($_SERVER["DOCUMENT_ROOT"]."/source/accessorial_class.php");

if(!accessorialClass::checkPassword($_POST['login'])){
    $validErr = "недопустимый логин";
}
if($validErr == null){
    if(!accessorialClass::checkPassword($_POST['password'])){
        $validErr = "недопустимый пароль";
    }
}

if($validErr == null){
    $queryText = "select * from accounts_dt INNER JOIN users_dt ON accounts_dt.user_id = users_dt.user_id ".
        "where accAlias='".$_POST['login']."' and netWork='site'";
    $queryRes = $DB->query($queryText);
    if($queryRes->rowCount() === 1){
        $queryRow = $queryRes->fetch(PDO::FETCH_ASSOC);
        if(password_verify($_POST['password'], $queryRow['pw_hash'])){
            $newHash=password_hash($_POST['password'], PASSWORD_DEFAULT);
            $updateHash_qry = "update accounts_dt set pw_hash='".$newHash."' ".
                "where accAlias='".$_POST['login']."' and netWork='site'";
            $DB->query($updateHash_qry);
            if($queryRow['validDate']===null){
                $validErr = "eMail не подтвержден";
            }elseif ($queryRow['blackList'] == true){
                $validErr = "Аккаунт заблокирован";
            }else{
                $_SESSION['alias']=$queryRow['accAlias'];
                $_SESSION['account_id'] = $queryRow['account_id'];
                $_SESSION['user_id'] = $queryRow['user_id'];
                if($queryRow['photoLink']){
                    $_SESSION['photoLink'] = PP_USR_IMG_PAPH.$queryRow['account_id']."/preview/".$queryRow['photoLink'];
                }
                $queryLog_text="insert into inLog_dt (account_id, comeDate, uAgent, rmAddr, rmPort) values".
                    " ('".$queryRow['account_id']."', '".date_format($appRJ->date['curDate'], 'Y-m-d H:i:s')."', ".
                    "'".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REMOTE_PORT']."')";
                $DB->query($queryLog_text);
                $usrGroups_text="select * from usersGroups_dt INNER JOIN usersToGroups_dt ON usersGroups_dt.group_id = ".
                    "usersToGroups_dt.group_id WHERE usersToGroups_dt.user_id = ".$queryRow['user_id'];
                $usrGroups_res = $DB->query($usrGroups_text);
                if(@$usrGroups_res->rowCount() > 0){
                    while ($usrGroups_row = $usrGroups_res->fetch(PDO::FETCH_ASSOC)){
                        $_SESSION['groups'][$usrGroups_row['group_id']] = $usrGroups_row['rules'];
                    }
                }
                if($appRJ->server['redirUri']['path']){
                    header("Location: ".$appRJ->server['redirUri']['path']);
                }else{
                    header("Location: /");
                }
            }
        }else{
            $validErr = "неправильный логин или пароль";
        }
    }else{
        $validErr = "неправильный логин или пароль";
    }
}
if($validErr !== null){
    session_destroy();
}