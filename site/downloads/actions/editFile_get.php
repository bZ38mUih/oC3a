<?php

$fileErr=null;
$catSelect=null;
if(isset($_GET['file_id']) and $_GET['file_id']!=null){
    //require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
    $File_rd = new recordDefault("dwlFiles_dt", "dwlFile_id");
    $File_rd['result']['dwlFile_id']=$_GET['file_id'];
    if($File_rd->copyOne()){
        require_once ($_SERVER['DOCUMENT_ROOT']."/site/downloads/views/editFile.php");
    }else{
        $appRJ->response['result'].= "неправильные параметры запроса file_id";
        exit;
    }
}else{
    $appRJ->response['result'].= "incorrect file_id";
    exit;
}
