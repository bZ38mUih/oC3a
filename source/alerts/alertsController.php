<?php
if(isset($this->errors['404'])){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/err404.php");
}
elseif(isset($this->errors['stab'])){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/stabErr.php");
}
elseif(isset($this->errors['access'])) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/accessErr.php");;
}
elseif(isset($this->errors['connection'])){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/conn.php");
}
elseif(isset($this->errors['request'])){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/requestErr.php");
}
elseif($this->errors['config']){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/configErr.php");
}
else{

    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/XXX.php");
}
exit;