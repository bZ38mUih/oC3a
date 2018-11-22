<?php

$validErr = null;

$signInActiveSocial=" class='active'";
$signInActiveSite=null;

if(isset($_COOKIE['gate']) and $_COOKIE['gate']=='site'){
    $signInActiveSocial=null;
    $signInActiveSite=" class='active'";
}

if ($_GET['gate'] and $_GET['gate']!=null){
    $appRJ->response['format']='ajax';
    if($_GET['gate']==='site'){
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/signIn_form.php");
    }else{
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/socialView.php");
    }
}
elseif(isset($_GET['code'])){
    $appRJ->response['format']='ajax';
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/actions/social_auth.php");
    if(!$socialAuth_err){
        $appRJ->response['format']='html';
        require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/defaultView.php");
    }
}
elseif(isset($_GET['auth']) and $_GET['auth']=='try'){
    $appRJ->response['format']='ajax';
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/signIn-frame.php");
}
elseif ($_POST){
    $appRJ->response['format']='ajax';
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/actions/site_auth.php");
    $h1='Вход на сайт';
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/defaultView.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/site/signIn/views/defaultView.php");
}

