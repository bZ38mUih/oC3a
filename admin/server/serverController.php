<?php

$formInputEnbl = "disabled";

if(isset($_GET['conn']) and $_GET['conn']=='cancel'){
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
    exit;
}elseif(isset($_GET['status']) and $_GET['status']=='refresh'){
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/statusView.php");
    exit;
}elseif(isset($_POST['saveFlag']) and $_POST['saveFlag']=='y'){
    $svContErr = null;
    foreach($DB->connSettings as $key =>$value){
        if(isset($_POST[$key])){
            $DB->connSettings[$key]=$_POST[$key];
            if($key!='CONN_PW'){
                if($_POST[$key]==null){
                    $svContErr[$key]="не задано";
                }
            }
        }else{
            $svContErr[$key]="отсутствует параметр";
        }
    }

    if($svContErr!=null){
        $formInputEnbl=null;
    }else{
        if(!file_put_contents($_SERVER["DOCUMENT_ROOT"].$DB->pathToConn, json_encode($DB->connSettings))){
            $formInputEnbl['fileErr']="ошибка сохранения файла";
        }
    }
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
    exit;
}

require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/defaultView.php");