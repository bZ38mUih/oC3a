<?php
if(isset($appRJ->server['reqUri_expl'][2]) and $appRJ->server['reqUri_expl'][2]!=null){
    $andWhere = " and artCat_dt.artCat_id = '3'";
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/artMan/views/artView.php");
}else{
    $appRJ->errors['404']['description']="страницы dev больше не существует";
}
