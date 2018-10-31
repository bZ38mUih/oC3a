<?php
//define(UPLOAD_IMG_PAPH, "/data/downloads/");
define(DWL_CATEG_IMG_PAPH, "/data/downloads/categs/");
define(DWL_FILES_IMG_PAPH, "/data/downloads/files/");

if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    if(strtolower($appRJ->server['reqUri_expl'][2])=="dwlmanager"){
        if(isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>=10) {
            require_once($_SERVER["DOCUMENT_ROOT"]."/site/downloads/dwlManagerController.php");
        }else{
            $appRJ->errors['access']['description']="у вас нет прав доступа";
        }
    }elseif(strtolower($appRJ->server['reqUri_expl'][2])=="file"){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/showFile.php");
    }elseif(strtolower($appRJ->server['reqUri_expl'][2])=="list"){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/listView.php");
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/actions/showCategory.php");
    }
}
else{
    if(!$appRJ->server['reqUri_expl'][2]){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/downloads/views/defaultView.php");
    }else{
        $appRJ->errors['404']['description']="Категория ".$appRJ->server['reqUri_expl'][3]." не найдена";
    }
}
