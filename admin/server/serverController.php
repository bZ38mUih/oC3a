<?php

$formInputEnbl = "disabled";
$accessFile = true;

if(isset($_GET['conn']) and $_GET['conn']=='cancel'){
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
    //exit;
}elseif(isset($_GET['status']) and $_GET['status']=='refresh'){
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/statusView.php");
    //require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
    //exit;
}elseif(isset($_POST['saveFlag']) and $_POST['saveFlag']=='y'){



    $svContErr = null;
    foreach($connSettings as $key =>$value){
        if(isset($_POST[$key])){
            $connSettings[$key]=$_POST[$key];
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
        if(!file_put_contents($_SERVER["DOCUMENT_ROOT"].$pathToConn, json_encode($connSettings))){
            $accessFile = false;
            //$formInputEnbl="problem access to file ".$pathToConn;
        }
    }
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/formView.php");
}else{
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/server/views/defaultView.php");
}

