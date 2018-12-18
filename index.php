<?php
session_start();

require_once ($_SERVER["DOCUMENT_ROOT"]."/source/DB_class.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/source/recordDefault_class.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/source/appRJ_class.php");

$appRJ = new appRJ();

$appRJ->initValues();

if(isset($_GET['cmd']) and $_GET['cmd']=='exit'){

    session_unset ();
    if($appRJ->server['reqUri']['path']){
        header("Location: ".$appRJ->server['reqUri']['path']);
    }else{
        header("Location: /");
    }
}elseif(isset($_GET['forbidden']) and ($_GET['forbidden']=='yes')){
    $appRJ->errors['access']['description']="Каталог закрыт для просмотра";
}elseif (isset($_GET['404']) and ($_GET['404']=='yes')){
    $appRJ->errors['404']['description']="директория не найдена";
}elseif(isset($appRJ->server['reqUri_expl'][1]) and $appRJ->server['reqUri_expl'][1]=='admin'){
    if(!@include_once($_SERVER["DOCUMENT_ROOT"]."/admin/adminController.php")){
        $appRJ->errors['404']['description']="контроллер admin not found";
    }
}else{
    $DB=new DB();
    $DB->readSettings();

    if($DB->connect_db()){
        require_once($_SERVER["DOCUMENT_ROOT"]."/site/siteController.php");
    }else{
        $appRJ->errors['connection']['description']="ошибка подключения к серверу базы данных";
    }
}

if($appRJ->errors){
    $appRJ->throwErr();
}

if($appRJ->response['format']=='html'){
    $appRJ->mct();
    echo $appRJ->response['result'];
    /*use for social_auth*/
    $_SESSION['redirLoc']=$appRJ->server['reqUri']['path'];
}elseif($appRJ->response['format']=='ajax'){
    echo $appRJ->response['result'];
}else{
    echo json_encode($appRJ->response['result'], true);
}


