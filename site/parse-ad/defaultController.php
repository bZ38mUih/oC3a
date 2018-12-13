<?php
if($_GET['run'] and $_GET['run']=='test'){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/admin/tables/actions/cron-parseAd.php");
}
require_once ($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/views/defaultView.php");