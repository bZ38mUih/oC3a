<?php

require_once ($_SERVER["DOCUMENT_ROOT"]."/source/requiredFields_class.php");

if(!requiredFields::checkPassword($_POST['login'])){
    $validErr = "недопустимый логин";
}
if($validErr == null){
    if(!requiredFields::checkPassword($_POST['password'])){
        $validErr = "недопустимый пароль";
    }
}

if($validErr == null){
    $queryText = "select * from accounts_dt INNER JOIN users_dt ON accounts_dt.user_id = users_dt.user_id ".
        "where accAlias='".$_POST['login']."' and netWork='site'";
    $queryRes = $DB->doQuery($queryText);
    if(mysql_num_rows($queryRes) === 1){
        $queryRow = $DB->doFetchRow($queryRes);
        if(hash('md5', $_POST['password'].$queryRow['pw_salt']) === $queryRow['pw_hash']){
            $newSalt=requiredFields::mkSalt();
            $newHash=hash('md5', $_POST['password'].$newSalt);
            $updateSalt_query = "update accounts_dt set pw_hash='".$newHash."', pw_salt='".$newSalt."' ".
                "where accAlias='".$_POST['login']."' and netWork='site'";
            $DB->doQuery($updateSalt_query);
            if($queryRow['validDate']===null){
                $validErr = "eMail не подтвержден";
            }elseif ($queryRow['blackList'] == true){
                $validErr = "Аккаунт заблокирован";
            }else{
                $_SESSION['alias']=$queryRow['accAlias'];
                $_SESSION['account_id'] = $queryRow['account_id'];
                $_SESSION['user_id'] = $queryRow['user_id'];
                $_SESSION['photoLink'] = $queryRow['photoLink'];

                $queryLog_text="insert into inLog_dt (account_id, comeDate, uAgent, rmAddr, rmPort) values".
                    " ('".$queryRow['account_id']."', '".date_format($appRJ->date['curDate'], 'Y-m-d H:i:s')."', ".
                    "'".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REMOTE_PORT']."')";
                $DB->doQuery($queryLog_text);

                $usrGroups_text="select * from usersGroups_dt INNER JOIN usersToGroups_dt ON usersGroups_dt.group_id = ".
                    "usersToGroups_dt.group_id WHERE usersToGroups_dt.user_id = ".$queryRow['user_id'];
                $usrGroups_res = $DB->doQuery($usrGroups_text);
                if(@mysql_num_rows($usrGroups_res)>0){
                    while ($usrGroups_row = $DB->doFetchRow($usrGroups_res)){
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