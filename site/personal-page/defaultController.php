<?php
define('PP_USRGR_IMG_PAPH', '/data/usersGroups/');
define('PP_USR_IMG_PAPH', '/data/users/');

if(strtolower($appRJ->server['reqUri_expl'][2])=="ppmanager"){
    if(isset($_SESSION['groups'][1]) and $_SESSION['groups'][1]>10) {
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/ppManagerController.php");
    }else{
        $appRJ->errors['access']['description']="у вас нет прав доступа";
    }
}elseif (isset($_SESSION['alias'])){
    if(!$appRJ->server['reqUri_expl'][2]){
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/defaultView.php");
    }elseif(strtolower($appRJ->server['reqUri_expl'][2])=="notification"){
        if($appRJ->server['reqUri_expl'][3]=="read"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/ntfRead.php");
        }
    }elseif(strtolower($appRJ->server['reqUri_expl'][2])=="settings"){
        //if($appRJ->server['reqUri_expl'][3]=="read"){
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/personal-page/views/usrSettings.php");
        //}
    }
}
else{
    $appRJ->errors['access']['description']="Требуется авторизация";
}
