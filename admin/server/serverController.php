<?php

$formInputEnbl = "disabled";
$accessFile = true;

if(isset($_GET['conn']) and $_GET['conn']=='cancel'){
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
}elseif(isset($_GET['status']) and $_GET['status']=='refresh'){
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/statusView.php");
}elseif(isset($_POST['saveFlag']) and $_POST['saveFlag']=='y'){
    $svContErr = null;
    foreach($DB->connSettings as $key =>$value){
        if(isset($_POST[$key])){
            $DB->connSettings[$key]=$_POST[$key];
        }else{
            $svContErr[$key]="отсутствует параметр";
        }
    }

    if($svContErr!=null){
        $formInputEnbl=null;
    }else{
        if(!file_put_contents($_SERVER["DOCUMENT_ROOT"].$pathToConn, json_encode($DB->connSettings))){
            $accessFile = false;
        }
    }
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/defaultView.php");
}

