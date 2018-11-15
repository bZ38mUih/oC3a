<?php
if(isset($this->errors['404'])){
    http_response_code(404);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/err404.php");
}
elseif(isset($this->errors['stab'])){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/stabErr.php");
}
elseif(isset($this->errors['access'])) {
    http_response_code(403);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/accessErr.php");;
}
elseif(isset($this->errors['connection'])){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/conn.php");
}
elseif(isset($this->errors['request'])){
    http_response_code(400);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/requestErr.php");
}
elseif($this->errors['config']){
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/configErr.php");
}
else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/source/alerts/views/XXX.php");
}
exit;