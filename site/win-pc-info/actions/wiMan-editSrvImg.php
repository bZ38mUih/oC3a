<?php
$editImg['result'] = false;
$editImg['data'] = null;
$slSrv_qry="select * from wdSrvList_dt WHERE sName='".$paramVal."'";
$slSrv_res=$DB->query($slSrv_qry);
if($slSrv_res->rowCount() == 1){
    $slSrv_row = $slSrv_res->fetch(PDO::FETCH_ASSOC);
    foreach ($_FILES as $file){
        if ($file['error'] !== 0){
        }else{
            if($slSrv_row['sImg']){
                unlink ($_SERVER["DOCUMENT_ROOT"].WD_SRV_IMG.$slSrv_row['sImg']);
            }
            $path_parts = pathinfo(basename($file['name']));
            if (move_uploaded_file($file['tmp_name'], $_SERVER["DOCUMENT_ROOT"].WD_SRV_IMG.
                $paramVal.".".$path_parts['extension'])) {
                //create preview-->
                require_once ($_SERVER['DOCUMENT_ROOT']."/source/imageLib_class.php");
                $imageLib=new imageLib();
                $imageLib->createPreview(
                    $_SERVER["DOCUMENT_ROOT"].WD_SRV_IMG.$paramVal.".".$path_parts['extension'],
                    $_SERVER["DOCUMENT_ROOT"].WD_SRV_IMG.$paramVal.".".$path_parts['extension'], 150, 150);
                //--create preview
                $updateSrv_qry="update wdSrvList_dt set sImg='".$paramVal.".".$path_parts['extension']."' WHERE sName='".$paramVal."'";
                if($DB->query($updateSrv_qry)){
                    $editImg['result'] = true;
                    $editImg['data'] = "<img src='".WD_SRV_IMG.$paramVal.".".$path_parts['extension']."'>";
                }
            } else {
                $editImg['data']= "Возможная атака с помощью файловой загрузки!\n";
            }
        }
    }
}else{
    $editImg['data'] = "wrong paramVal=".$paramVal;
}
$appRJ->response['format']='json';
$appRJ->response['result'] = $editImg;