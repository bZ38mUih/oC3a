<?php
if($_SESSION['user_id']){
    if($_GET['logdepth'] and $_GET['logdepth']!=null){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/actions/showLog.php");
        $appRJ->response['format']='ajax';
    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/views/defaultView.php");
    }
}else{
    $appRJ->errors["stab"]["description"]="парсинг объявлений на реконструкции";
}

