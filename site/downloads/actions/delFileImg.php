<?php

$delFile['result'] = false;
$delFile['data'] = null;

//require_once ($_SERVER['DOCUMENT_ROOT']."/source/recordDefault_class.php");
$File_rd = array("table" => "dwlFiles_dt", "field_id" => "dwlFile_id");
$File_rd['result']['dwlFile_id']=$_GET['delFileImg'];
if($File_rd = $DB->copyOne($File_rd)){
    unlink ($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd['result']['dwlFile_id']."/".$File_rd['result']['fileImg']);
    unlink ($_SERVER["DOCUMENT_ROOT"].DWL_FILES_IMG_PAPH.$File_rd['result']['dwlFile_id']."/preview/".$File_rd['result']['fileImg']);
    $File_rd['result']['fileImg']=null;
    if($DB->updateOne($File_rd)){
        $delFile['result'] = true;
        $delFile['data'] = "<img src='/data/default-img.png'>";
    }else{
        $delFile['data'] = "обновление неудачно";
    }
}else{
    $delFile['data'] = "неправильные параметры запроса cat_id";
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $delFile;