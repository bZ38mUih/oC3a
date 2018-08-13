<?php

if (isset($_SESSION['groups']['1']) and $_SESSION['groups']['1']>10) {
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/services/views/defaultView.php");
}else{
    $appRJ->errors['stab']['description']="Администрация просит извинения за предоставленные неудобства :-(";
}

