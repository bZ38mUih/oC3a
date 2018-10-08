<?php
if(strtolower($appRJ->server['reqUri_expl'][2])=="ppmanager"){
    if(isset($_SESSION['groups'][1]) and $_SESSION['groups'][1]>10) {
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/ppManagerController.php");
    }else{
        $appRJ->errors['access']['description']="у вас нет прав доступа";
    }
}elseif (isset($_GET['delAvatarImg']) and $_GET['delAvatarImg']!=null){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/site/personal-page/actions/delUsrAvatar.php");
}elseif (isset($_SESSION['alias'])){
    if(!$appRJ->server['reqUri_expl'][2]){
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/defaultView.php");
    }elseif(strtolower($appRJ->server['reqUri_expl'][2])=="notification"){
        if($appRJ->server['reqUri_expl'][3]=="read"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ntfRead.php");
        }
    }elseif(strtolower($appRJ->server['reqUri_expl'][2])=="settings"){
        if($_POST){
            if (isset($_POST['avatar_id']) and $_POST['avatar_id']!==null){
                require_once($_SERVER['DOCUMENT_ROOT'] . "/site/personal-page/actions/editUsrAvatar.php");
            }
        }else{
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/usrSettings.php");
        }
    }
}
else{
    $appRJ->errors['access']['description']="Требуется авторизация";
}
