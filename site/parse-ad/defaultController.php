<?php
if($_SESSION['user_id']){

    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/views/defaultView.php");

}else{
    $appRJ->errors["stab"]["description"]="парсинг объявлений на реконструкции";
}

