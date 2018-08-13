<?php
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    if($appRJ->server['reqUri_expl'][2]=='category'){

    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artView.php");
    }
}else{
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/dev/views/defaultView.php");
}
