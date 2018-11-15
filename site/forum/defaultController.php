<?php

define(F_CAT_IMG, "/data/forum/categs/");
define(F_SUBJ_IMG, "/data/forum/subjects/image/");

if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
    if(isset($appRJ->server['reqUri_expl'][2]) and strtolower($appRJ->server['reqUri_expl'][2])=="forummanager"){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/forum/fManController.php");
        //$adminModule=$appRJ->server['reqUri_expl'][2];
    }else{
        require_once($_SERVER['DOCUMENT_ROOT']."/site/forum/views/defaultView.php");
    }
}else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}