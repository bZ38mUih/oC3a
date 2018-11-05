<?php
define(WD_PROC_IMG, "/data/win-pc-info/process/");
define(WD_HW_IMG, "/data/win-pc-info/hardware/");
define(WD_SRV_IMG, "/data/win-pc-info/services/");
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    if($appRJ->server['reqUri_expl'][2]=='category'){

    }elseif($appRJ->server['reqUri_expl'][2]=="win-process" or $appRJ->server['reqUri_expl'][2]=="win-services" or
        $appRJ->server['reqUri_expl'][2]=="win-environment" or $appRJ->server['reqUri_expl'][2]=="win-hardware"
        or $appRJ->server['reqUri_expl'][2]=="win-system-info" ){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/handbook/actions/wpi.php");
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/handbook-view.php");
    }
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/handbook/views/defaultView.php");
}