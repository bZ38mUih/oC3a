<?php

if($_GET['logdepth'] and $_GET['logdepth']!=null){
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/actions/showLog.php");
    $appRJ->response['format']='ajax';
}else{
    $curPage=1;
    if(isset($_GET["page"]) and $_GET['page']!=null ){
        $curPage=$_GET["page"];
    }
    $volP=20;
    $adType='all';
    $adSaler='all';
    if(isset($_COOKIE['volP']) and $_COOKIE["volP"]!=null){
        $volP = $_COOKIE["volP"];
    }
    if(isset($_COOKIE['adSaler']) and $_COOKIE['adSaler']=='company'){
        $adSaler="Компания";
    }elseif(isset($_COOKIE['adSaler']) and $_COOKIE['adSaler']=='persP'){
        $adSaler="Частное лицо";
    }
    if(isset($_COOKIE['adType']) and $_COOKIE['adType']!='all'){
        $adType=$_COOKIE['adType'];
    }
    require_once ($_SERVER["DOCUMENT_ROOT"]."/site/parse-ad/views/defaultView.php");
}


