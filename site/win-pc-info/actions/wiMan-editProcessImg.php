<?php
$editImg['result'] = false;
$editImg['data'] = null;
$slPr_qry="select * from wdProcList_dt WHERE pName='".$paramVal."'";
$slPr_res=$DB->doQuery($slPr_qry);
if(mysql_num_rows($slPr_res)==1){
    $slPr_row=$DB->doFetchRow($slPr_res);
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($slPr_row['pImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].WD_PROC_IMG.$slPr_row['pImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].WD_PROC_IMG.
                $paramVal.".".$path_parts['extension'])) {
                //create preview-->
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].WD_PROC_IMG.$paramVal.".".$path_parts['extension'],
                    $_SERVER["DOCUMENT_ROOT"].WD_PROC_IMG.$paramVal.".".$path_parts['extension'], 150, 150);
                //--create preview
                $updateHw_qry="update wdProcList_dt set pImg='".$paramVal.".".$path_parts['extension']."' WHERE pName='".$paramVal."'";
                if($DB->doQuery($updateHw_qry)){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".WD_PROC_IMG.$paramVal.".".$path_parts['extension']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "wrong paramName= paramVal=".$paramVal;
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;