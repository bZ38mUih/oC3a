<?php
if($_SESSION['user_id']){
    if($_GET['run'] and $_GET['run']=='test'){
        require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/tables/actions/cron-parseAd.php");

    }else{
        require_once ($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/views/defaultView.php");
    }
}else{
    $appRJ->errors["stab"]["descriotion"]="парсин объявлений на реконструкции";
}

